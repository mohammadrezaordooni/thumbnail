<?php

namespace Mro\Thumbnail;

class Thumbnail
{
    public function test(){
        return ['reza','mohsen'];
    }
    public function create($File,$quality,$newWidth,$newHeight){
        /*
         * Custom function to compress image size and
         * upload to the server using PHP
         */
        function compressImage($source, $destination, $quality,$newWidth,$newHeight) {
            // Get image info
            $imgInfo = getimagesize($source);
            $mime = $imgInfo['mime'];

            // Create a new image from file
            switch($mime){
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }
            // Save image
            function fn_resize($image_resource_id, $width, $height,$newWidth,$newHeight)
            {
                 if($newWidth){
                     $target_width=$newWidth;
                 }else{
                     $target_width=300;
                 }
                if($newHeight){
                    $target_height=$newHeight;
                }else{
                    $target_height=300;
                }
                $target_layer = imagecreatetruecolor($target_width, $target_height);
                imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
                return $target_layer;
            }
            $target_layer = fn_resize($image, $imgInfo[0], $imgInfo[1],$newWidth,$newHeight);
            /*imagejpeg($image, $destination, $quality);*/
            imagejpeg($target_layer,$destination,$quality);

            // Return compressed image
            return $destination;
        }


// File upload path
        $uploadPath = "uploads/thumbnails/";
        if(!is_dir($uploadPath)) {
            mkdir($uploadPath);
        }

// If file upload form is submitted
        $status = $statusMsg = '';
            $status = 'error';
            if(!empty($File->getClientOriginalName())) {
                // File info
                $fileName = basename($File->getClientOriginalName());
                $imageUploadPath = $uploadPath . $fileName;
                $fileType = $File->getClientOriginalExtension();;

                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
                    // Image temp source
                    $imageTemp = $File->getPathName();

                    // Compress size and upload image
                    $compressedImage = compressImage($imageTemp, $imageUploadPath, $quality=='' ? 100:$quality,$newWidth,$newHeight);

                    if($compressedImage){
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                        return $imageUploadPath;
                    }else{
                        $statusMsg = "Image compress failed!";
                    }
                }else{
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            }else{
                $statusMsg = 'Please select an image file to upload.';
            }
// Display status message
        return $statusMsg;
        }
}
