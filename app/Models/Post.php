<?php

namespace App\Models;

use App\Models\Post\PostRelations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use PostRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'annotation',
        'content',
    ];
}
