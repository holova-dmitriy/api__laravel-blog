<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseRequest as Request;

class UpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->post->user_id === auth()->id();
    }

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
