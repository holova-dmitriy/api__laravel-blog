<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserPasswordResetEvent;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController
{
    public function __invoke(ResetPasswordRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->get('password')),
        ]);

        event(new UserPasswordResetEvent($user));

        return new MessageResource([trans('messages.password.updated')]);
    }
}
