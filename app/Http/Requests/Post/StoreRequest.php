<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseRequest as Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'annotation' => 'required|string',
            'content' => 'required|string',
        ];
    }
}
