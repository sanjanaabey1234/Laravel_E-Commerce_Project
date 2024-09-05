<?php
namespace App\Http\Helper;


class Helper
{
    public static function getFileUrl($file, $directory, $existFileUrl = null)
    {
        if ($file) {
            if ($existFileUrl && file_exists($existFileUrl)) {
                unlink($existFileUrl);
            }
            $fileName = time() . rand(10, 10000) . '.webp';

            // Get the uploaded file's temporary location
            $tmpFilePath = $file->getRealPath();

            // Create image from file
            $image = imagecreatefromstring(file_get_contents($tmpFilePath));

            // Get original dimensions
            $width = imagesx($image);
            $height = imagesy($image);

            // Define new dimensions or scale factor
            if ($width > 1000 || $height > 1000) {
                $newWidth = $width / 2; // for example, reduce by half
                $newHeight = $height / 2; // for example, reduce by half
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            // Create a new image with reduced size
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency if exists
            $transparentColor = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
            imagefill($newImage, 0, 0, $transparentColor);
            imagesavealpha($newImage, true);

            // Resize and copy
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save as webp
            imagewebp($newImage, $directory . $fileName);

            // Free up memory
            imagedestroy($image);
            imagedestroy($newImage);

            $fileUrl = $directory . $fileName;
        } else {
            $fileUrl = $existFileUrl ?? null;
        }
        return $fileUrl;
    }
}