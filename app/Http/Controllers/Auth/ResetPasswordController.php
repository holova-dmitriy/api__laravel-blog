<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Events\UserResetPasswordEvent;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController
{
    use ResetsPasswords;

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $response = Password::broker()
            ->reset($this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            });

        return $response === Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    private function credentials(ResetPasswordRequest $request)
    {
        $tokenDecrypt = Crypt::decrypt($request->get('token'));

        return [
            'email' => $tokenDecrypt['email'],
            'token' => $tokenDecrypt['token'],
            'password' => $request->get('password'),
            'password_confirmation' => $request->get('password_confirmation'),
        ];
    }

    private function resetPassword(User $user, string $password)
    {
        $user->update([
            'password' => bcrypt($password),
        ]);

        event(new UserResetPasswordEvent($user));
    }

    private function sendResetResponse($response)
    {
        return new MessageResource([trans($response)]);
    }

    private function sendResetFailedResponse(ResetPasswordRequest $request, $response)
    {
        return $request->wantsJson()
            ? new MessageResource([], ['token' => [trans($response)]])
            : redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors([
                    'password' => trans($response),
                ]);
    }
}
