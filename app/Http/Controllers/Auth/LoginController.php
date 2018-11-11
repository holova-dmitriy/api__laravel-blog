<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use ThrottlesLogins;

    protected $user;

    public function __invoke(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->authenticate($request)) {
            return $this->sendLoginResponse();
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse();
    }

    private function authenticate(LoginRequest $request)
    {
        $this->user = User::where('email', $request->get('email'))->first();

        return $this->user && Hash::check($request->get('password'), $this->user->getAuthPassword());
    }

    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function sendLoginResponse()
    {
        $this->user->update([
            'api_token' => User::generateToken(),
        ]);

        return new LoginResource($this->user);
    }

    public function username()
    {
        return 'email';
    }
}
