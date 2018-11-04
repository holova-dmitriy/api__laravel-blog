<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\VerifyRequest;

class VerificationController
{
    public function __invoke(VerifyRequest $request)
    {
        auth()->user()->update([
            'email_verified_at' => Carbon::now(),
            'api_token' => User::generateToken(),
        ]);

        return new MessageResource(['Successfully email verified']);
    }
}
