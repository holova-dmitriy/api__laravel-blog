<?php

namespace App\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait FileUpload
{
    /**
     * Upload directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * File name.
     *
     * @var null
     */
    protected $name = null;

    /**
     * Storage instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $storage = '';

    /**
     * Delete File Handler.
     *
     * @param string|null $fileName
     *
     * @return void
     */
    public function handleDeletedImage($fileName)
    {
        if (! is_null($fileName)) {
            $this->initStorage();

            if ($this->storage->exists($fileName)) {
                $this->storage->delete($fileName);
            }
        }
    }

    /**
     * Upload File Handler.
     *
     * @param $file
     *
     * @return string
     */
    public function handleUploadedImage($file)
    {
        if (! is_null($file)) {
            $this->initStorage();

            $this->upload($file);

            return "{$this->getDirectory()}/$this->name";
        }
    }

    /**
     * Upload file.
     *
     * @param UploadedFile $file
     *
     * @return mixed
     */
    protected function upload(UploadedFile $file)
    {
        $this->renameIfExists($file);

        return $this->storage->putFileAs($this->getDirectory(), $file, $this->name);
    }

    /**
     * If name already exists, rename it.
     *
     * @param $file
     *
     * @return void
     */
    public function renameIfExists(UploadedFile $file)
    {
        $this->name($file->getClientOriginalName());

        if ($this->checkFileExists($this->name)) {
            $this->name = $this->generateUniqueName($file);
        }
    }

    /**
     * Check file exists.
     *
     * @param string $fileName
     *
     * @return bool
     */
    public function checkFileExists(string $fileName) :bool
    {
        return $this->storage->exists("{$this->getDirectory()}/$fileName");
    }

    /**
     * Initialize the storage instance.
     *
     * @return void.
     */
    protected function initStorage()
    {
        if (! $this->storage) {
            $this->disk('public');
        }
    }

    /**
     * Set disk for storage.
     *
     * @param string $disk Disks defined in `config/filesystems.php`.
     *
     * @return $this
     */
    public function disk(string $disk)
    {
        if (! array_key_exists($disk, config('filesystems.disks'))) {
            $error = new MessageBag([
                'title' => 'Config error.',
                'message' => "Disk [$disk] not configured, please add a disk config in `config/filesystems.php`.",
            ]);

            return session()->flash('error', $error);
        }

        $this->storage = Storage::disk($disk);

        return $this;
    }

    /**
     * Generate a unique name for uploaded file.
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function generateUniqueName(UploadedFile $file)
    {
        return md5(uniqid()).'.'.$file->getClientOriginalExtension();
    }

    /**
     * Set name of store name.
     *
     * @param string|callable $name
     *
     * @return $this
     */
    public function name(string $name)
    {
        if ($name) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * Specify the directory upload file.
     *
     * @param string $dir
     *
     * @return $this
     */
    public function dir(string $dir)
    {
        if ($dir) {
            $this->directory = $dir;
        }

        return $this;
    }

    /**
     * Get directory for store file.
     *
     * @return mixed|string
     */
    public function getDirectory()
    {
        return $this->directory ?: $this->defaultDirectory();
    }

    /**
     * Get default directory for store file.
     *
     * @return mixed|string
     */
    public function defaultDirectory()
    {
        return 'images';
    }
}
