<?php

namespace App\Observers;

use App\Models\Photo;
use App\Traits\FileUpload;

class PhotoObserver
{
    use FileUpload;

    public function deleted(Photo $photo)
    {
        $this->handleDeletedImage($photo->local_path);
    }
}
