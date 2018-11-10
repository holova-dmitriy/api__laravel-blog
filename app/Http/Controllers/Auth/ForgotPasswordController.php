<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Events\UserForgotPasswordEvent;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        $email = $request->get('email');

        event(new UserForgotPasswordEvent($email, $this->getUrl($request, $this->createNewToken($email))));

        return new MessageResource([trans('messages.password.forgot')]);
    }

    private function createNewToken(string $email)
    {
        $token = hash_hmac('sha256', str_random(40), base64_decode(substr(config('app.key'), 7)));

        DB::table($this->getTable())->where('email', $email)->delete();

        DB::table($this->getTable())
            ->insert([
                'email' => $email,
                'token' => app('hash')->make($token),
                'created_at' => new Carbon,
            ]);

        return Crypt::encrypt([
            'email' => $email,
            'token' => $token,
        ]);
    }

    private function getTable()
    {
        $config = config('auth');

        return $config['passwords'][$config['defaults']['passwords']]['table'];
    }

    private function getUrl(ForgotPasswordRequest $request, $token)
    {
        $requestUrl = $request->get('redirect_to');

        if ($requestUrl) {
            return rtrim($requestUrl, '/').'/'.$token;
        }

        return route('password.reset', ['token' => $token]);
    }
}
