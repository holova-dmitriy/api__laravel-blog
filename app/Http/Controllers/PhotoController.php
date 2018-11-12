<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Traits\FileUpload;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Photo\StoreRequest;
use App\Http\Requests\Photo\DestroyRequest;

class PhotoController
{
    use FileUpload;

    public function store(StoreRequest $request)
    {
        $filePath = $this->handleUploadedImage($request->file('image'));

        return new PhotoResource(Photo::create([
            'post_id' => $request->get('post_id'),
            'local_path' => $filePath,
            'full_path' => $this->storage->url($filePath),
        ]));
    }

    public function destroy(DestroyRequest $request, Photo $photo)
    {
        $photo->delete();

        return new MessageResource(['Successfully deleted']);
    }
}
