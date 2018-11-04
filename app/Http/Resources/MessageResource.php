<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource as Resource;

class MessageResource extends Resource
{
    protected $messages;

    public function __construct(array $messages = [])
    {
        parent::__construct([]);

        $this->messages = $messages;
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
            'errors' => [],
        ];
    }
}
