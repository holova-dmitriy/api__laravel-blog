<?php

namespace App\Http\Requests\Photo;

use Illuminate\Validation\Rule;
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
            'post_id' => [
                'required',
                Rule::exists('posts', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
            'image' => 'required|image|max:2048',
        ];
    }
}
