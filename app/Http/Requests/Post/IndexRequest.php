<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseRequest as Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'numeric',
            'per_page' => 'numeric',
            'filter' => 'string',
        ];
    }
}
