<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::group([
    'namespace' => 'Auth',
], function () {
    Route::get('email/verify/{token}', 'VerificationController@verify')->name('verification.verify');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});
