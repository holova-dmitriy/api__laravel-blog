<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserForgotPasswordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $url;

    /**
     * Create a new event instance.
     *
     * @param string $email
     * @param string $url
     *
     * @return void
     */
    public function __construct(string $email, string $url)
    {
        $this->email = $email;
        $this->url = $url;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
