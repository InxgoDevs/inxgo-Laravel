<?php

namespace App\Listeners;

use App\Events\WelcomeNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use GetStream\StreamLaravel\Facades\FeedManager;

class SendWelcomeNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  WelcomeNotificationEvent  $event
     * @return void
     */
    public function handle(WelcomeNotificationEvent $event)
    {
            Log::info('New job request received.');

        // Get the user for which the welcome notification is being sent
        $user = $event->user;

        // Retrieve the notification feed for the user
        $notificationFeed = FeedManager::getNotificationFeed($user->id);

        // Add the welcome notification to the user's notification feed
        $notificationFeed->addActivity([
            'actor' => $user->id,
            'verb' => 'welcomed',
            'object' => 'you',
            'foreign_id' => 'welcome_notification'
        ]);
    }
}
