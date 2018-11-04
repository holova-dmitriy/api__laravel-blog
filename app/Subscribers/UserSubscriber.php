<?php

namespace App\Subscribers;

use App\Jobs\SendEmailJob;
use App\Events\UserRegisterEvent;
use App\Events\UserPasswordResetEvent;

class UserSubscriber
{
    public function onRegister($event)
    {
        SendEmailJob::dispatch(
            trans('emails.register.subject'),
            'emails.users.register',
            $event->user->email,
            [
                'user' => $event->user,
            ]
        );
    }

    public function onPasswordUpdated($event)
    {
        SendEmailJob::dispatch(
            trans('emails.password.updated.subject'),
            'emails.users.password_updated',
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

        $events->listen(
            UserPasswordResetEvent::class,
            'App\Subscribers\UserSubscriber@onPasswordUpdated'
        );
    }
}
