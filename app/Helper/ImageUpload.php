<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageUpload {

public function uploads($file, $path='')
{
    if($file) {

        $fileName   = time() . $file->getClientOriginalName();
        Storage::disk('public')->put($fileName, File::get($file));
        $file_name  = $file->getClientOriginalName();
        $file_type  = $file->getClientOriginalExtension();
        $filePath   = 'storage/'.$path . $fileName;

        return $file = [
        'fileName' => $fileName,
        'fileType' => $file_type,
        'filePath' => $filePath,
        'fileSize' => $this->fileSize($file)
        ];
    }
}

public function fileSize($file, $precision = 2)
{
$size = $file->getSize();

if ( $size > 0 ) {
$size = (int) $size;
$base = log($size) / log(1024);
$suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

return $size;
}
}
