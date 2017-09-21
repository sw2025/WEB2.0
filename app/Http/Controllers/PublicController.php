<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;


class PublicController extends Controller
{
    //公共的上传图片的方法
    public function upload(){
        error_reporting(E_ALL | E_STRICT);
       // require_once("FileUpload/server/php/UploadHandler.php");
        $uploadHandler =new \App\UploadHandler(["upload_dir" => dirname(base_path()) . "/swUpload/images/", "upload_url" => dirname(base_path()) . "/swUpload/images/"]);
    }

    //办事的上传资料的方法
    public function eventUpload(){
        error_reporting(E_ALL | E_STRICT);
        // require_once("FileUpload/server/php/UploadHandler.php");
        $uploadHandler =new \App\UploadHandler(['correct_image_extensions' => true,'inline_file_types' => '/.+$/i' ,"upload_dir" => 'swUpload/event/'.session('userId').'/', "upload_url" => 'swUpload/event/'.session('userId').'/']);
    }


    public function download ()
    {
        $filepath = Crypt::decrypt($_GET['path']);
        $filepath = str_replace('\\','/',$filepath);
        $filepath = iconv('utf-8','GB2312', $filepath);

       /* header("Content-type: text/html;charset=utf-8");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($filepath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control:must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));*/
        header( "Content-Disposition:  attachment;  filename=".preg_replace('/^.+[\\\\\\/]/', '', $filepath));
        header('Content-Length: ' . filesize($filepath)); //下载文件大小
        readfile($filepath);  //读取文件内容
    }

