<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Photo;

trait PostRelations
{
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
