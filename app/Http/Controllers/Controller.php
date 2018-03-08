<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use Illuminate\Support\Facades\DB;

abstract class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()

    {

        if (session('userId')) {
            $enterpriseinfo = DB::table('t_u_enterprise')->where('userid', session('userId'))->select('enterprisename', 'showimage')->first();
            if (empty($enterpriseinfo)) {
                $enterprisename = session('phone');
                $showimage = asset('img/avatar.jpg');
            } else {
                $enterprisename = $enterpriseinfo->enterprisename;
                $showimage = env('ImagePath') . $enterpriseinfo->showimage;
            }
            view()->share(['enterprisename' => $enterprisename, 'showimage' => $showimage]);
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
        $payNo=$payPrefix.time() . mt_rand(1000,9999);
        return $payNo;
    }

    static public function getPayNum2($type){
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
        $payNo=$payPrefix.time() . mt_rand(1000,9999);
        return $payNo;
    }

    public  function  _sendSms($mobile,$message,$action,$name='',$time=''){
        ini_set("display_errors", "on");
        require(base_path().'/vendor/alidayus/api_sdk/vendor/autoload.php');
        //require_once dirname(__DIR__) . '/api_sdk/vendor/autoload.php';
        //此处需要替换成自己的AK信息
        Config::load();
        $accessKeyId = "LTAI8Iu9OevZOFP6";//参考本文档步骤2
        $accessKeySecret = "7TFTEtNVJgAxTzgKpUMJRfsh1PkvXL";//参考本文档步骤2
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new DefaultAcsClient($profile);
        $request = new SendSmsRequest();
        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("升维网");
        //必填-短信模板Code
        if($action == 'register'){
            $request->setTemplateCode("SMS_84725297");//设置模板
        } elseif($action == 'findPwd') {
            $request->setTemplateCode("SMS_84725296");//设置模板
        }elseif($action=='change1'){
            $request->setTemplateCode("SMS_84725295");//设置模板
        }elseif($action=='answer'){
            $request->setTemplateCode("SMS_97795045");//设置模板
        }elseif($action=='reselects'){
            $request->setTemplateCode("SMS_98165010");//设置模板
        }elseif($action=='push'){
            $request->setTemplateCode("SMS_117527100");//设置模板
        }else{
            $request->setTemplateCode("SMS_84725295");//设置模板
        }
        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
       if($action=='answer'){
           $request->setTemplateParam("{\"expert\":\"{$name}\",\"time\":\"{$time}\",\"action\":\"{$message}\"}");
       }elseif($action=='reselects'|| $action=='push'){
           $request->setTemplateParam("{\"name\":\"{$name}\",\"action\":\"{$message}\"}");
       }else{
           $request->setTemplateParam("{\"code\":\"{$message}\"}");
       }
        //选填-发送短信流水号
        $request->setOutId("1234");
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
        $str=array();
        if($acsResponse->Code=="OK"){
            $str['code']="success";
            $str['msg']="发送成功!";
        }else{
            $str['code']="code";
            $str['msg']="发送失败,稍后重试!";
        }
        return $str;
    }

    static  function  _sendSms2($mobile,$message,$action,$name='',$time=''){
        ini_set("display_errors", "on");
        require(base_path().'/vendor/alidayus/api_sdk/vendor/autoload.php');
        //require_once dirname(__DIR__) . '/api_sdk/vendor/autoload.php';
        //此处需要替换成自己的AK信息
        Config::load();
        $accessKeyId = "LTAI8Iu9OevZOFP6";//参考本文档步骤2
        $accessKeySecret = "7TFTEtNVJgAxTzgKpUMJRfsh1PkvXL";//参考本文档步骤2
        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new DefaultAcsClient($profile);
        $request = new SendSmsRequest();
        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为1000个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName("升维网");
        //必填-短信模板Code
        if($action == 'register'){
            $request->setTemplateCode("SMS_84725297");//设置模板
        } elseif($action == 'findPwd') {
            $request->setTemplateCode("SMS_84725296");//设置模板
        }elseif($action=='change1'){
            $request->setTemplateCode("SMS_84725295");//设置模板
        }elseif($action=='answer'){
            $request->setTemplateCode("SMS_97795045");//设置模板
        }elseif($action=='reselects'){
            $request->setTemplateCode("SMS_119076714");//设置模板
        }elseif($action=='push'){
            $request->setTemplateCode("SMS_117527100");//设置模板
        }else{
            $request->setTemplateCode("SMS_84725295");//设置模板
        }
        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        if($action=='answer'){
            $request->setTemplateParam("{\"expert\":\"{$name}\",\"time\":\"{$time}\",\"action\":\"{$message}\"}");
        }elseif($action=='reselects'|| $action=='push'){
            $request->setTemplateParam("{\"name\":\"{$name}\",\"action\":\"{$message}\"}");
        }else{
            $request->setTemplateParam("{\"code\":\"{$message}\"}");
        }
        //选填-发送短信流水号
        $request->setOutId("1234");
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
        $str=array();
        if($acsResponse->Code=="OK"){
            $str['code']="success";
            $str['msg']="发送成功!";
        }else{
            $str['code']="code";
            $str['msg']="发送失败,稍后重试!";
        }
        return $str;
    }
}
