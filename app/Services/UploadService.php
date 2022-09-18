<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\File;

class UploadService
{
    /**
     * Store media and return path
     *
     * @param File|null $uploadedFile
     * @param string $file_name
     * @param string $destination
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function store($destination, $file)
    {
        return $file->move($destination, $file->getFilename());
    }

    /**
     * Decode base 64 image
     * @param string $image_json_data
     * @return File
     */
    public function decodeImageBase64(string $image_json_data) {
        $imageData = json_decode($image_json_data);

        $fileExtension = pathinfo($imageData->name, PATHINFO_EXTENSION);
        $fileName = pathinfo($imageData->name, PATHINFO_FILENAME);
        
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData->data));

        // Save it to temporary dir first
        $tmpFilePath = sys_get_temp_dir() . '/' . $fileName . $imageData->id . '.' . $fileExtension;
        file_put_contents($tmpFilePath, $data);
        
        return new File($tmpFilePath);
    }
}