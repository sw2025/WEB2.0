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

    /**匹配银行名字
     * @return array
     */
    public function getBankName(){
        $res=array();
        $qian=array(" ","　","\t","\n","\r");
        $hou=array("","","","","");
        $bankCard =str_replace($qian,$hou,$_POST['bankCard']);
        $bankList=\BankClass::$bankList;
        $card_8 = substr($bankCard, 0, 8);
        if (isset($bankList[$card_8])) {
            $bankName= $bankList[$card_8];
        }
        $card_6 = substr($bankCard, 0, 6);
        if (isset($bankList[$card_6])) {
            $bankName= $bankList[$card_6];
        }
        $card_5 = substr($bankCard, 0, 5);
        if (isset($bankList[$card_5])) {
            $bankName= $bankList[$card_5];
        }
        $card_4 = substr($bankCard, 0, 4);
        if (isset($bankList[$card_4])) {
            $bankName=  $bankList[$card_4];
        }
        if(isset($bankName)){
            $res['code']="success";
            $res['msg']=$bankName;
        }else{
            $res['code']="error";
        }
        return $res;
        
    }
    
    public function returnMoney(){
        $userId=$_POST['userId'];
        $result=array();
        $account=\UserClass::getMoney($userId);
        if($account!="error"){
            $result['code']="success";
            $result['account']=$account;
        }else{
            $result['code']="error";
        }
        return $result;

    }
    
}
