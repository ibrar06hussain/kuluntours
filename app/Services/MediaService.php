<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Upload a file to the specified directory within public/uploads.
     */
    public function upload(UploadedFile $file, string $directory = 'media'): string
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '.' . $file->getClientOriginalExtension();

        $uploadPath = public_path('uploads/' . $directory);

        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $file->move($uploadPath, $filename);

        return $directory . '/' . $filename;
    }

    /**
     * Delete a file from the uploads directory.
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        $fullPath = public_path('uploads/' . $path);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Get the full URL for an uploaded file.
     */
    public function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('uploads/' . $path);
    }
}
