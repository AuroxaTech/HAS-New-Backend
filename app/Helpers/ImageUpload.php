<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUpload
{
    private $_disk = 'public';

    public function uploadImage($file, $directory)
    {
        if (!Storage::disk($this->_disk)->exists($directory)) {
            Storage::disk($this->_disk)->makeDirectory($directory);
        }

        $name = Str::random(4) . '_' . $file->getClientOriginalName();
        $path = $directory . '/' . $name;  // Full path in profile-images folder

        // Store the image in the specified directory
        Storage::disk($this->_disk)->put($path, File::get($file));

        return [
            'name' => $name,
            'url' => $this->imagePath($path),
        ];
    }

    public function deleteImage($filePath)
    {
        return Storage::disk($this->_disk)->delete($filePath);
    }

    public function imagePath($filePath)
    {
        return "/storage/" . $filePath;
    }
}
