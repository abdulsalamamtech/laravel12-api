<?php 

namespace App\Lib;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class PhpCloudinary{

    
    // [
    //     "asset_id"=> "098c7ebd0508345145f0a20d9753d603",
    //     "public_id"=> "flower_uu9iqv",
    //     "version"=> 1740657584,
    //     "version_id"=> "8418c1ae6ddd3385d68b8d3cb014e5d8",
    //     "signature"=> "75e74068d72c3e5076472f3bb8c6b55857a62e8e",
    //     "width"=> 912,
    //     "height"=> 608,
    //     "format"=> "jpg",
    //     "resource_type"=> "image",
    //     "created_at"=> "2025-02-27T11:59:44Z",
    //     "tags"=> [],
    //     "bytes"=> 120233,
    //     "type": "upload",
    //     "etag"=> "a9d5dd02de1b6f8d4ea810ce96ed259d",
    //     "placeholder"=> false,
    //     "url"=> "http://res.cloudinary.com/dpjdupkot/image/upload/v1740657584/flower_uu9iqv.jpg",
    //     "secure_url"=> "https://res.cloudinary.com/dpjdupkot/image/upload/v1740657584/flower_uu9iqv.jpg",
    //     "folder"=> "",
    //     "original_filename"=> "flower",
    //     "api_key"=> "732422493399421"
    // ]


    /**
    * $docs https://cloudinary.com/documentation/php_quickstart
    * $file
    * $return mixed [
    *    "asset_id"=> "098c7ebd0508345145f0a20d9753d603",
    *    "public_id"=> "flower_uu9iqv",
    *    "version"=> 1740657584,
    *    "version_id"=> "8418c1ae6ddd3385d68b8d3cb014e5d8",
    *    "signature"=> "75e74068d72c3e5076472f3bb8c6b55857a62e8e",
    *    "width"=> 912,
    *    "height"=> 608,
    *    "format"=> "jpg",
    *    "resource_type"=> "image",
    *    "created_at"=> "2025-02-27T11:59:44Z",
    *    "tags"=> [],
    *    "bytes"=> 120233,
    *    "type": "upload",
    *    "etag"=> "a9d5dd02de1b6f8d4ea810ce96ed259d",
    *    "placeholder"=> false,
    *   "url"=> "http://res.cloudinary.com/dpjdupkot/image/upload/v1740657584/flower_uu9iqv.jpg",
    *    "secure_url"=> "https://res.cloudinary.com/dpjdupkot/image/upload/v1740657584/flower_uu9iqv.jpg",
    *  "folder"=> "",
    *   "original_filename"=> "flower",
    *    "api_key"=> "732422493399421"
    * ]
    * 
     */
    public static function upload($file){
        try {
            // Configure an instance of your Cloudinary cloud
            // Configuration::instance('cloudinary://my_key:my_secret@my_cloud_name?secure=true');
            Configuration::instance(env('CLOUDINARY_URL'));
            $upload = new UploadApi();
            // Upload file to Cloudinary
            // $res = json_encode(
            //     $upload->upload('https://res.cloudinary.com/demo/image/upload/flower.jpg', [
            //         'public_id' => 'flower_sample',
            //         'use_filename' => true,
            //         'overwrite' => true]),
            //     JSON_PRETTY_PRINT
            // );  
            $res = json_encode(
                $upload->upload($file, [
                    'use_filename' => true,
                    'overwrite' => true]),
                JSON_PRETTY_PRINT
            );  
            info("Cloudinary File Upload:", [$res]);      
            
            // Return the response from Cloudinary
            return [
                "success" => "true",
                "message" => "File uploaded successfully",
                "data" => json_decode($res)
            ];
        } catch (\Throwable $th) {
            //throw $th;
            info("Cloudinary File Upload Error:", [$th->getMessage()]);
            $message = $th->getMessage();
            return [
                "success" => "false",
                "message" => "Error occurred while uploading file: $message",
                "data" => null
            ];

        }

        
    }

}