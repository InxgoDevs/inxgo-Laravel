<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use GetStream\StreamLaravel\Facades\FeedManager;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('skills');

        if ($user->role == 'seller') {
            $userSkills = $user->skills;
            $activeJobCards = $user->activeJobCards; // Assuming you have defined this relationship in the Seller model
            $mostRecentJobCard = $user->mostRecentJobCard; // Assuming you have defined this relationship in the Seller model

            // Load assigned jobs for the seller
            $assignedJobs = $user->assignedJobs; // Assuming you have defined this relationship in the Seller model

            // Retrieve job request notifications for the seller
            $notifications = $this->getJobRequestNotifications($user);

            return view('sellers.dashboard', compact('userSkills', 'activeJobCards', 'mostRecentJobCard', 'assignedJobs', 'notifications'));
        } else {
            return redirect()->route('client.dashboard');
        }
    }

    private function getJobRequestNotifications($user)
    {
        // Get the notification feed for the seller
        $notificationFeed = FeedManager::getFeed('job_notifications', $user->id);

        // Retrieve job request notifications from the feed
        $notifications = $notificationFeed->getActivities(0, 10)['results'];

        return $notifications;
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:seller');
    }
}
