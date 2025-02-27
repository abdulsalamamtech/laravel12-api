<?php

namespace App\Http\Controllers;

use App\Lib\PhpCloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestFileUpload extends Controller
{
    public function uploadFile(Request $request){
        // Check if the file is present
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Move the file to a temporary location
            $tempPath = $file->getRealPath();

            // Get the original file name
            $originalFileName = $file->getClientOriginalName();

            // Generate a unique filename
            $uniqueFileName = time().'_'.Str::slug($originalFileName).'.'.$file->getClientOriginalExtension();

            // Move the file to a specific location
            $destinationPath = 'uploads';
            $file->move($destinationPath, $uniqueFileName);

            // Return a success message
            return response()->json(['message' => 'File uploaded successfully', 'filename' => $uniqueFileName]);
        }
    }




    public function store(Request $request){

        // Configure an instance of your Cloudinary cloud
        // Configuration::instance('cloudinary://my_key:my_secret@my_cloud_name?secure=true');
        Configuration::instance(env('CLOUDINARY_URL'));

        // upload the file        
        $upload = new UploadApi();
        // $upload->upload('https://res.cloudinary.com/demo/image/upload/flower.jpg', [
        //     // 'public_id' => 'flower_sample',
        //     'use_filename' => true,
        //     'overwrite' => true]);

        $res = json_encode(
            $upload->upload('https://res.cloudinary.com/demo/image/upload/flower.jpg', [
                'use_filename' => true,
                'overwrite' => true]),
            JSON_PRETTY_PRINT
        );  
            
        return json_decode($res);
        // return [$upload];
        // Get the uploaded image URL
        // $url = $upload->url();

        // return response()->json(['message' => 'Image uploaded successfully', 'url' => $url]);
    }


    public function upload(){
        $file = 'https://cloudinary-res.cloudinary.com/image/upload/c_scale,f_auto,q_auto,w_76,dpr_auto/v1563215041/website/seals/21972-312_SOC_NonCPA.png'; // replace with your uploaded file path
        return $res = PhpCloudinary::upload($file);
    }
}
