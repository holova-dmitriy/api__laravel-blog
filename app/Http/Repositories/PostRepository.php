<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function getPostsList(int $perPage, int $page = 1, string $filter = null)
    {
        return $this->responseRepository(
            Post::with('author')
                ->when($filter, function ($query, $filter) {
                    return $query->where('title', 'like', "%$filter%")
                        ->orWhere('annotation', 'like', "%$filter%")
                        ->orWhere('content', 'like', "%$filter%");
                })
                ->paginate($perPage),
            [
                'per_page' => $perPage,
                'page' => $page,
                'filter' => $filter,
            ]
        );
    }
}
