<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class MyEnterpriseController extends Controller
{
    /**专家资源库
     * @return mixed
     */
    public function  resource(Request $request){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','ext.expertid' ,'=' ,'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll','ext.expertid' ,'=' ,'coll.expertid')
            ->leftJoin('view_expertmesscount as mess','ext.expertid' ,'=' ,'mess.expertid')
            ->leftJoin('view_expertstatus as status','ext.expertid' ,'=' ,'status.expertid')
            ->select('ext.*','user.phone','fee.fee','fee.state','coll.count as collcount','mess.count as messcount');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'),'remark' => 1])->lists('expertid');
        }
        //用户回复的数量
        $msgcount = count(DB::table('t_u_messagetoexpert')->where('userid',session('userId'))->groupBy('expertid')->lists('expertid'));

        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $consult=(isset($get['consult']) && $get['consult'] != "null") ? $get['consult'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("category"=>$role):array();
            $supplywhere = !empty($supply)?array("ext.domain1"=>$supply[0],'ext.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            if(!empty($consult) && $consult == '收费'){
                $consultwhere = ['fee.state' => 1];
                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere)->where($consultwhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.expertname","like","%".$searchname."%");
            }
            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('ext.expertid in (select  expertid from t_u_collectexpert  where userid='.session('userId').' and remark=1)');
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('ext.expertid in (select  expertid from t_u_messagetoexpert  where userid='.session('userId').' group by expertid)');
                        break;
                }
            } else {
                $obj = $obj->whereIn('status.configid',[2,4]);
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.expertid',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->paginate(4);
            return view("myenterprise.resource",compact('cate','msgcount','searchname','datas','role','collectids','consult','action','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(4);
        $ordertime = 'desc';
        return view("myenterprise.resource",compact('cate','datas','ordertime','collectids','msgcount'));
    }

    /**专家资源详情
     * @return mixed
     */
    public  function resDetail($expertid){
        //取出指定的供求信息
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','ext.expertid' ,'=' ,'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll','ext.expertid' ,'=' ,'coll.expertid')
            ->leftJoin('view_expertmesscount as mess','ext.expertid' ,'=' ,'mess.expertid')
            ->select('ext.*','user.phone','fee.fee','fee.state');
        $obj = clone $datas;
        $datas = $datas->where('ext.expertid',$expertid)->first();
        //取出同类下推荐的供求
        $info = ['domain1' => $datas->domain1,'domain2' =>$datas->domain2,'expertid' => $datas->expertid];
        $recommendNeed = $obj->where('ext.expertid','<>',$info['expertid'])->orderBy('expertid','desc');
        $obj2 = clone $recommendNeed;
        //取出相同二级类下面的供求
        $recommendNeed = $recommendNeed->where(['ext.domain2' => $info['domain2'],'ext.domain1' => $info['domain1']])->take(5)->get();
        //不足5条时 在一级类下面查找供求
        if(count($recommendNeed) < 5){
            $commedomain1 = $obj2->where('ext.domain1',$info['domain1'])->where('ext.domain2','<>',$info['domain2'])->take(5-count($recommendNeed))->get();
            $recommendNeed = array_merge($recommendNeed,$commedomain1);
        }
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'),'remark' => 1])->lists('expertid');
        }

        //查询留言的信息
        $message = DB::table('t_u_messagetoexpert as msg')
            ->leftJoin('view_userrole as view','view.userid', '=','msg.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'msg.userid')
            ->leftJoin('t_u_user as user2','user2.userid' ,'=' ,'msg.use_userid')
            ->where('msg.expertid',$expertid)
            ->select('msg.*','ent.enterprisename','ext.expertname','user.avatar','user.nickname','user.phone','user2.nickname as nickname2','user2.phone as phone2')
            ->orderBy('messagetime','desc')
            ->get();
        //分组取出每个回复的数量
        $getmsgcount = DB::table('t_u_messagetoexpert')->where('expertid',$expertid)->groupBy('parentid')->select(DB::raw('parentid ,count(*) as count'))->having('parentid','<>',0)->get();
        $msgcount = [];
        foreach ($getmsgcount as $k => $v) {
            $msgcount[$v->parentid] = $v->count;
        }
        return view("myenterprise.resDetail",compact('datas','recommendNeed','message','collectids','msgcount'));
    }

    /**会员认证
     * @return mixed
     */
    public  function uct_member(){
        return view("myenterprise.member");
    }

    /**会员认证2
 * @return mixed
 */
    public  function member2(){
        return view("myenterprise.member2");
    }
    /**会员认证3
     * @return mixed
     */
    public  function member3(){
        return view("myenterprise.member3");
    }
    /**会员认证4
     * @return mixed
     */
    public  function member4(){
        return view("myenterprise.member4");
    }

    /**办事服务
     * @return mixed
     */
    public  function works(){
        $userId=session('userId');
        $type=isset($_GET['type'])?$_GET['type']:0;
        $typeWhere=($type!=0)?array("configid"=>$type):array();
        $result=DB::table("t_e_event")
                ->leftJoin("t_e_eventverify","t_e_eventverify.eventid","=","t_e_event.eventid")
                ->select("t_e_event.eventid","t_e_event.domain1","t_e_event.domain2","t_e_event.created_at","t_e_event.brief")
                ->whereRaw('t_e_eventverify.id in (select max(id) from t_e_eventverify group by eventid)')
                ->where("t_e_event.userid",$userId)
                ->where($typeWhere);
        $count=clone $result;
        $datas=$result->orderBy("t_e_event.created_at","desc")->paginate(2);
        $counts=$count->count();
        foreach ($datas as $data){
            $data->work=$data->domain1."/".$data->domain2;
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            $totals=DB::table("t_e_eventresponse")->where("eventid",$data->eventid)->count();
            if($totals!=0){
                $data->state="指定专家";
            }else{
                $data->state="匹配专家";
            }
        }
        switch($type){
            case 0:
                $type="全部";
                break;
            case 1:
                $type="办事审核";
                break;
            case 3:
                $type="审核失败";
                break;
            case 4:
                $type="邀请专家";
                break;
            case 5:
                $type="专家响应";
                break;
            case 6:
                $type="正在办事";
                break;
            case 7:
                $type="已完成";
            break;
            case 9:
                $type="异常终止";
            break;
        }
        return view("myenterprise.works",compact("datas","type","counts"));
    }
    /**办事详情
     * @param $eventId
     * @return mixed
     */
    public function workDetail($eventId){
        $datas=DB::table("t_e_event")
                    ->leftJoin("t_e_eventverify","t_e_eventverify.eventid","=","t_e_event.eventid")
                    ->where("t_e_event.eventid",$eventId)
                    ->whereRaw('t_e_eventverify.id in (select max(id) from t_e_eventverify group by eventid)')
                    ->get();
        $counts=DB::table("t_e_eventresponse")->where("eventid",$eventId)->count();
        foreach ($datas as $data){
           $configId=$data->configid;
            if($counts!=0){
                $data->state="指定专家";
            }else{
                $data->state="系统分配";
            }
        }
        switch($configId){
            case 5:
                $selExperts=DB::table("t_e_eventresponse")
                    ->leftJoin("t_u_expert","t_e_eventresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_e_eventresponse.state",2)
                    ->where("eventid",$eventId)
                    ->get();
                $selected=count($selExperts);
            break;
            case 7:
                $selExperts=DB::table("t_e_eventresponse")
                    ->leftJoin("t_e_eventtcomment","t_e_eventresponse.expertid","=","t_e_eventtcomment.expertid" )
                    ->leftJoin("t_u_expert","t_e_eventresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_e_eventresponse.state",3)
                    ->where("t_e_eventresponse.eventid",$eventId)
                    ->get();
        }
        $selExperts=!empty($selExperts)?$selExperts:"";
        $selected=!empty($selected)?$selected:"";
        $view="works".$configId;
        return view("myenterprise.".$view,compact("datas","counts","selected","selExperts","eventId"));
    }
    /**申请办事服务
     * @return mixed
     */
    public function applyWork(){
        $cate = DB::table('t_common_domaintype')->get();
        return view("myenterprise.work1",compact("cate"));
    }
    /**保存申请的办事
     * @return array
     * @throws Exception
     */
    public function saveEvent(){
        $userId=session("userId");
        $result=array();
        $domain=explode("/",$_POST['domain']);
        DB::beginTransaction();
        try{
            $eventId=DB::table("t_e_event")->insertGetId([
                "userid"=>$userId,
                "domain1"=>$domain[0],
                "domain2"=>$domain[1],
                "brief"=>$_POST['describe'],
                "isRandom"=>$_POST['isAppoint'],
                "eventtime"=>date("Y-m-d H:i:s",time()),
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
            DB::table("t_e_eventverify")->insert([
                "eventid"=>$eventId,
                "configid"=>1,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
            if($_POST['state']==0){
                $expertIds=explode(",",$_POST['expertIds']);
                foreach ($expertIds as $val){
                    DB::table("t_e_eventresponse")->insert([
                        "eventid"=>$eventId,
                        "expertid"=>$val,
                        "state"=>0,
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                }
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }

    /**筛选专家
     * @param Request $request
     * @return mixed
     */
    public function  reselect(Request $request){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','ext.expertid' ,'=' ,'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll','ext.expertid' ,'=' ,'coll.expertid')
            ->leftJoin('view_expertmesscount as mess','ext.expertid' ,'=' ,'mess.expertid')
            ->leftJoin('view_expertstatus as status','ext.expertid' ,'=' ,'status.expertid')
            ->whereIn('status.configid',[2,4])
            ->select('ext.*','user.phone','fee.fee','fee.state','coll.count as collcount','mess.count as messcount');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'),'remark' => 1])->lists('expertid');
        }
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $consult=(isset($get['consult']) && $get['consult'] != "null") ? $get['consult'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("category"=>$role):array();
            $supplywhere = !empty($supply)?array("ext.domain1"=>$supply[0],'ext.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            if(!empty($consult) && $consult == '收费'){
                $consultwhere = ['fee.state' => 1];
                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere)->where($consultwhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.expertname","like","%".$searchname."%");
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.expertid',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->paginate(2);
            return view("myenterprise.reselect",compact('cate','searchname','datas','role','collectids','consult','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(2);
        $ordertime = 'desc';
        return view("myenterprise.reselect",compact('cate','datas','ordertime','collectids'));
    }
    /**专家反选
     * @return array
     */
    public function  selectExpert(){
        $result=array();
        $expertIds=$_POST['expertIds'];
        try{
            foreach ($expertIds as $expertId){
                DB::table("t_e_eventresponse")->where("eventid",$_POST['eventId'])->where("expertid",$expertId)->update([
                    "state"=>3,
                    "updated_at"=>date("Y-m-d H:i:s")
                ]);
            }
            DB::table("t_eventverify")->where("eventid",$_POST['evnetId'])->update([
                "configid"=>6,
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);
        }catch (Exception $e){
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;

    }

    /**给专家星级评论
     * @return array
     */
    public  function toExpertMsg(){
        $result=array();
        $eventId=$_POST['eventId'];
        try{
            DB::table("t_e_eventtcomment")->insert([
               "eventid"=>$eventId,
               "expertid"=>$_POST['expertId'],
               "score"=>$_POST['score'],
               "comment"=>"",
               "commenttime"=>date("Y-m-d H:i:s",time()),
               "created_at"=>date("Y-m-d H:i:s",time()),
               "updated_at"=>date("Y-m-d H:i:s",time()),
               ]);
        }catch(Exception $e){
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }

    /**给专家评论
     * @return array
     */
    public function toExpertContent(){
        $result=array();
        $eventId=$_POST['eventId'];
        try{
            DB::table("t_e_eventtcomment")->where(["eventid"=>$eventId,"expertid"=>$_POST['expertId']])->update([
                "comment"=>$_POST['content'],
                "commenttime"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }catch(Exception $e){
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }

    /**视频咨询
     * @return mixed
     */
    public function video(){
        $userId=session('userId');
        $type=isset($_GET['type'])?$_GET['type']:0;
        $typeWhere=($type!=0)?array("configid"=>$type):array();
        $result=DB::table("t_c_consult")
            ->leftJoin("t_c_consultverify","t_c_consultverify.consultid","=","t_c_consult.consultid")
            ->select("t_c_consult.consultid","t_c_consult.domain1","t_c_consult.domain2","t_c_consult.created_at","t_c_consult.brief")
            ->whereRaw('t_c_consultverify.id in (select max(id) from t_c_consultverify group by consultid)')
            ->where("t_c_consult.userid",$userId)
            ->where($typeWhere);
        $count=clone $result;
        $datas=$result->orderBy("t_c_consult.created_at","desc")->paginate(2);
        $counts=$count->count();
        foreach ($datas as $data){
            $data->video=$data->domain1."/".$data->domain2;
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            $totals=DB::table("t_c_consultresponse")->where("consultid",$data->consultid)->count();
            if($totals!=0){
                $data->state="指定专家";
            }else{
                $data->state="匹配专家";
            }
        }
        switch($type){
            case 0:
                $type="全部";
                break;
            case 1:
                $type="咨询审核";
                break;
            case 3:
                $type="审核失败";
                break;
            case 4:
                $type="邀请专家";
                break;
            case 5:
                $type="专家响应";
                break;
            case 6:
                $type="正在咨询";
                break;
            case 7:
                $type="已完成";
                break;
            case 9:
                $type="异常终止";
                break;
        }
        return view("myenterprise.video",compact("datas","type","counts"));
    }
    /**视频咨询详情
     * @return mixed
     */
    public function videoDetail($consultId){
        $userId=session("userId");
        $datas=DB::table("t_c_consult")
            ->leftJoin("t_c_consultverify","t_c_consultverify.consultid","=","t_c_consult.consultid")
            ->where("t_c_consult.consultid",$consultId)
            ->whereRaw('t_c_consultverify.id in (select max(id) from t_c_consultverify group by consultid)')
            ->get();
        $counts=DB::table("t_c_consultresponse")->where("consultid",$consultId)->count();
        foreach ($datas as $data){
            $configId=$data->configid;
            if($counts!=0){
                $data->state="指定专家";
            }else{
                $data->state="系统分配";
            }
            $data->starttime=date("Y-m-d H:i",strtotime($data->starttime));
            $data->endtime=date("Y-m-d H:i",strtotime($data->endtime));

        }
        switch($configId){
            case 5:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->leftJoin("t_u_expertfee","t_u_expertfee.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",2)
                    ->where("consultid",$consultId)
                    ->get();
                $selected=count($selExperts);
            break;
            case 6:
                $selExperts=DB::table("t_c_consult")
                    ->leftJoin("t_c_consultresponse","t_c_consultresponse.consultid","=","t_c_consult.consultid")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->leftJoin("t_u_bill","t_u_bill.userid","=","t_c_consult.userid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_u_bill.consultid",$consultId)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
            break; 
            case 7:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_c_consultcomment","t_c_consultresponse.expertid","=","t_c_consultcomment.expertid" )
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
        }
        $selExperts=!empty($selExperts)?$selExperts:"";
        $selected=!empty($selected)?$selected:"";
        $view="video".$configId;
        return view("myenterprise.".$view,compact("datas","counts","selected","selExperts","consultId","userId"));
    }
    /**申请视频咨询
     * @return mixed
     */
    public function applyVideo(){
        $cate = DB::table('t_common_domaintype')->get();
        return view("myenterprise.applyVideo",compact("cate"));
    }

    /**保存申请的咨询
     * @return array
     */
    public  function saveVideo(){
        $userId=session("userId");
        $result=array();
        $domain=explode("/",$_POST['domain']);
        DB::beginTransaction();
        try{
            $consultId=DB::table("t_c_consult")->insertGetId([
                "userid"=>$userId,
                "domain1"=>$domain[0],
                "domain2"=>$domain[1],
                "brief"=>$_POST['describe'],
                "isRandom"=>$_POST['isAppoint'],
                "starttime"=>$_POST['dateStart'],
                "endtime"=>$_POST['dateEnd'],
                "consulttime"=>date("Y-m-d H:i:s",time()),
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
            DB::table("t_c_consultverify")->insert([
                "consultid"=>$consultId,
                "configid"=>1,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
            if($_POST['state']==0){
                $expertIds=explode(",",$_POST['expertIds']);
                foreach ($expertIds as $val){
                    DB::table("t_c_consultresponse")->insert([
                        "consultid"=>$consultId,
                        "expertid"=>$val,
                        "state"=>0,
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                }
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }

    /**申请咨询 指定专家
     * @param Request $request
     * @return mixed
     */
    public  function videoSelect(Request $request){
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','ext.expertid' ,'=' ,'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll','ext.expertid' ,'=' ,'coll.expertid')
            ->leftJoin('view_expertmesscount as mess','ext.expertid' ,'=' ,'mess.expertid')
            ->leftJoin('view_expertstatus as status','ext.expertid' ,'=' ,'status.expertid')
            ->whereIn('status.configid',[2,4])
            ->select('ext.*','user.phone','fee.fee','fee.state','coll.count as collcount','mess.count as messcount');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'),'remark' => 1])->lists('expertid');
        }
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $consult=(isset($get['consult']) && $get['consult'] != "null") ? $get['consult'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("category"=>$role):array();
            $supplywhere = !empty($supply)?array("ext.domain1"=>$supply[0],'ext.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            if(!empty($consult) && $consult == '收费'){
                $consultwhere = ['fee.state' => 1];
                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere)->where($consultwhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.expertname","like","%".$searchname."%");
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.expertid',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->paginate(2);
            return view("myenterprise.videoSelect",compact('cate','searchname','datas','role','collectids','consult','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(2);
        $ordertime = 'desc';
        return view("myenterprise.videoSelect",compact('cate','datas','ordertime','collectids'));
    }
    /**申请咨询 处理反选的专家
     * @param Request $request
     * @return mixed
     */
    public  function handleSelect(){
        $result=array();
        $expertIDS=array();
        $expertIds=$_POST['expertIds'];
        DB::beginTransaction();
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
            $paynos=$this->getPayNum("消费");
            DB::table("t_u_bill")->insert([
                "userid"=>$_POST['userId'],
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
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            throw $e;
        }
        if(!isset($e)){
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }

    /**申请视频咨询3
     * @return mixed
     */
    public function video3(){
        return view("myenterprise.video3");
    }
    /**申请视频咨询4
     * @return mixed
     */
    public function video4(){
        return view("myenterprise.video4");
    }
    /**申请视频咨询5
     * @return mixed
     */
    public function video5(){
        return view("myenterprise.video5");
    }
    /**申请视频咨询6
     * @return mixed
     */
    public function video6(){
        return view("myenterprise.video6");
    }

    
}
