<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource as Resource;

class LoginResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'api_token' => $this->api_token,
        ];
    }
}
