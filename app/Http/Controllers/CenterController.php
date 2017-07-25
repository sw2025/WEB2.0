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
        $userId=session("userId");
        $incomes=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"收入"])->sum("money");
        $pays=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"支出"])->sum("money");
        $expends=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"在途"])->sum("money");
        $balance=$incomes-$pays-$expends;
        $bankcard=DB::table("t_u_bank")->where(["userid"=>$userId,"state"=>0])->pluck("bankcard");
        return view("ucenter.recharge",compact("incomes","pays","expends","balance","bankcard"));
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
        $userId=session("userId");
        $incomes=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"收入"])->sum("money");
        $pays=DB::table("T_U_BILL")->where("userid",$userId)->whereIn("type",["支出","在途"])->sum("money");
        $balance=$incomes-$pays;
        return view("ucenter.cash",compact("balance"));
    }
    public function applicationCash(){
        $money=$_POST['money'];
        $userId=$_POST['userId'];
        $result=DB::table("t_u_bill")->insert([
            "userid"=>$userId,
            "type"=>"在途",
            "channel"=>"提现申请",
            "money"=>$money,
            "billtime"=>date("Y-m-d H:i:s",time()),
            "userid"=>$userId,
        ]);
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

    /**添加银行卡
     * @return mixed
     */
    public  function  card(){
        return view("ucenter.card");
    }
    /**银行卡处理
 * @return mixed
 */
    public  function  cardHandle(){
        $res=array();
        $userId=session("userId");
        $counts=DB::table("t_u_bank")->where("userid",$userId)->count();
        if($counts){
            $result=DB::table("t_u_bank")->where("userid",$userId)->update([
                "userid"=>$userId,
                "bankname"=>$_POST['bankName'],
                "account"=>$_POST['account'],
                "bankcard"=>$_POST['bankCard'],
                "bankfullname"=>$_POST['bankFullName'],
                "state"=>0,
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }else{
            $result=DB::table("t_u_bank")->insert([
                "userid"=>$userId,
                "bankname"=>$_POST['bankName'],
                "account"=>$_POST['account'],
                "bankcard"=>$_POST['bankCard'],
                "bankfullname"=>$_POST['bankFullName'],
                "state"=>0,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }
        if($result){
           $res['code']="success";
        }else{
           $res['code']="error";
        }
        return  $res;

    }
    /**银行卡处理
     * @return mixed
     */
    public  function  card2(){
        return view("ucenter.card2");
    }
    /**银行卡处理
     * @return mixed
     */
    public  function  verifyCard(Request $request){
        $res=array();
        $data=$request->all();
        $money=DB::table("t_u_bank")->where("userId",$data['userId'])->pluck("money");
        if($money==$data['money']){
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return $res;

    }

    /**个人中心首页充值，消费记录
     * @return array
     */
    public  function getRecord(){
        $type=$_POST['type'];
        $startPage=isset($_POST['startPage'])?$_POST['startPage']:1;
        $offset=($startPage-1)*2;
        $userId=session("userId");
        $result=array();
        $counts=DB::table("T_U_BILL")->where("userid",$userId)->where("type",$type)->count();
        $counts=!empty(ceil($counts/2))?ceil($counts/2):0;
        $datas=DB::table("T_U_BILL")->select("brief","payno","money","created_at","type")->where("userid",$userId)->where("type",$type)->skip($offset)->take(2)->get(2);
        foreach ($datas as $data){
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            if($data->type=="收入"){
                $data->money="+".$data->money;
            }else{
                $data->money="-".$data->money;
            }
        }
        if($datas){
            $result['code']="success";
            $result['counts']=$counts;
            $result['startPage']=$startPage;
            $result['msg']=$datas;
        }else{
            $result['code']="error";
        }
        return $result;

    }
}
