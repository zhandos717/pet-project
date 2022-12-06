<?php

namespace App\Services;

class ImageDownloadService
{
    public function saves(array $files): array
    {
        $filesName = [];

        $patch = storage_path('files/');

        foreach ($files['name'] as $key => $fileName) {
            $filesName[$key]['path'] = '/storage'.$this->save($patch, $files);
        }
        return $filesName;
    }

    function save(string $patch, &$file): string
    {
        $fileName =  '/files/'.time() . '__'. uniqid() .'.'.pathinfo(array_shift($file['name']), PATHINFO_EXTENSION);

        move_uploaded_file(array_shift($file['tmp_name']), $patch . $fileName);
        return $fileName;
    }
}