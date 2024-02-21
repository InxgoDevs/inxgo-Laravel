<?php
// app/Listeners/NotifySellers.php

namespace App\Listeners;

use App\Events\NewJobRequest;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\MessageTarget;
use Kreait\Laravel\Firebase\Facades\Firebase;

class NotifySellers
{
    public function handle(NewJobRequest $event)
    {
        // Retrieve nearby sellers (you need to implement this logic)
        $nearbySellers = $this->getNearbySellers($event->job->skill->location);

        foreach ($nearbySellers as $seller) {
            // Send FCM notification to each seller
            Firebase::messaging()->send(
                CloudMessage::withTarget(MessageTarget::token($seller->fcm_token))
                    ->withData([
                        'skill_id' => $event->job->skill_id,
                        'sender' => $event->job->client->name,
                    ])
                    ->withNotification([
                        'title' => 'New Job Request',
                        'body' => 'You have a new job request from ' . $event->job->client->name,
                    ])
            );
        }
    }

    private function getNearbySellers($location)
    {
        // Implement logic to get nearby sellers based on the client's location
        // You may use a geocoding service or any other method to find nearby sellers
        // Return a collection of nearby sellers
    }
}
