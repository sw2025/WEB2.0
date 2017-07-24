<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    //公共的上传图片的方法
    public function upload(){
        error_reporting(E_ALL | E_STRICT);
       // require_once("FileUpload/server/php/UploadHandler.php");
        $uploadHandler =new \App\UploadHandler(["upload_dir" => dirname(base_path()) . "/swUpload/images/", "upload_url" => dirname(base_path()) . "/swUpload/images/"]);
    }
}
