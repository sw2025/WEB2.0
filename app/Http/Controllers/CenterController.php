<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PhpSpec\Exception\Exception;

class CenterController extends Controller
{
    /**基本资料
     * @return mixed
     */
    public function index(){
        $userId=session("userId");
        $data=DB::table("T_U_USER")->where("userid",2)->first();
        return view("ucenter.index",compact("data"));
    }

    /**修改手机号
     * @return mixed
     */
    public function  changeTel(){
        return view("ucenter.changeTel");
    }

    /**修改手机号2
     * @return mixed
     */
    public function  changeTel2(){
        return view("ucenter.changeTel2");
    }

    /**
     * 充值提现
     * @return mixed
     */
    public function recharge(){
        return view("ucenter.recharge");
    }

    /**充值
     * @return mixed
     */
    public function rechargeMoney(){
        return view("ucenter.rechargeMoney");
    }

    /**提现
     * @return mixed
     */
    public function cash(){
        return view("ucenter.cash");
    }

    /**我的信息
     * @return mixed
     */
    public  function  myinfo(){
        $userId=session("userId");
       
        return view("ucenter.myinfo");
    }
    /**我的需求
     * @return mixed
     */
    public function  myNeed(){
        return view("ucenter.myNeed");
    }

    /**需求详情
     * @return mixed
     */
    public function  needDetail(){
        return view("ucenter.needDetail");
    }

    /**发布需求
     * @return mixed
     */
    public function  supplyNeed(){
        return view("ucenter.supplyNeed");
    }

    /**专家认证
     * @return mixed
     */
    public function  expert(){
        return view("ucenter.expert");
    }

    /**专家资源库
     * @return mixed
     */
    public function  resource(){
        return view("ucenter.resource");
    }

    /**专家资源详情
     * @return mixed
     */
    public  function resDetail(){
        return view("ucenter.resDetail");
    }

    /**个人中心获取验证码
     * @return array
     */
    public function  getcodes(){
        $res=array();
        $userId=$_POST['userId'];
        $phone = DB::table("T_U_USER")->where("userid",$userId)->pluck("phone");
        $action =$_POST['action'];
        switch ($action){
            case "registr":
                $user = User::where('phonenumber', $phone)->first();
                if($user) {
                    $res['code']="phone";
                    $res['msg']="该手机号已经注册!";
                    return $res;
                }
                break;
            case "forget":
                $user = User::where('phonenumber', $phone)->first();
                if(!$user) {
                    $res['code']="phone";
                    $res['msg']="该手机号不存在!";
                    return $res;
                }
                break;
        }
        // 获取验证码
        $randNum = $this->__randStr(6, 'NUMBER');

        // 验证码存入缓存 10 分钟
        $expiresAt = 20;

        Cache::put($phone, $randNum, $expiresAt);

        // // 短信内容
        // $smsTxt = '验证码为：' . $randNum . '，请在 10 分钟内使用！';

        // 发送验证码短信
        $res = $this->_sendSms($phone, $randNum, $action);
        return $res;
    }

    /**修改手机号验证验证码
     * @return array
     */
    public function  returnCode(){
        $userId=$_POST['userId'];
        $code=$_POST['code'];
        $str=array();
        $phone=DB::table("T_U_USER")->where("userid",$userId)->pluck("phone");
        if(Cache::has($phone)){
            $smsCode=Cache::get($phone);
            if($smsCode!=$code){
                $str['code']="code";
                $str['msg']="验证码输入错误!";
                return $str;
            }else{
                $str['code']="success";
                return $str;
            }
        }else{
            $str['code']="code";
            $str['msg']="没有生成验证码,稍后重试!";
            return $str;
        }
    }

    /**
     * 修改手机号2
     * @return array
     */
    public function changeNewPhone(Request $request){
        $userId=$_POST['userId'];
        $newPhone=$_POST['phone'];
        $code=$_POST['code'];
        $str=array();
        $phone=DB::table("T_U_USER")->where("userid",$userId)->pluck("phone");
        if(Cache::has($phone)){
            $smsCode=Cache::get($phone);
            if($smsCode!=$code){
                $str['code']="code";
                $str['msg']="验证码输入错误!";
                return $str;
            }else{
               $str=$this->verifyPhones($newPhone,$userId,$request);
                return $str;
            }
        }else{
            $str['code']="code";
            $str['msg']="没有生成验证码,稍后重试!";
            return $str;
        }

    }

    /**验证新的手机号
     * @param $newPhone
     * @param $userId
     * @return array
     */
    public  function verifyPhones($newPhone,$userId,$request){
        $result=array();
        $counts=DB::table("T_U_USER")->where("phone",$newPhone)->count();
        if($counts){
            $result['code']="phone";
            $result['msg']="该手机号已经注册!";
            return $result;
        }
        $updates=DB::table("T_U_USER")->where("userid",$userId)->update([
            "phone"=>$newPhone,
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($updates){
            $request->session()->flush();
            $result['code']="success";
            return $result;
        }else{
            $result['code']="phone";
            $result['msg']="修改失败,重新修改";
            return $result;
        }
    }

    /**修改基本资料
     * @return array
     */
    public function changeBasics(){
        $nickName=!empty($_POST['nickName'])?$_POST['nickName']:"";
        $avatar=!empty($_POST['myAvatar'])?$_POST['myAvatar']:"avatar.jpg";
        $userId=$_POST["userId"];
        $res=array();
        $result=DB::table("T_U_USER")->where("userid",$userId)->update([
            "nickname"=>$nickName,
            "avatar"=>$avatar,
            "updated_at"=>date("Y-m-d H:i:s",time())
        ]);
        if($result){
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return $res;
    }
    
    

    
   

}
