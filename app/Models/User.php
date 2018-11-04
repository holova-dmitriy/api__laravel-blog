<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Generated auth token;
     * check for uniqueness.
     *
     * @return string
     */
    public static function generateToken() :string
    {
        do {
            $api_token = str_random(60);
        } while (self::where('api_token', $api_token)->exists());

        return $api_token;
    }
}
