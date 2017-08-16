<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    /**获取余额
     * @return array
     * @throws \Exception
     */
    public function returnMoney(){
        $result=array();
        $userId=$_POST['userId'];
        $expertIds=$_POST['expertIds'];
        $type=$_POST['type'];
        $enterpriseId=DB::table("view_userrole")->where("userid",$userId)->pluck("enterpriseid");
        if($enterpriseId){
            $members=DB::table("t_u_enterprisemember")
                        ->leftJoin("t_u_memberright","t_u_enterprisemember.memberid","=","t_u_memberright.memberid")
                        ->where("enterpriseid",$enterpriseId)
                        ->get();
            if($members){
                $currentTime=time();
                foreach ($members as $member){
                    $endTime=strtotime($member->endtime);
                    $eventCount=$member->eventcount;
                    $consultCount=$member->consultcount;
                }
                if($currentTime<$endTime){
                    if($type=="consult"){
                        $counts=DB::table("t_c_consult")
                            ->leftJoin("view_consultstatus","t_c_consult.consultid","=","view_consultstatus.consultid")
                            ->whereIn("configid",[6,7,8])
                            ->where("t_c_consult.userid",session('userId'))
                            ->count();
                        if($counts>=$consultCount){
                            $result['code']="payMoney";
                            $account=\UserClass::getMoney($userId);
                            $result['account']=$account;
                        }else{
                            try{
                                foreach ($expertIds as $expertId){
                                    $selectedIds=explode("/",$expertId);
                                    $expertIDS[]=$selectedIds[0];
                                    $userId=DB::table("view_userrole")->where("expertid",$selectedIds[0])->pluck("userid");
                                    $payno=$this->getPayNum("消费");
                                    DB::table("t_u_bill")->insert([
                                        "userid"=>$userId,
                                        "type"=>"收入",
                                        "channel"=>"消费",
                                        "money"=>$selectedIds[1],
                                        "payno"=>$payno,
                                        "billtime"=>date("Y-m-d H:i:s",time()),
                                        "brief"=>"通过别人视频咨询，获取报酬",
                                        "consultid"=>$_POST['consultId'],
                                        "created_at"=>date("Y-m-d H:i:s",time()),
                                        "updated_at"=>date("Y-m-d H:i:s",time()),
                                    ]);
                                }
                                DB::table("t_c_consultresponse")->where("consultid",$_POST['consultId'])->whereIn("expertid",$expertIDS)->update([
                                    "state"=>3,
                                    "updated_at"=>date("Y-m-d H:i:s")
                                ]);
                                DB::table("t_c_consultresponse")->where("consultid",$_POST['consultId'])->whereNotIn("expertid",$expertIDS)->update([
                                    "state"=>4,
                                    "updated_at"=>date("Y-m-d H:i:s")
                                ]);
                                DB::table("t_c_consultverify")->where("consultid",$_POST['consultId'])->update([
                                    "configid"=>6,
                                    "updated_at"=>date("Y-m-d H:i:s",time())
                                ]);
                            }catch(Exception $e){
                                throw $e;
                            }
                            if(!isset($e)){
                                $result['code']="success";
                            }else{
                                $result['code']="error";
                            }
                        }
                    }else{
                        $counts=DB::table("t_e_event")
                            ->leftJoin("view_eventstatus","t_e_event.expertid","=","view_eventstatus.expertid")
                            ->whereIn("configid",[6,7,8])
                            ->where("userid",session('userId'))
                            ->count();
                        if($counts>=$eventCount){
                            $result['code']="payMoney";
                            $account=\UserClass::getMoney($userId);
                            $result['account']=$account;
                        }else{
                            try{
                                foreach ($expertIds as $expertId){
                                    $selectedIds=explode("/",$expertId);
                                    $expertIDS[]=$selectedIds[0];
                                    $userId=DB::table("view_userrole")->where("expertid",$selectedIds[0])->pluck("userid");
                                    $payno=$this->getPayNum("消费");
                                    DB::table("t_u_bill")->insert([
                                        "userid"=>$userId,
                                        "type"=>"收入",
                                        "channel"=>"消费",
                                        "money"=>$selectedIds[1],
                                        "payno"=>$payno,
                                        "billtime"=>date("Y-m-d H:i:s",time()),
                                        "brief"=>"通过替别人办事，获取报酬",
                                        "consultid"=>$_POST['consultId'],
                                        "created_at"=>date("Y-m-d H:i:s",time()),
                                        "updated_at"=>date("Y-m-d H:i:s",time()),
                                    ]);
                                }
                                DB::table("t_c_consultresponse")->where("consultid",$_POST['consultId'])->whereIn("expertid",$expertIDS)->update([
                                    "state"=>3,
                                    "updated_at"=>date("Y-m-d H:i:s")
                                ]);
                                DB::table("t_c_consultresponse")->where("consultid",$_POST['consultId'])->whereNotIn("expertid",$expertIDS)->update([
                                    "state"=>4,
                                    "updated_at"=>date("Y-m-d H:i:s")
                                ]);
                                DB::table("t_c_consultverify")->where("consultid",$_POST['consultId'])->update([
                                    "configid"=>6,
                                    "updated_at"=>date("Y-m-d H:i:s",time())
                                ]);
                            }catch(Exception $e){
                                throw $e;
                            }
                            if(!isset($e)){
                                $result['code']="success";
                            }else{
                                $result['code']="error";
                            }
                        }
                    }
                }else{
                    $result['code']="expried";
                }
            }else{
                $result['code']="noMember";
            }
        }else{
            $result['code']="noEnterprise";
        }

        return $result;

    }

    /**判断是否是会员
     * @param Request $request
     * @return array
     */
    public function  IsMember(Request $request){
        $result=array();
        $userId=$request->only("userId");
        $enterpriseId=DB::table("t_u_enterprise")->where("userid",$userId)->pluck("enterpriseid");
        $members=DB::table("t_u_enterprisemember")->where("enterpriseid",$enterpriseId)->get();
        if($members){
            $currentTime=time();
            foreach ($members as $member){
                $endTime=strtotime($member->endtime);
            }
            if($currentTime<$endTime){
                $result['code']="success";
            }else{
                $result['code']="expried";
            }
        }else{
            $result['code']="error";
        }
        return $result;

    }
    
   

    
    
    
}
