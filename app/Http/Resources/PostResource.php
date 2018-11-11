<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource as Resource;

class PostResource extends Resource
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
            'title' => $this->title,
            'annotation' => $this->annotation,
            'content' => $this->content,
            'author' => new UserResource($this->author),
        ];
    }
}
