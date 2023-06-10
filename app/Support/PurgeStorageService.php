<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class PurgeStorageService
{
    public static function purge(string $directory): void
    {
        $files = Storage::files($directory);

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension !== 'gitignore' && ! str_starts_with($filename, '.')) {
                Storage::delete($file);
            }
        }
    }
}
