<?php

namespace App\Http\Service;

use Illuminate\Http\UploadedFile;

class FileManagerService
{

    public function uploadFileToTmp(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $location = 'images/tmp';
        $file->move(storage_path('app/public/' . $location), $filename);

        return $location . '/' . $filename;
    }
}
