<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /**
     * 登录页面
     * @return mixed
     */
    public function login(){
        $return = empty($_GET['returnurl']) ? 0 : 1 ;
        $type = empty($_GET['type']) ? null : $_GET['type'] ;
        $id = empty($_GET['id']) ? null : $_GET['id'] ;
        if($return){
            $returnurl = $_GET['returnurl'];
        } else {
            $returnurl = url('/');
        }
        return view("login.login",compact('return','returnurl','id','type'));
    }

    /**注册页面
     * @return mixed
     */
    public  function  register(){
        $return = empty($_GET['returnurl']) ? 0 : 1 ;
        $type = empty($_GET['type']) ? null : $_GET['type'] ;
        $id = empty($_GET['id']) ? null : $_GET['id'] ;
        if($return){
            $returnurl = $_GET['returnurl'];
        } else {
            $returnurl = url('/');
        }
        return view("login.register",compact('return','returnurl','id','type'));
    }

    /**找回密码
     * @return mixed
     */
    public  function  forget(){
        return view("login.forget");
    }

    /**登录验证
     * @return array
     */
    public  function loginHandle(){
        $phone=$_POST['phone'];
        $passWord=$_POST['passWord'];
        $type = $_POST['type'];
        $id = $_POST['id'];
        $datas=\UserClass::LoginVerify($phone,$passWord);
        if($datas['code'] == 'success' && $type && !empty($id) && $id != 'NaN'){
            $datas['data'] = ShowController::getPayData($datas['userId'],$type,$id);
        }
        return $datas;
    }

    /**注册验证
     * @return array
     * @throws \Exception
     */
    public function  registerHandle(Request $request){
        $post = $request->only(['phone','passWord','codes','role']);
        $phone=$post['phone'];
        $pwd=$post['passWord'];
        $code=$post['codes'];
        $role=$post['role'];
        $type = $_POST['type'];
        $id = $_POST['id'];
        $str=array();
       if(Cache::has($phone)){
            $smsCode=Cache::get($phone);
            if(trim($smsCode)!=trim($code)){
                $str['code']="code";
                $str['msg']="验证码输入错误!";
                return $str;
            }
        }else{
            $str['code']="code";
            $str['msg']="没有生成验证码或已过期,稍后重试!";
            return $str;
        }
        $datas=\UserClass::regVerify($phone,$role,$pwd);
        if($datas['code'] == 'success' && $type && !empty($id) && $id != 'NaN'){
            $datas['data'] = ShowController::getPayData($datas['userId'],$type,$id);
        }
        return $datas;
    }

    /**找回密码
     * @return array
     */
    public  function  forgetHandle(){
        $phone=$_POST['phone'];
        $code=$_POST['code'];
        $passWord=$_POST['passWord'];
        $str=array();
        if(Cache::has($phone)){
            $smsCode=Cache::get($phone);
            if($smsCode!=$code){
                $str['code']="code";
                $str['msg']="验证码输入错误!";
                return $str;
            }
        }else{
            $str['code']="code";
            $str['msg']="没有生成验证码,稍后重试!";
            return $str;
        }
        $data=\UserClass::forgetVerify($phone,$passWord);
        return $data;
    }
    
    public  function  quit(Request $request){
        $request->session()->flush();
        $result=array();
        if(session("userId")){
            $result['code']="error";
        }else{
            $result['code']="success";
        }
        return $result;
    }

    /**
     * 发送验证码
     * @return mixed
     */
    public function getCode(Request $request){
        // 获取手机号码
        $post = $request->input();
        $phone = $post['phone'];
        $action =$post['action'];
        $res=array();
        switch ($action){
            case "register":
                $user = User::where('phone', $phone)->first();
                if($user) {
                    $res['code']="phone";
                    $res['msg']="该手机号已经注册!";
                    return $res;
                }
                break;
            case "findPwd":
                $user = User::where('phone', $phone)->first();
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

        // 发送验证码短信
        $res = $this->_sendSms($phone, $randNum, $action);
        return $res;
    }

   
    


}
