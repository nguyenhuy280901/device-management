<?php

namespace App\Services;

class UploadService
{
    /**
     * 
     * @param string $jsonData
     * @param string $destination
     * @return string
     */
    public function storeBase64(string $jsonData, string $destination): string
    {
        $fileInfo = json_decode($jsonData);

        $basename = pathinfo($fileInfo["name"], PATHINFO_BASENAME);
        $extension = pathinfo($fileInfo["name"], PATHINFO_EXTENSION);
        $fileName = $basename . $fileInfo["id"] . "." . $extension;

        $fileData = base64_decode($fileInfo["data"]);
        
        file_put_contents($destination . "/" . $fileName, $fileData);

        return $fileName;
    }
}