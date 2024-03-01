<?php

namespace App\Listeners;

use App\Events\NewJobRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use GetStream\StreamLaravel\Facades\FeedManager;

class SendJobRequestNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  NewJobRequest  $event
     * @return void
     */
    public function handle(NewJobRequest $event)
    {
        // Get the job from the event
        $job = $event->job;

        // Publish a job request notification to the job_notifications feed
        $notificationFeed = FeedManager::getFeed('job_notifications', $job->client_id);
        $notificationFeed->addActivity([
            'actor' => 'user:' . $job->client_id,
            'verb' => 'job_request',
            'object' => 'New job request',
        ]);

        // Notify nearby sellers
        $this->notifyNearbySellers($job);
    }

    private function notifyNearbySellers(Job $job)
    {
        // Fetch nearby sellers based on the job's skill
        $nearbySellers = User::where('role', 'seller')
            ->whereHas('skills', function ($query) use ($job) {
                $query->where('id', $job->skill_id);
            })
            ->select('id', 'name', 'profile_image', 'fcm_token')
            ->get();

        // Send notifications to nearby sellers
        foreach ($nearbySellers as $seller) {
            // Implement code to send notifications using FCM or any other service
            // Example: Fcm::send(...);
        }
    }
}
