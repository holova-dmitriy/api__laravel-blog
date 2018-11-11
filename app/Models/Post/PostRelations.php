<?php

namespace App\Models\Post;

use App\Models\User;

trait PostRelations
{
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
