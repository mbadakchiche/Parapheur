<?php

namespace App\Traits;

use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;
use Str;

trait Uploader
{

    /**
     * Upload the attachement from the input array
     * @param string $foldePath is the the Path of the file
     * @param string $filename is the the name of the file
     * @param array $input validated datafrom request
     */
    private function uploadAsFile(string $foldePath, string $fileName, $input, $fileInputName): Media
    {
        $distination = $foldePath;
        $filename = '_' . $fileName . '_' . time();
        $media = MediaUploader::fromSource($input[$fileInputName])
            ->toDestination('public', $distination)
            ->useFilename($filename)
            ->upload();;
        return $media;
    }

    /**
     * Upload the attachement from the input array
     * @param Position $model
     * @param string $filename
     * @param array $input
     */
    private function uploadAsArray($model,string $foldePath, string $fileName, $input, $fileInputName, $tag)
    {
        $distination = $foldePath;
        $filename =  $fileName . '_';
        $model->detachMediaTags($tag);
        //if contains many file
        if (is_array($input[$fileInputName])) {
            foreach ($input[$fileInputName] as $file) {
                # code...
                $filename2 = (string)'_' . $filename . time();
                $media = MediaUploader::fromSource($file)
                    ->toDestination('public', $distination)
                    ->useFilename($filename2)
                    ->upload();
                $model->attachMedia($media, $tag);
            }
        }
    }

}
