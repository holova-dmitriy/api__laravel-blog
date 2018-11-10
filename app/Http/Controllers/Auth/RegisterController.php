<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\VerifiesEmails;
use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    use VerifiesEmails;

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        event(new UserRegisterEvent($user, $this->verificationUrl($user->id, $request->get('redirect_to'))));

        return new MessageResource([trans('messages.registered')]);
    }
}
