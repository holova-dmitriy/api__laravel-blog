<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Http\Requests\BaseRequest as Request;

class ForgotPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:'.(new User())->getTable().',email',
            'redirect_to' => 'url',
        ];
    }
}