    public function deleteDownload(Request $request)
    {
        $data = $request->input();
        $filepath = Crypt::decrypt($data['path']);
        $eventid = $data['eid'];
        $eventuserid = DB::table('t_e_event')->where('eventid',$eventid)->first();
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        $resuserid = DB::table('t_e_eventresponse')->where(['eventid' => $eventid,'state' => 3])->first();
        if(empty($eventuserid) || empty($resuserid)){
            return ['msg' => '非法操作','icon' => 2];
        }

        if($eventuserid->userid == session('userId')  ||  (!empty($expertid) && $expertid->expertid == $resuserid->expertid)){
            $filepath = str_replace('\\','/',$filepath);
            $filepath = iconv('utf-8','GB2312', $filepath);
            $filearr = explode('/',$filepath);
            $filename = array_pop($filearr);
            $dir = '../../swUpload/'.str_replace('../../swUpload/','',trim(join('/',$filearr),'/')).'/';
            if (is_dir($dir)) {
                if ($dp = opendir($dir)) {
                    while (($file=readdir($dp)) != false) {
                        if ($file!='.' && $file!='..') {
                            chmod($dir,0777);
                            unlink($dir.$file);
                        }
                    }
                    closedir($dp);
                    rmdir($dir);
                    return ['msg' => '删除成功','icon' => 1];
                } else {
                    return ['msg' => '无法打开该文件，删除失败','icon' => 2];
                }
                return ['msg' => '无法打开该文件，删除失败','icon' => 2];
            }
            return ['msg' => '该文件错误，删除失败','icon' => 2];
        } else {
            return ['msg' => '您不是办事专家或者企业','icon' => 2];
        }

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
        $markId=$_POST['markId'];
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
                if(date('Y-m-d H:i:s')<$member->endtime){
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
                                    $userID=DB::table("view_userrole")->where("expertid",$selectedIds[0])->pluck("userid");
                                    $payno=$this->getPayNum("消费");
                                    DB::table("t_u_bill")->insert([
                                        "userid"=>$userID,
                                        "type"=>"收入",
                                        "channel"=>"消费",
                                        "money"=>$selectedIds[1],
                                        "payno"=>$payno,
                                        "billtime"=>date("Y-m-d H:i:s",time()),
                                        "brief"=>"通过别人视频咨询，获取报酬",
                                        "consultid"=>$markId,
                                        "created_at"=>date("Y-m-d H:i:s",time()),
                                        "updated_at"=>date("Y-m-d H:i:s",time()),
                                    ]);
                                }
                                $paynos=$this->getPayNum("消费");
                                DB::table("t_u_bill")->insert([
                                    "userid"=>$userId,
                                    "type"=>"支出",
                                    "channel"=>"消费",
                                    "money"=>$_POST['totalCount'],
                                    "payno"=>$paynos,
                                    "billtime"=>date("Y-m-d H:i:s",time()),
                                    "brief"=>"进行消费",
                                    "consultid"=>$_POST['consultId'],
                                    "created_at"=>date("Y-m-d H:i:s",time()),
                                    "updated_at"=>date("Y-m-d H:i:s",time()),
                                ]);
                                $Ids=DB::table("T_C_CONSULTRESPONSE")
                                    ->select('expertid')
                                    ->where("consultid",$markId)
                                    ->whereRaw('T_C_CONSULTRESPONSE.id in (select max(id) from T_C_CONSULTRESPONSE group by  T_C_CONSULTRESPONSE.expertid)')
                                    ->distinct()
                                    ->get();
                                foreach ($Ids as $ID){
                                    if(in_array($ID->expertid,$expertIDS)){
                                        DB::table("T_C_CONSULTRESPONSE")->insert([
                                            "consultid"=>$markId,
                                            "state"=>3,
                                            "expertid"=>$ID->expertid,
                                            "responsetime"=>date("Y-m-d H:i:s",time()),
                                            "created_at"=>date("Y-m-d H:i:s",time()),
                                            "updated_at"=>date("Y-m-d H:i:s")
                                        ]);
                                    }else{
                                        DB::table("T_C_CONSULTRESPONSE")->insert([
                                            "consultid"=>$markId,
                                            "state"=>5,
                                            "expertid"=>$ID->expertid,
                                            "responsetime"=>date("Y-m-d H:i:s",time()),
                                            "created_at"=>date("Y-m-d H:i:s",time()),
                                            "updated_at"=>date("Y-m-d H:i:s")
                                        ]);
                                    }
                                }
                                DB::table("t_c_consultverify")->insert([
                                    "consultid"=>$markId,
                                    "configid"=>6,
                                    "verifytime"=>date("Y-m-d H:i:s",time()),
                                    "created_at"=>date("Y-m-d H:i:s",time()),
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
                            ->leftJoin("view_eventstatus","t_e_event.eventid","=","view_eventstatus.eventid")
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
                                    $userID=DB::table("view_userrole")->where("expertid",$selectedIds[0])->pluck("userid");
                                    $payno=$this->getPayNum("消费");
                                    DB::table("t_u_bill")->insert([
                                        "userid"=>$userID,
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
                                $paynos=$this->getPayNum("消费");
                                DB::table("t_u_bill")->insert([
                                    "userid"=>$userId,
                                    "type"=>"支出",
                                    "channel"=>"消费",
                                    "money"=>$_POST['totalCount'],
                                    "payno"=>$paynos,
                                    "billtime"=>date("Y-m-d H:i:s",time()),
                                    "brief"=>"进行消费",
                                    "consultid"=>$_POST['consultId'],
                                    "created_at"=>date("Y-m-d H:i:s",time()),
                                    "updated_at"=>date("Y-m-d H:i:s",time()),
                                ]);
                                $Ids=DB::table("T_E_EVENTRESPONSE")
                                    ->select('expertid')
                                    ->where("eventid",$markId)
                                    ->whereRaw('T_E_EVENTRESPONSE.id in (select max(id) from T_E_EVENTRESPONSE group by  T_E_EVENTRESPONSE.expertid)')
                                    ->distinct()
                                    ->get();
                                foreach ($Ids as $ID){
                                    if(in_array($ID->expertid,$expertIDS)){
                                        DB::table("T_E_EVENTRESPONSE")->insert([
                                            "eventid"=>$markId,
                                            "state"=>3,
                                            "expertid"=>$ID->expertid,
                                            "responsetime"=>date("Y-m-d H:i:s",time()),
                                            "created_at"=>date("Y-m-d H:i:s",time()),
                                            "updated_at"=>date("Y-m-d H:i:s")
                                        ]);
                                    }else{
                                        DB::table("T_E_EVENTRESPONSE")->insert([
                                            "eventid"=>$markId,
                                            "state"=>5,
                                            "expertid"=>$ID->expertid,
                                            "responsetime"=>date("Y-m-d H:i:s",time()),
                                            "created_at"=>date("Y-m-d H:i:s",time()),
                                            "updated_at"=>date("Y-m-d H:i:s")
                                        ]);
                                    }
                                }
                                DB::table("t_e_eventverify")->insert([
                                    "eventid"=>$markId,
                                    "configid"=>6,
                                    "verifytime"=>date("Y-m-d H:i:s",time()),
                                    "created_at"=>date("Y-m-d H:i:s",time()),
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
        $userId=$_POST['userId'];
        $type=$_POST['type'];
        $enterpriseId=DB::table("t_u_enterprise")->where("userid",$userId)->pluck("enterpriseid");
        $account=\UserClass::getMoney($userId);
        $result['account']=$account;
        $enterprise=DB::table("t_u_enterprise")
            ->leftJoin("t_u_enterpriseverify","t_u_enterprise.enterpriseid","=","t_u_enterpriseverify.enterpriseid")
            ->where("t_u_enterprise.enterpriseid",$enterpriseId)
            ->orderBy("t_u_enterpriseverify.id","desc")
            ->take(1)
            ->pluck('configid');
        if($enterprise!=3){
            $result['enterpriseid']=$enterpriseId;
            $result['code']="enterprise";
            return $result;
        }
        $members=DB::table("t_u_enterprisemember")
            ->leftJoin("t_u_memberright","t_u_enterprisemember.memberid","=","t_u_memberright.memberid")
            ->where("enterpriseid",$enterpriseId)->orderBy("ID","desc")->take(1)->get();
        if(count($members)){
            $currentTime=date('Y-m-d H:i:s');
            foreach ($members as $member){
                $endTime=$member->endtime;
                $startTime=$member->starttime;
                $eventCount=$member->eventcount;
                $consultCount=$member->consultcount;
            }
            if($currentTime<$endTime){
                if($type=="work"){
                    $counts=DB::table("t_e_event")
                        ->leftJoin("view_eventstatus","t_e_event.eventid","=","view_eventstatus.eventid")
                        ->whereIn("configid",[6,7,8])
                        ->whereBetween("t_e_event.eventtime",[$startTime,$endTime])
                        ->where("t_e_event.userid",session('userId'))
                        ->count();
                    if($counts>=$eventCount){
                        $result['code']="finsh";
                    }else{
                        $result['code']="success";
                    }
                }else{
                    $counts=DB::table("t_c_consult")
                        ->leftJoin("view_consultstatus","t_c_consult.consultid","=","view_consultstatus.consultid")
                        ->whereIn("configid",[6,7,8])
                        ->whereBetween("t_e_event.eventtime",[$startTime,$endTime])
                        ->where("t_c_consult.userid",session('userId'))
                        ->count();
                    if($counts>=$consultCount){
                        $result['code']="finsh";
                    }else{
                        $result['code']="success";
                    }
                }
            }else{
                $result['enterpriseId']=$enterpriseId;
                $result['code']="expried";
            }
        }else{
            $result['code']="error";
        }
        return $result;

    }

    /**首页服务介绍
     * @return mixed
     */
    public function  service(){
        return view('public.service');
    }
    /**首页关于我们
     * @return mixed
     */
    public function  us(){
        return view('public.us');
    }

    /**获取网易云token和accid;
     * @return array
     */
    public function getAccid(){
        $userId=$_POST['userId'];
        $res=array();
        $results=DB::table("t_u_user")->where("userid",$userId)->select("imtoken","accid")->get();
        if($results){
            $res['code']="success";
            foreach ($results as $result){
                $res['imtoken']=$result->imtoken;
                $res['accid']=$result->accid;
            }
        }else{
            $res['code']="error";
        }
        return $res;
    }

    /**获取群id
     * @return array
     */
    public  function getTeamId(){
        $res=array();
        $teamId=DB::table("t_s_im")->where(["consultid"=>$_POST['consultId']])->pluck("tid");
        if($teamId){
            $res['code']="success";
            $res['tid']=$teamId;
        }
        return $res;
    }
    /*
     * 获取昵称
     */
    public function getAvatar(){
        $res=array();
        $userId=$_POST['userId'];
        $phone=DB::table("T_U_USER")->where("userid",$userId)->pluck("phone");
        switch($_POST['type']){
            case "enterprise":
                $result=DB::table("t_u_enterprise")
                        ->leftJoin("t_u_enterpriseverify","t_u_enterpriseverify.enterpriseid","=","t_u_enterprise.enterpriseid")
                        ->orderBy('t_u_enterpriseverify.id','desc')
                        ->where("t_u_enterprise.userid",$userId)
                        ->take(1)
                        ->pluck('configid');
                if($result==3){
                    $showimages=DB::table("t_u_enterprise")->where("userid",$userId)->pluck("showimage");
                    $res['remark']="success";
                }else{                    $showimages='/images/avatar.jpg';
                    $res['remark']="error";
                }
                $res['enterAvatar']=$showimages;
            break;
            case "expert":
                $result=DB::table("t_u_expert")
                    ->leftJoin("t_u_expertverify","t_u_expertverify.expertid","=","t_u_expert.expertid")
                    ->where("t_u_expert.userid",$userId)
                    ->orderBy('t_u_expertverify.id','desc')
                    ->take(1)
                    ->pluck('configid');
                if($result==2){
                    $showimages=DB::table("t_u_expert")->where("userid",$userId)->pluck("showimage");
                    $res['expertRemark']="success";
                }else{
                    $showimages='/images/avatar.jpg';
                    $res['expertRemark']="error";
                }
                $res['expertAvatar']=$showimages;
            break;
        }
        $res['phone']=substr_replace($phone,'****',3,4);
        return $res;

    }
    public  function getMessage(){
        $res=array();
        $userId=$_POST['userId'];
        $counts=DB::table("t_m_systemmessage")->where(['receiveid'=>$userId,'state'=>0])->count();
        if($counts){
            $res['code']="error";
        }else{
            $res['code']="success";
        }
        return $res;
    }
    
   
    static private $postfilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    static private $illegalwords = ['傻逼','傻帽','bitch'];
    /**
     * 验证审核操作
     */
    static public function ValidationAudit($type,$data)
    {
        switch ($type){
            case 'need':
                $needid = $data['needid'];
                $needinfo = DB::table('t_n_need')->where('needid',$needid)->first();
                if(empty($needinfo) || empty($needinfo->userid) || empty($needinfo->needtype)){
                    $error =  ['msg' => '该需求不完整,已进入后台记录,请重新发起新的需求'];
                }

                if (preg_match("/".self::$postfilter."/is",$needinfo->brief) == 1){
                    $error =  ['msg' => '您提交的参数非法,系统已记录您的本次操作！','icon' => 2];
                }

                $blacklist="/".implode("|",self::$illegalwords)."/i";
                if(preg_match($blacklist, $needinfo->brief, $matches)){
                    $error =  ['msg' => '查找到非法敏感词汇[' . join(',',$matches) . '],已被系统记录,如有疑问请联系客服进行修改'];
                }

                if(mb_strlen($needinfo->brief) < 30 || mb_strlen($needinfo->brief) > 500){
                    $error =  ['msg' => '需求描述超出30-500字数限制'];
                }

                $veruftdomain = DB::table('t_common_domaintype')->where(['domainname' => $needinfo->domain1])->first();
                if(empty($veruftdomain)){
                    $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择'];
                } else {
                    $veruftdomain2 = DB::table('t_common_domaintype')->where(['domainname' => $needinfo->domain2,'parentid' => $veruftdomain->domainid])->first();
                    if(empty($veruftdomain2)){
                        $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择2'];
                    }
                }
                if(empty($error)){
                    $res = DB::table('t_n_needverify')->insert([
                        'needid' => $needid,
                        'configid' => 3,
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = ['msg' => '该需求已通过','icon' => 1];
                } else {
                    $res = DB::table('t_n_needverify')->insert([
                        'needid' => $needid,
                        'configid' => 2,
                        'remark' => $error['msg'],
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = [ 'msg' => '该需求未通过,原因:'.$error['msg'], 'icon' => 2,'needid' => $needid];
                }

                if($res){
                    return $msg;
                } else {
                    return ['msg' => '发布需求失败','icon' => 2];
                }

                break;
            case 'event':
                $eventid = $data['eventid'];
                $consultinfo = DB::table('t_e_event')->where('eventid',$eventid)->first();
                if(empty($consultinfo) || empty($consultinfo->userid)){
                    $error =  ['msg' => '该办事不完整,已进入后台记录,请重新发起新的办事'];
                }

                if (preg_match("/".self::$postfilter."/is",$consultinfo->brief) == 1){
                    $error =  ['msg' => '您提交的参数非法,系统已记录您的本次操作！','icon' => 2];
                }

                $blacklist="/".implode("|",self::$illegalwords)."/i";
                if(preg_match($blacklist, $consultinfo->brief, $matches)){
                    $error =  ['msg' => '查找到非法敏感词汇[' . join(',',$matches) . '],已被系统记录,如有疑问请联系客服进行修改'];
                }

                if(mb_strlen($consultinfo->brief) < 30 || mb_strlen($consultinfo->brief) > 500){
                    $error =  ['msg' => '办事描述超出30-500字数限制'];
                }

                $veruftdomain = DB::table('t_common_domaintype')->where(['domainname' => $consultinfo->domain1])->first();
                if(empty($veruftdomain)){
                    $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择'];
                } else {
                    $veruftdomain2 = DB::table('t_common_domaintype')->where(['domainname' => $consultinfo->domain2,'parentid' => $veruftdomain->domainid])->first();
                    if(empty($veruftdomain2)){
                        $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择2'];
                    }
                }
                if(empty($error)){
                    $res = DB::table('t_e_eventverify')->insert([
                        'eventid' => $eventid,
                        'configid' => 2,
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = ['msg' => '该办事已通过','icon' => 1];
                } else {
                    $res = DB::table('t_e_eventverify')->insert([
                        'eventid' => $eventid,
                        'configid' => 3,
                        'remark' => $error['msg'],
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = [ 'msg' => '该办事未通过,原因:'.$error['msg'], 'icon' => 2,'eventid' => $eventid];
                }

                if($res){
                    return $msg;
                } else {
                    return ['msg' => '发布需求失败','icon' => 2];
                }
            break;
            case 'video':
                $consultid = $data['consultid'];
                $consultinfo = DB::table('t_c_consult')->where('consultid',$consultid)->first();
                if(empty($consultinfo) || empty($consultinfo->userid)){
                    $error =  ['msg' => '该视频咨询不完整,已进入后台记录,请重新发起新的视频咨询'];
                }

                if (preg_match("/".self::$postfilter."/is",$consultinfo->brief) == 1){
                    $error =  ['msg' => '您提交的参数非法,系统已记录您的本次操作！','icon' => 2];
                }

                $blacklist="/".implode("|",self::$illegalwords)."/i";
                if(preg_match($blacklist, $consultinfo->brief, $matches)){
                    $error =  ['msg' => '查找到非法敏感词汇[' . join(',',$matches) . '],已被系统记录,如有疑问请联系客服进行修改'];
                }

                if(mb_strlen($consultinfo->brief) < 30 || mb_strlen($consultinfo->brief) > 500){
                    $error =  ['msg' => '咨询描述超出30-500字数限制'];
                }

                if(strtotime($consultinfo->starttime) < time() || strtotime($consultinfo->endtime) < time()){
                    $error =  ['msg' => '视频咨询开始时间或结束时间不能在今天以前'];
                }
                if(strtotime($consultinfo->starttime) > strtotime($consultinfo->endtime)){
                    $error =  ['msg' => '视频咨询开始时间结束时间错误'];
                }

                $veruftdomain = DB::table('t_common_domaintype')->where(['domainname' => $consultinfo->domain1])->first();
                if(empty($veruftdomain)){
                    $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择'];
                } else {
                    $veruftdomain2 = DB::table('t_common_domaintype')->where(['domainname' => $consultinfo->domain2,'parentid' => $veruftdomain->domainid])->first();
                    if(empty($veruftdomain2)){
                        $error =  [ 'msg' => '领域选择错误，请按照正确的格式进行选择2'];
                    }
                }
                if(empty($error)){
                    $res = DB::table('t_c_consultverify')->insert([
                        'consultid' => $consultid,
                        'configid' => 2,
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = ['msg' => '该视频咨询已通过','icon' => 1];
                } else {
                    $res = DB::table('t_c_consultverify')->insert([
                        'consultid' => $consultid,
                        'configid' => 3,
                        'remark' => $error['msg'],
                        'verifytime' => date('Y-m-d H:i:s')
                    ]);
                    $msg = [ 'msg' => '该视频咨询未通过,原因:'.$error['msg'], 'icon' => 2,'consultid' => $consultid];
                }
                if($res){
                    return $msg;
                } else {
                    return ['msg' => '发布视频咨询失败','icon' => 2];
                }
                break;
        }
    }

    /**匹配专家
     * @param Request $request
     * @return array
     */
    public function matchingExpert (Request $request) {
        if($request->ajax()){
            $data = $request->only('domain');
            $domain1 = explode('/',$data['domain'])[0];
            $domain2 = explode('/',$data['domain'])[1];
            $expertcount = DB::table('t_u_expert')
                ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                ->where('state.configid', 2)
                ->where(['domain1' => $domain1])
                ->where('domain2','like','%'.$domain2.'%')->count();
            $expertcount2 = DB::table('t_u_expert')
                ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                ->where('state.configid', 2)
                ->where(['domain1' => $domain1])->count();
            if($expertcount){
                return ['msg' => '<b style="font-size: 18px;">恭喜您,系统已为您检索到</b><br />【'.$data['domain'].'】 服务领域下有 <font color="red" size="5">'.$expertcount.'</font> 名专家<br />在【'.$domain1.'】 领域下共有 <font color="red" size="5">'.$expertcount2.'</font> 名专家','type' => 1];
            } elseif (!$expertcount && $expertcount2){
                return ['msg' => '<b style="font-size: 18px;">很抱歉</b><br />系统在 【'.$data['domain'].'】领域下并未找到专家<br />但是系统在 【'.$domain1.'】领域下检索到 <font color="red" size="5">'.$expertcount2.' </font>名专家,您是否继续操作','type' => 2];;
            } else {
                return ['msg' => '<b style="font-size: 18px;">很抱歉</b><br />系统在您选的 【'.$data['domain'].'】领域下并未找到专家<br />您可以自选专家或者联系客服进行处理,给您带来不便尽请谅解','type' => 3];
            }
        }
        return ['msg' => '非法操作','type' => 4];
    }

    static public function  eventPutExpert ($type,$data)
    {
        switch ($type){
            case 'event':

                $eventid = $data['eventid'];
                $eventinfo = DB::table('t_e_event')->where('eventid',$eventid)->first();
                DB::beginTransaction();
                try{
                    if($data['state']){
                        $expert = DB::table('t_u_expert')
                            ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                            ->where('state.configid', 2)
                            ->where(['domain1' => $eventinfo->domain1])
                            ->where('domain2','like','%'.$eventinfo->domain2.'%')
                            //->whereRaw(" expertid >= (select floor(RAND() * ((select max(expertid) from t_u_expert)-(select min(expertid) from `t_u_expert`)) + (select min(expertid) from t_u_expert))) limit 5")
                            ->whereRaw('1=1  group by rand()')
                            ->limit(5)
                            ->get();

                        $expert2 = DB::table('t_u_expert')
                            ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                            ->where('state.configid', 2)
                            ->where(['domain1' => $eventinfo->domain1])
                            //->whereRaw(" expertid >= (select floor(RAND() * ((select max(expertid) from t_u_expert)-(select min(expertid) from `t_u_expert`)) + (select min(expertid) from t_u_expert))) limit 5")
                            ->whereRaw('1=1  group by rand()')
                            ->limit(5)
                            ->get();


                        if(empty($expert) && empty($expert2)){
                            DB::table('t_e_eventverify')->insert([
                                'eventid' => $eventid,
                                'configid' => 3,
                                'remark' => '系统匹配专家失败',
                                'verifytime' => date("Y-m-d H:i:s",time()),
                                "created_at" => date("Y-m-d H:i:s",time()),
                                "updated_at" => date("Y-m-d H:i:s",time())
                            ]);
                            DB::table('t_e_eventresponse')->where('eventid',$eventid)->delete();
                            DB::commit();
                            return ['msg' => '系统匹配专家失败'.$eventid,'icon' => 2];

                        } elseif(!empty($expert)) {
                            foreach($expert as $v){
                                DB::table('t_e_eventresponse')->insert([
                                    'eventid' => $eventid,
                                    'expertid' => $v->expertid,
                                    "state"=> 1,
                                    'responsetime' => date("Y-m-d H:i:s",time()),
                                    "created_at" => date("Y-m-d H:i:s",time()),
                                    "updated_at" => date("Y-m-d H:i:s",time())
                                ]);
                                $expids[] = $v->expertid;
                            }
                        } elseif (!empty($expert2)){
                            foreach($expert2 as $v){
                                DB::table('t_e_eventresponse')->insert([
                                    'eventid' => $eventid,
                                    'expertid' => $v->expertid,
                                    "state"=> 1,
                                    'responsetime' => date("Y-m-d H:i:s",time()),
                                    "created_at" => date("Y-m-d H:i:s",time()),
                                    "updated_at" => date("Y-m-d H:i:s",time())
                                ]);
                                $expids[] = $v->expertid;
                            }
                        }
                    } else {
                        $expertIds=explode(",",$data['expertIds']);
                        foreach ($expertIds as $val){
                            DB::table("t_e_eventresponse")->insert([
                                "eventid" => $eventid,
                                "expertid" => $val,
                                "state"=> 0,
                                'responsetime' => date("Y-m-d H:i:s",time()),
                                "created_at" => date("Y-m-d H:i:s",time()),
                                "updated_at" => date("Y-m-d H:i:s",time()),
                            ]);
                            $expids[] = $val;
                        }
                    }
                    DB::table('t_e_eventverify')->insert([
                        'eventid' => $eventid,
                        'configid' => 4,
                        'verifytime' => date("Y-m-d H:i:s",time()),
                        "created_at" => date("Y-m-d H:i:s",time()),
                        "updated_at" => date("Y-m-d H:i:s",time())
                    ]);
                    DB::commit();
                    $expertsinfo = DB::table('t_u_expert')->whereIn('expertid',$expids)->select('expertname','showimage','expertid')->get();
                    $msg = ['msg' => '办事通过审核并推送到指定专家','icon' => 1,'expertsinfo' => $expertsinfo];
                }catch(Exception $e){
                    DB::rollback();
                    throw $e;
                    $msg = ['msg' => '推送失败','icon' => 2];
                }

                if($msg['icon'] == 2){
                    DB::table('t_e_eventverify')->insert([
                        'eventid' => $eventid,
                        'configid' => 3,
                        'remark' => '系统匹配专家失败',
                        'verifytime' => date("Y-m-d H:i:s",time()),
                        "created_at" => date("Y-m-d H:i:s",time()),
                        "updated_at" => date("Y-m-d H:i:s",time())
                    ]);
                    DB::table('t_e_eventresponse')->where('eventid',$eventid)->delete();
                } else {
                    return $msg;
                }
            break;

            case 'video':
                $consultid = $data['consultid'];
                $consultinfo = DB::table('t_c_consult')->where('consultid',$consultid)->first();
                $expids = [];

                DB::beginTransaction();
                try{
                    if($data['state']){
                        /*$expert = DB::table('t_u_expert')
                            ->where(['domain1' => $consultinfo->domain1,'industry' => $consultinfo->industry])
                            //->where('domain2','like','%'.$consultinfo->domain2.'%')
                            //->whereRaw(" expertid >= (select floor(RAND() * ((select max(expertid) from t_u_expert)-(select min(expertid) from `t_u_expert`)) + (select min(expertid) from t_u_expert))) limit 5")
                            ->whereRaw('domain2 like %'.$consultinfo->domain2.'%  group by rand()')
                            ->limit(5)
                            ->get();

                        $expert2 = DB::table('t_u_expert')
                            ->where(['domain1' => $consultinfo->domain1,'industry' => $consultinfo->industry])
                            //->whereRaw(" expertid >= (select floor(RAND() * ((select max(expertid) from t_u_expert)-(select min(expertid) from `t_u_expert`)) + (select min(expertid) from t_u_expert))) limit 5")
                            ->whereRaw('1=1  group by rand()')
                            ->limit(5)
                            ->get();*/
                        $expert = DB::table('t_u_expert')
                            ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                            ->where(['domain1' => $consultinfo->domain1,'state.configid' => 2])
                            ->whereRaw('domain2 like "%'.$consultinfo->domain2.'%"')
                            ->get();

                        $expert2 = DB::table('t_u_expert')
                            ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                            ->where('state.configid', 2)
                            ->where(['domain1' => $consultinfo->domain1])
                            ->get();

                        shuffle($expert);
                        shuffle($expert2);

                        if(empty($expert) && empty($expert2)){

                            DB::commit();
                            DB::table('t_c_consultverify')->insert([
                                'consultid' => $consultid,
                                'configid' => 3,
                                'remark' => '系统匹配专家失败',
                                'verifytime' => date("Y-m-d H:i:s",time()),
                                "created_at" => date("Y-m-d H:i:s",time()),
                                "updated_at" => date("Y-m-d H:i:s",time())
                            ]);
                            DB::table('t_c_consultresponse')->where('consultid',$consultid)->delete();

                            return ['msg' => '系统匹配专家失败'.$consultid,'icon' => 2];

                        } elseif(!empty($expert)) {

                            foreach($expert as $v){
                                $pushexpert = DB::table('view_expertresponsetime')
                                    ->where('expertid',$v->expertid)
                                    ->whereRaw('(starttime between  "'.$consultinfo->starttime.'" and "'.$consultinfo->endtime.'" or endtime between "'.$consultinfo->starttime .'" and "'.$consultinfo->endtime .'") and (state = 2 or state = 3)')
                                    ->first();
                                if(empty($pushexpert) && count($expids) < 5){
                                    DB::table('t_c_consultresponse')->insert([
                                        'consultid' => $consultid,
                                        'expertid' => $v->expertid,
                                        "state"=> 1,
                                        'responsetime' => date("Y-m-d H:i:s",time()),
                                        "created_at" => date("Y-m-d H:i:s",time()),
                                        "updated_at" => date("Y-m-d H:i:s",time())
                                    ]);
                                    $expids[] = $v->expertid;
                                }
                                if(count($expids) >= 5){
                                    break;
                                }

                            }
                            if(!count($expids)){
                                return ['msg' => '很抱歉系统未在您指定的时间段内找到合适的专家请重新更改下咨询时间谢谢','icon' => 2];
                            }


                        } elseif (!empty($expert2)){
                            foreach($expert2 as $v){
                                $pushexpert = DB::table('view_expertresponsetime')
                                    ->where('expertid',$v->expertid)
                                    ->whereRaw('(starttime between  "'.$consultinfo->starttime.'" and "'.$consultinfo->endtime.'" or endtime between "'.$consultinfo->starttime .'" and "'.$consultinfo->endtime .'") and (state = 2 or state = 3)')
                                    ->first();
                                if(empty($pushexpert) && count($expids) < 5){
                                    DB::table('t_c_consultresponse')->insert([
                                        'consultid' => $consultid,
                                        'expertid' => $v->expertid,
                                        "state"=> 1,
                                        'responsetime' => date("Y-m-d H:i:s",time()),
                                        "created_at" => date("Y-m-d H:i:s",time()),
                                        "updated_at" => date("Y-m-d H:i:s",time())
                                    ]);
                                    $expids[] = $v->expertid;
                                }
                                if(count($expids) >= 5){
                                    break;
                                }

                            }
                            if(!count($expids)){
                                return ['msg' => '很抱歉系统未在您指定的时间段内找到合适的专家请重新更改下咨询时间谢谢','icon' => 2];
                            }


                        }
                    } else {

                        $expertIds=explode(",",$data['expertIds']);
                        foreach ($expertIds as $val){
                            DB::table("t_c_consultresponse")->insert([
                                "consultid" => $consultid,
                                "expertid" => $val,
                                "state"=> 0,
                                'responsetime' => date("Y-m-d H:i:s",time()),
                                "created_at" => date("Y-m-d H:i:s",time()),
                                "updated_at" => date("Y-m-d H:i:s",time()),
                            ]);
                            $expids[] = $val;
                        }
                    }

                    DB::table('t_c_consultverify')->insert([
                        'consultid' => $consultid,
                        'configid' => 4,
                        'verifytime' => date("Y-m-d H:i:s",time()),
                        "created_at" => date("Y-m-d H:i:s",time()),
                        "updated_at" => date("Y-m-d H:i:s",time())
                    ]);
                    DB::commit();

                    $expertsinfo = DB::table('t_u_expert')->whereIn('expertid',$expids)->select('expertname','showimage','expertid')->get();
                    $msg = ['msg' => '恭喜您,视频咨询通过审核并推送到指定专家','icon' => 1,'expertsinfo' => $expertsinfo];

                }catch(Exception $e){
                    DB::rollback();
                    return  ['msg' => '推送失败','icon' => 2];
                    throw $e;
                }

                if($msg['icon'] == 2){
                    DB::table('t_c_consultverify')->insert([
                        'consultid' => $consultid,
                        'configid' => 3,
                        'remark' => '系统匹配专家失败',
                        'verifytime' => date("Y-m-d H:i:s",time()),
                        "created_at" => date("Y-m-d H:i:s",time()),
                        "updated_at" => date("Y-m-d H:i:s",time())
                    ]);
                    DB::table('t_c_consultresponse')->where('consultid',$consultid)->delete();
                    return $msg;
                } else {
                    return $msg;
                }
                break;


        }
    }

    /**
     * 定时获取办事的状态
     */
    public function getEventNewState(Request $request)
    {
        if($request->ajax()){
            if(!empty(session('userId'))){
                $data = $request->only('eventid','epid','state');
                $eventinfo = DB::table('t_e_event')->where('eventid',$data['eventid'])->first();
                $state = DB::table('t_e_eventprocess')->where(['eventid' => $data['eventid'],'epid' => $data['eventid']])->first();
                $newstate = DB::table('t_e_eventprocess')->where('eventid',$data['eventid'])->orderBy('pid','desc')->first();
                if(empty($state) && empty($eventinfo)){
                    return ['msg' => '非法操作(寻找不到该办事)','icon' => 2];
                } elseif (empty($state) && !empty($eventinfo) && empty($data['state'])){
                    return ['msg' => 'nostate','icon' => 3];
                } elseif (!empty($state) && !empty($eventinfo) && empty($data['state'])){
                    if ($state->state == 2){
                        return ['msg' => '对方确认了资料,是否查看','icon' => 1];
                    }
                }
                if($newstate->state == 2 && $data['state'] != $newstate->state && $newstate->epid != $data['epid']){
                    return ['msg' => '对方确认了资料,是否查看','icon' => 1];
                }
                return ['msg' => 'nostate','icon' => 3];
            }
            return ['msg' => '请登录','icon' => 2];
        }
        return ['msg' => '非法操作','icon' => 2];
    }

    /**
     * 获得是否有办事上传
     */
    public function getEventNewUpload(Request $request)
    {
        if($request->ajax()){
            if(!empty(session('userId'))){
                $data = $request->only('eventid','epid','state');
                $eventinfo = DB::table('t_e_event')->where('eventid',$data['eventid'])->first();
                $state = DB::table('t_e_eventprocess')->where(['eventid' => $data['eventid'],'epid' => $data['eventid']])->first();
                $newstate = DB::table('t_e_eventprocess')->where('eventid',$data['eventid'])->orderBy('pid','desc')->first();
                if(empty($state) && empty($eventinfo)){
                    return ['msg' => '非法操作(寻找不到该办事)','icon' => 2];
                } elseif (!empty($newstate) && !empty($eventinfo) && !isset($data['state'])){
                    if($newstate->state == 0 || $newstate->state == 1){
                        return ['msg' => '对方上传了新的文件,是否查看1','icon' => 1];
                    }
                }
                if(($newstate->state == 0 || $newstate->state == 1) && $data['state'] != $newstate->state && $newstate->epid != $data['epid']){
                    return ['msg' => '对方上传了新的文件,是否查看2','icon' => 1];
                }
                return ['msg' => 'noupload2','icon' => 3];
            }
            return ['msg' => '请登录','icon' => 2];
        }
        return ['msg' => '非法操作','icon' => 2];
    }
    
}
