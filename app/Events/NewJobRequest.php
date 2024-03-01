<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class NewJobRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function broadcastOn()
    {
        return new Channel('job-request-channel');
    }
}
// Connect to Socket.IO server
const socket = io('http://localhost:3000'); // Replace with your Socket.IO server URL

// Listen for new job request event
socket.on('newJobRequest', (data) => {
    console.log('New job request received:', data);
    // Handle the new job request notification
});
