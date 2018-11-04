<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource as Resource;

class MessageResource extends Resource
{
    protected $messages;
    protected $errors;

    /**
     * MessageResource instance.
     *
     * @param array $messages
     * @param array $errors
     */
    public function __construct(array $messages = [], array $errors = [])
    {
        parent::__construct([]);

        $this->messages = $messages;
        $this->errors = $errors;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'messages' => $this->messages,
            'errors' => $this->errors,
        ];
    }
}
