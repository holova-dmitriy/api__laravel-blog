<?php

namespace App\Models\Photo;

use App\Models\Post;

trait PhotoRelations
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
