<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

trait VerifiesEmails
{
    protected function verificationUrl($userId, $redirect = null)
    {
        $redirectTo = null;

        if ($redirect) {
            $redirectTo = '&'.http_build_query([
                    'redirect' => $redirect,
                ]);
        }

        return URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                [
                    'id' => $userId,
                    'redirect' => $redirect,
                ]
            ).$redirectTo;
    }
}
