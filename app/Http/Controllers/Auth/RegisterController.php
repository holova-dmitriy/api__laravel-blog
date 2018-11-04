<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        event(new UserRegisterEvent(User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'api_token' => User::generateToken(),
        ])));

        return new MessageResource(['Successfully registered']);
    }
}
