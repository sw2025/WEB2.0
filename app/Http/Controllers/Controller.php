<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * 发送验证码
     * @param $mobile
     * @param $message
     * @param $action
     * @return array
     */
    protected function _sendSms($mobile, $message, $action){
        require(base_path().'/vendor/alidayu/TopSdk.php');
        date_default_timezone_set('Asia/Shanghai');
        $c = new \TopClient;
        $c->appkey = '23401348';//需要加引号
        $c->secretKey =env('ALIDAYU_APPSECRET');
        $c->format = 'xml';
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("");//暂时不填
        $req->setSmsType("normal");//默认可用
        $req->setSmsFreeSignName("复根资产");//设置短信免费符号名(需在阿里认证中有记录的)
        $req->setSmsParam("{\"code\":\"{$message}\"}");///设置短信参数
        $req->setRecNum($mobile);//设置接受手机号
        if($action == 'register'){
            $req->setSmsTemplateCode("SMS_63315479");//设置模板
        } elseif($action == 'findPwd') {
            $req->setSmsTemplateCode("SMS_63475490");//设置模板
        }else{
            $req->setSmsTemplateCode("SMS_63970969");//设置模板
        }
        $resp = $c->execute($req);//执行
        $str=array();
        if($resp->result->success){
            $str['code']="code";
            $str['msg']="发送成功!";
            return $str;
        }else {
            $str['code']="code";
            $str['msg']="发送失败,稍后重试!";
            return $str;
        }
    }

    /**
     * 获取六位随机的数字
     * @param int $len
     * @param string $format
     * @return string
     */
    protected function __randStr($len = 6, $format = 'ALL')
    {
        switch ($format) {
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
        }
        mt_srand((double)microtime() * 1000000 * getmypid());
        $password = "";
        while (strlen($password) < $len)
            $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $password;
    }

    /**获取订单单号
     * @param $type
     * @return string
     */
    public function getPayNum($type){
        switch($type){
            case "提现":
                $payPrefix='TX';
                break;
            case "充值":
                $payPrefix='CZ';
                break;
            case "消费":
                $payPrefix="XF";
                break;
        }
        $payNo=$payPrefix.substr(time(),4) . mt_rand(1000,9999);
        return $payNo;
    }
}
