<?php

namespace App\Http\Repositories;

class BaseRepository
{
    public function responseRepository($items, array $params = [])
    {
        $items->appends($params)->links();

        return $items;
    }
}
