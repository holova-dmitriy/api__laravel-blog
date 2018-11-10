<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\VerifiesEmails;
use App\Events\UserVerifyEmailEvent;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\ResendPasswordVerifyEmailRequest;

class VerificationController
{
    use VerifiesEmails;

    public function verify(Request $request)
    {
        User::find($request->route('id'))->markEmailAsVerified();

        $redirect = $request->get('redirect');

        return $redirect
            ? redirect("$redirect?message=".trans('messages.verify.verified'))
            : view('auth.success_message', [
                'message' => trans('messages.verify.verified'),
            ]);
    }

    public function resend(ResendPasswordVerifyEmailRequest $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return new MessageResource([trans('messages.verify.verified')]);
        }

        event(new UserVerifyEmailEvent($user, $this->verificationUrl($user->id, $request->get('redirect_to'))));

        return new MessageResource([trans('messages.verify.email')]);
    }
}
