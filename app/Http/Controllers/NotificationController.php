<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GetStream\StreamLaravel\Facades\FeedManager;
use App\Events\WelcomeNotificationEvent; // Add this line
use App\Models\User; // Add this line

class NotificationController extends Controller
{
   // NotificationController.php

public function index(Request $request)
{
    // Get the current authenticated user
    $user = $request->user();

    // Retrieve the notification feed for the user
    $notificationFeed = FeedManager::getNotificationFeed($user->id);

    // Retrieve notifications from the feed
    $activities = $notificationFeed->getActivities(0, 10)['results'];

    // Process the retrieved notifications to include the 'type' index
    $notifications = [];
    foreach ($activities as $activity) {
        // Check if it's a welcome notification
        if ($activity['verb'] === 'welcome') {
            $notification = [
                'type' => 'welcome',
                'user_name' => $activity['actor'],
                'time' => $activity['time'],
            ];
        } else {
            $notification = [
                'actor' => $activity['actor'],
                'verb' => $activity['verb'],
                'object' => $activity['object'],
                'time' => $activity['time'],
            ];
        }
        $notifications[] = $notification;
    }

    // Pass the processed notifications to the view
    return view('notifications.index', compact('notifications'));
}


    public function showNotifications()
{
    // Get the current authenticated user
    $user = Auth::user();

    // Retrieve the notification feed for the user
    $notificationFeed = FeedManager::getNotificationFeed($user->id);

    // Retrieve notifications from the feed
    $notifications = $notificationFeed->getActivities(0, 10)['results'];

    // Add the welcome notification to the notifications array
    $welcomeNotification = $this->getWelcomeNotification();
    if ($welcomeNotification) {
        array_unshift($notifications, $welcomeNotification);
    }

    // Return the view with notifications
    return view('notifications', ['notifications' => $notifications]);
}

// Method to get the welcome notification
private function getWelcomeNotification()
{
    // You can implement the logic to retrieve the welcome notification here
    // For example, you can query the database for the welcome notification
    // or construct it manually
    // For demonstration purposes, I'll return a sample welcome notification
    return [
        'actor' => 'inxgo',
        'verb' => 'welcomed',
        'object' => 'you to the inxgo ',
        'time' => now()->format('Y-m-d H:i:s'),
    ];
}

}
