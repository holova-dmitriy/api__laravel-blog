<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Auth',
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');

    Route::group([
        'prefix' => 'password',
    ], function () {
        Route::post('email', 'ForgotPasswordController')->middleware(['throttle:6,1'])->name('password.email');
        Route::post('reset', 'ResetPasswordController@reset')->name('password.update');
    });
    Route::post('email/resend', 'VerificationController@resend')->middleware(['auth'])->name('verification.resend');
});
