<?php

namespace App\Subscribers;

use App\Events\UserVerifyEmailEvent;
use App\Jobs\SendEmailJob;
use App\Events\UserRegisterEvent;
use App\Events\UserResetPasswordEvent;
use App\Events\UserForgotPasswordEvent;

class UserSubscriber
{
    public function onRegister($event)
    {
        SendEmailJob::dispatch(
            trans('emails.register.subject'),
            'emails.auth.register',
            $event->user->email,
            [
                'user' => $event->user,
                'url' => $event->url,
            ]
        );
    }

    public function onForgotPassword($event)
    {
        SendEmailJob::dispatch(
            trans('emails.password.forgot.subject'),
            'emails.auth.passwords.forgot',
            $event->email,
            [
                'url' => $event->url,
            ]
        );
    }

    public function onResetPassword($event)
    {
        SendEmailJob::dispatch(
            trans('emails.password.updated.subject'),
            'emails.auth.passwords.reset',
            $event->user->email,
            [
                'user' => $event->user,
            ]
        );
    }

    public function onVerifyEmail($event)
    {
        SendEmailJob::dispatch(
            trans('emails.verify.subject'),
            'emails.auth.verify',
            $event->user->email,
            [
                'user' => $event->user,
                'url' => $event->url,
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
            UserForgotPasswordEvent::class,
            'App\Subscribers\UserSubscriber@onForgotPassword'
        );

        $events->listen(
            UserResetPasswordEvent::class,
            'App\Subscribers\UserSubscriber@onResetPassword'
        );

        $events->listen(
            UserVerifyEmailEvent::class,
            'App\Subscribers\UserSubscriber@onVerifyEmail'
        );
    }
}
