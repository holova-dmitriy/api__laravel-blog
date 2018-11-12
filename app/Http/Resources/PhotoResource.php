<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource as Resource;

class PhotoResource extends Resource
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
            'id' => $this->id,
            'path' => $this->full_path,
        ];
    }
}
