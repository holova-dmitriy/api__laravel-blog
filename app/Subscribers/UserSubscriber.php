<?php

namespace App\Subscribers;

use App\Jobs\SendEmailJob;
use App\Events\UserRegisterEvent;

class UserSubscriber
{
    public function onRegister($event)
    {
        SendEmailJob::dispatch(
            'emails.users.register',
            $event->user->email,
            [
                'user' => $event->user,
            ]
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserRegisterEvent::class,
            'App\Subscribers\UserSubscriber@onRegister'
        );
    }
}
