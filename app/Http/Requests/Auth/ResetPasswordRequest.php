<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, $this->user()->getAuthPassword())) {
                        $fail(trans('validation.custom.old_password.failed'));
                    }
                },
            ],
            'password' => 'required|string|confirmed|min:6',
        ];
    }
}
