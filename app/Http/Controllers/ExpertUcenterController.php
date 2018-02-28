<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PhpSpec\Exception\Exception;

class ExpertUcenterController extends Controller
{
    /**基本资料
     * @return mixed
     */
    public function index(){
        $userId=session("userId");
        $data=DB::table("T_U_USER")->where("userid",$userId)->first();
        return view("expertUcenter.index",compact("data"));
    }
    /**修改手机号
     * @return mixed
     */
    public function  changeTel(){
        return view("expertUcenter.changeTel");
    }
    /**修改手机号2
     * @return mixed
     */
    public function  changeTel2(Request $request){
        if(session('phoneCode')){
            $request->session()->forget('phoneCode');
            return view("expertUcenter.changeTel2");
        }else{
            return redirect('/basic/changeTel');
        }

    }

    /**修改密码
     * @return mixed
     */
    public  function changePwd(){
        return view("expertUcenter.changePwd");
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

        //$bankcard=DB::table("t_u_bank")->where(["userid"=>$userId,"state"=>0])->pluck("bankcard");

        $bankcard=DB::table("t_u_bank")->where(["userid"=>$userId])->pluck("bankcard");
        $state=DB::table("t_u_bank")->where("userid",$userId)->pluck("state");
        return view("expertUcenter.recharge",compact("incomes","pays","expends","balance","bankcard","state"));
    }
    /**充值
     * @return mixed
     */
    public function rechargeMoney(){
        return view("expertUcenter.rechargeMoney");
    }
    /**提现
     * @return mixed
     */
    public function cash(){
        $userId=session("userId");
        $incomes=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"收入"])->sum("money");
        $pays=DB::table("T_U_BILL")->where("userid",$userId)->whereIn("type",["支出","在途"])->sum("money");
        $balance=$incomes-$pays;
        return view("expertUcenter.cash",compact("balance"));
    }
    /**添加银行卡
     * @return mixed
     */
    public  function  card(){
        return view("expertUcenter.card");
    }
    /**银行卡处理
     * @return mixed
     */
    public  function  card2(){
        return view("expertUcenter.card2");
    }
    /**我的信息
     * @return mixed
     */
    public  function  myinfo(Request $request){
        $userId = session("userId");
        $datas = DB::table('t_m_systemmessage')->where(['receiveid' => $userId])->whereIn('state',[0,1])->orderBy('id','desc')->paginate(6);
        if($request->ajax()){
            return $datas;
        }
        return view("expertUcenter.myinfo",compact('datas'));
    }
    /**我的需求
     * @return mixed
     */
    public function  myNeed(Request $request){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','need.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('view_needcollectcount as coll','coll.needid' ,'=' ,'need.needid')
            ->leftJoin('view_needmesscount as mess','mess.needid' ,'=' ,'need.needid')
            ->leftJoin('view_needstatus as status','status.needid' ,'=' ,'need.needid')
            ->select('need.*','view.role','ent.enterprisename','ent.showimage as entimg','status.configid as flag','coll.count as collcount','mess.count as messcount','ext.showimage as extimg','ext.expertname');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_n_collectneed')->where(['userid' => session('userId'),'remark' => 1])->lists('needid');
        }
        //用户发布的数量
        $putcount = DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',3)->count();
        //用户回复的数量
        $msgcount = count(DB::table('t_n_messagetoneed as need')->where('userid',session('userId'))->groupBy('needid')->lists('needid'));
        //用户待审核的供求的数量
        $waitcount= DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',1)->count();
        //用户拒审核的供求的数量
        $refusecount = DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',2)->count();
        //商情的数量
        $vipneedcount = DB::table('t_n_pushneed')->where('userid',session('userId'))->count();
        //判断是否为http请求
        if(!empty($get = $request->input())){
            $levelwhere = ['need.level' => 0];
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            $who = ( isset($get['who']) && $get['who'] != "null") ? $get['who'] : null;
            $level = (isset($get['level']) && $get['level'] != "null") ? $get['level'] : 0;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("needtype"=>$role):array();
            $supplywhere = !empty($supply)?array("need.domain1"=>$supply[0],'need.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ent.address"=>$address):array();

            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere);

            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('need.needid in (select needid from t_n_collectneed  where userid='.session('userId').' and remark=1)');
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        $action  = '已收藏';
                        break;
                    case 'myput':
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',3);
                        $action  = '已发布';
                        $who = 'my';
                        $levelwhere = [];
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('need.needid in (select  needid from t_n_messagetoneed  where userid='.session('userId').' group by needid)');
                        $action = '已留言';
                        break;
                    case 'waitverify':
                        $action  = '待审核';
                        $who = 'my';
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',1);
                        break;
                    case 'refuseverify':
                        $action  = '审核失败';
                        $who = 'my';
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',2);
                        break;
                }
            } else {
                $obj = $obj->where('status.configid',3);
            }

            if(!empty($who)){
                switch($who){
                    case 'my':
                        $obj = $obj->where('need.userid',session('userId'));
                        break;
                    case 'other':
                        $obj = $obj->where('need.userid','<>',session('userId'));
                        break;
                }
            } else {
                $obj = $obj->where('need.userid','<>',session('userId'));
            }

            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("need.brief","like","%".$searchname."%");
            }

            if($level == 1){
                $levelwhere = ['need.level' => 1];
                $pushneedlist = DB::table('t_n_pushneed')->where('userid',session('userId'))->lists('needid');
                $obj = $obj->whereIn("need.needid",$pushneedlist);
            }

            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('need.needtime',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->where($levelwhere)->paginate(4);
            return view("expertUcenter.newMyNeed",compact('vipneedcount','who','waitcount','level','refusecount','cate','searchname','msgcount','datas','role','action','collectids','putcount','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->where('status.configid',3)->where('need.userid','<>',session('userId'))
            ->where('need.level',0)
            ->orderBy("need.needtime",'desc')
            ->paginate(4);
        $ordertime = 'desc';
        $level =0;
        return view("expertUcenter.newMyNeed",compact('level','vipneedcount','waitcount','refusecount','cate','datas','ordertime','collectids','putcount','msgcount'));
    }
    public function  myNeed2(Request $request){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','need.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('view_needcollectcount as coll','coll.needid' ,'=' ,'need.needid')
            ->leftJoin('view_needmesscount as mess','mess.needid' ,'=' ,'need.needid')
            ->leftJoin('view_needstatus as status','status.needid' ,'=' ,'need.needid')
            ->select('need.*','view.role','ent.enterprisename','ent.showimage as entimg','status.configid as flag','coll.count as collcount','mess.count as messcount','ext.showimage as extimg','ext.expertname');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_n_collectneed')->where(['userid' => session('userId'),'remark' => 1])->lists('needid');
        }
        //用户发布的数量
        $putcount = DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',3)->count();
        //用户回复的数量
        $msgcount = count(DB::table('t_n_messagetoneed as need')->where('userid',session('userId'))->groupBy('needid')->lists('needid'));
        //用户待审核的供求的数量
        $waitcount= DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',1)->count();
        //用户拒审核的供求的数量
        $refusecount = DB::table('view_needstatus as need')->where('userid',session('userId'))->where('need.configid',2)->count();
        //商情的数量
        $vipneedcount = DB::table('t_n_pushneed')->where('userid',session('userId'))->count();
        //判断是否为http请求
        if(!empty($get = $request->input())){
            $levelwhere = ['need.level' => 0];
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            $who = ( isset($get['who']) && $get['who'] != "null") ? $get['who'] : null;
            $level = (isset($get['level']) && $get['level'] != "null") ? $get['level'] : 0;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("needtype"=>$role):array();
            $supplywhere = !empty($supply)?array("need.domain1"=>$supply[0],'need.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ent.address"=>$address):array();

            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere);

            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('need.needid in (select needid from t_n_collectneed  where userid='.session('userId').' and remark=1)');
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        $action  = '已收藏';
                        break;
                    case 'myput':
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',3);
                        $action  = '已发布';
                        $who = 'my';
                        $levelwhere = [];
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('need.needid in (select  needid from t_n_messagetoneed  where userid='.session('userId').' group by needid)');
                        $action = '已留言';
                        break;
                    case 'waitverify':
                        $action  = '待审核';
                        $who = 'my';
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',1);
                        break;
                    case 'refuseverify':
                        $action  = '审核失败';
                        $who = 'my';
                        $obj = $obj->where('need.userid',session('userId'))->where('status.configid',2);
                        break;
                }
            } else {
                $obj = $obj->where('status.configid',3);
            }

            if(!empty($who)){
                switch($who){
                    case 'my':
                        $obj = $obj->where('need.userid',session('userId'));
                        break;
                    case 'other':
                        $obj = $obj->where('need.userid','<>',session('userId'));
                        break;
                }
            } else {
                $obj = $obj->where('need.userid','<>',session('userId'));
            }

            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("need.brief","like","%".$searchname."%");
            }

            if($level == 1){
                $levelwhere = ['need.level' => 1];
                $pushneedlist = DB::table('t_n_pushneed')->where('userid',session('userId'))->lists('needid');
                $obj = $obj->whereIn("need.needid",$pushneedlist);
            }

            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('need.needtime',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->where($levelwhere)->paginate(4);
            return view("expertUcenter.newMyNeed",compact('vipneedcount','who','waitcount','level','refusecount','cate','searchname','msgcount','datas','role','action','collectids','putcount','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->where('status.configid',3)->where('need.userid','<>',session('userId'))
            ->where('need.level',0)
            ->orderBy("need.needtime",'desc')
            ->paginate(4);
        $ordertime = 'desc';
        $level =0;
        return view("expertUcenter.newMyNeed",compact('level','vipneedcount','waitcount','refusecount','cate','datas','ordertime','collectids','putcount','msgcount'));
    }
    /**需求详情
     * @return mixed
     */
    public function  needDetail($supplyId){
        //取出指定的供求信息
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'need.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->select('ent.brief as desc1','ext.brief as desc2','need.*','ent.enterprisename','ent.address','ext.expertname','user.phone','ent.showimage as entimg','ext.showimage as extimg');
        //获取该供求的当前状态
        $configid = DB::table('t_n_needverify as need')->where('needid',$supplyId)->orderBy('id','desc')->select('configid')->first();
        $obj = clone $datas;
        $datas = $datas->where('needid',$supplyId)->first();

        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_n_collectneed')->where(['userid' => session('userId'),'remark' => 1])->lists('needid');
        }

        //查询留言的信息
        $message = DB::table('t_n_messagetoneed as msg')
            ->leftJoin('view_userrole as view','view.userid', '=','msg.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'msg.userid')
            ->leftJoin('t_u_user as user2','user2.userid' ,'=' ,'msg.use_userid')
            ->where('needid',$supplyId)
            ->where('msg.isdelete',0)
            ->select('msg.*','ent.enterprisename','ext.expertname','user.avatar','user.nickname','user.phone','user2.nickname as nickname2','user2.phone as phone2')
            ->orderBy('messagetime','desc')
            ->get();
        //分组取出每个回复的数量
        $getmsgcount = DB::table('t_n_messagetoneed')->where('needid',$supplyId)->groupBy('parentid')->select(DB::raw('parentid ,count(*) as count'))->having('parentid','<>',0)->get();
        $msgcount = [];
        foreach ($getmsgcount as $k => $v) {
            $msgcount[$v->parentid] = $v->count;
        }
        //获取供求的收藏的数量
        $collcount = DB::table('view_needcollectcount')->where('needid',$supplyId)->first();
        $collcount = $collcount ? $collcount->count : 0;
        $cryptid = Crypt::encrypt(session('userId').$supplyId);
        return view("expertUcenter.needDetail",compact('datas','message','configid','collectids','msgcount','collcount','cryptid'));
    }
    /**发布需求
     * @return mixed
     */
    public function  supplyNeed($needid = null){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        if($needid){
            //验证是否该供求的状态为拒绝 否则重定向到首页
            $res = DB::table('view_needstatus')->where(['needid' => $needid,'configid' => 2])->first();
            if($res){
                $info = DB::table('t_n_need')->where('needid',$needid)->first();
                $data = DB::table('t_n_needverify')->where('needid',$needid)->orderBy('id','desc')->first();
                $info->error = $data->remark;
                return view("expertUcenter.supplyNeed",compact('cate','info'));
            } else {
                return redirect('/');
            }
        }
        return view("expertUcenter.supplyNeed",compact('cate'));
    }
    /**
     * 需求审核页
     */
    public function examineNeed ($needid = null) {

        $lastdata = DB::table('t_n_need')->where(['userid' => session('userId')])->orderBy('needid','desc')->first();

        if($needid){
            //验证是否该供求的状态为待审核 否则重定向到首页
            $res = DB::table('view_needstatus')->where(['needid' => $needid,'configid' => 1])->first();
            if($res){
                $lastdata = DB::table('t_n_need')->where(['needid' => $needid])->orderBy('needid','desc')->first();
            } else {
                return redirect('/');
            }
        }

        return view('expertUcenter.examineNeed',compact('lastdata'));
    }

    /**办事详情
     * @param $eventId
     * @return mixed
     */
    public function workDetail($eventId,Request $request){
        $eventexpertid = DB::table('t_e_eventresponse')->where(['eventid' => $eventId,'state' => 3])->first();
        //获取到当前登录用户的专家的id
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(empty($eventexpertid) || empty($expertid) || $expertid->expertid != $eventexpertid->expertid){
            return redirect('/');
        }
        DB::table("t_e_event")->where('eventid',$eventId)->update(['extislook' => 1]);
        $datas=DB::table("t_e_event")
            ->leftJoin("t_e_eventverify","t_e_eventverify.eventid","=","t_e_event.eventid")
            ->where("t_e_event.eventid",$eventId)
            ->whereRaw('t_e_eventverify.id in (select max(id) from t_e_eventverify group by eventid)')
            ->get();
        $counts=DB::table("t_e_eventresponse")->where("eventid",$eventId)->count();
        $counts2=DB::table("t_e_eventresponse")->where("eventid",$eventId)->where('state',0)->count();
        foreach ($datas as $data){
            $configId=$data->configid;
            if($counts!=0){
                $data->state="指定专家";
            }else{
                $counts = $counts2;
                $data->state="系统分配";
            }
        }
        if($request->ajax()){
            $data = $request->input();
            $res = DB::table('t_e_eventprocessremark')->where('epid',$data['epid'])->orderBy('id','desc')->paginate(5);
            return $res;
        }
        $selExperts = null;
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
                    ->leftJoin("t_e_eventtcomment","t_e_eventresponse.eventid","=","t_e_eventtcomment.eventid" )
                    ->leftJoin("t_u_expert","t_e_eventresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_e_eventresponse.state",3)
                    ->where("t_e_eventresponse.eventid",$eventId)
                    ->get();
                break;

            case 8:
                $selExperts=DB::table("t_e_eventresponse")
                    ->leftJoin("t_e_eventtcomment","t_e_eventresponse.eventid","=","t_e_eventtcomment.eventid" )
                    ->leftJoin("t_u_expert","t_e_eventresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_e_eventresponse.state",3)
                    ->where("t_e_eventresponse.eventid",$eventId)
                    ->get();
                $configId = 7;
                break;

            case 9:
                $selExperts=DB::table("t_u_enterprise")
                    ->where('userid',$datas[0]->userid)
                    ->first();
                $selExperts2=DB::table("t_e_eventresponse")
                    ->leftJoin("t_u_expert","t_e_eventresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_e_eventresponse.state",3)
                    ->where("eventid",$eventId)
                    ->first();
                $configId = 9;
                break;
            case 6:
                //当config为6正在办事的状态的时候
                //获取到被选择的专家的信息
                $info = DB::table('t_e_eventresponse as res')
                    ->leftJoin('t_u_expert as ext','ext.expertid','=','res.expertid')
                    ->leftJoin('t_u_expertfee as fee','fee.expertid','=','res.expertid')
                    ->where(['eventid' => $eventId,'res.state' => 3])
                    ->select('ext.expertname','ext.userid','fee.fee','ext.showimage')
                    ->first();
                //获取到该办事的相关信息
                $datas = DB::table("t_e_event")
                    ->leftJoin("view_eventstatus as status","status.eventid","=","t_e_event.eventid")
                    ->leftJoin('t_u_enterprise as ent','ent.userid','=','t_e_event.userid')
                    ->where("t_e_event.eventid",$eventId)
                    ->select('t_e_event.*','ent.*','status.*','t_e_event.brief')
                    ->first();
                //验证是否喂新手
                $verifyfirstevent = DB::table('t_e_eventresponse')
                    ->leftJoin('view_eventstatus as ver','ver.eventid','=','t_e_eventresponse.eventid')
                    ->where('t_e_eventresponse.expertid',$expertid->expertid)
                    ->where('ver.configid','>','6')
                    ->where('t_e_eventresponse.state','>','2')
                    ->first();
                $verifyfirstevent2 = DB::table('t_e_eventprocess as ver')
                    ->leftJoin('t_e_event','ver.eventid','=','t_e_event.eventid')
                    ->leftJoin('t_e_eventresponse as res','res.eventid','=','t_e_event.eventid')
                    ->where('res.state','>','2')
                    ->where('res.expertid',$expertid->expertid)
                    ->select('ver.epid')
                    ->first();
                $isfirstevent = 0;
                if(empty($verifyfirstevent) && empty($verifyfirstevent2)){
                    $isfirstevent = 1;
                }
                //获取到办事的流程的信息
                $configinfo = DB::table('t_e_eventprocessconfig as con')
                    ->where('con.domain',$datas->domain1)
                    ->orderBy('con.step')
                    ->get();
                foreach ($configinfo as $v){
                    $proinfo = DB::table('t_e_eventprocess')->where(['pid' => $v->pid,'eventid' => $eventId])->first();
                    $v->ppid = $v->pid;
                    $v->epid = !empty($proinfo->epid) ? $proinfo->epid : null;
                    $v->eventid = !empty($proinfo->eventid) ? $proinfo->eventid : null;
                    $v->startuserid = !empty($proinfo->startuserid) ? $proinfo->startuserid : null;
                    $v->acceptuserid = !empty($proinfo->acceptuserid) ? $proinfo->acceptuserid : null;
                    $v->documenturl = !empty($proinfo->documenturl) ? $proinfo->documenturl : null;
                    $v->state = !empty($proinfo->state) || (!empty($proinfo) && $proinfo->state === 0)  ? $proinfo->state : null;
                }
                //对信息进行封装
                $configinfo = \EnterpriseClass::processInsert($configinfo);

                //获取到该办事的所有的过程id
                $epids = DB::table('t_e_eventprocess')->where('eventid',$eventId)->lists('epid');

                //获取到办事进行到的过程
                $stepepid = !empty($_GET['step']) && in_array($_GET['step'],$epids) ? ['t_e_eventprocess.epid' => $_GET['step']] : [];
                $lastpid = DB::table('t_e_eventprocess')
                    ->leftJoin('t_e_eventprocessconfig as con','con.pid','=','t_e_eventprocess.pid')
                    ->where($stepepid)
                    ->where('eventid',$eventId)
                    ->orderBy('epid','desc')
                    ->first();
                //生成办事对应的状态
                $stmpstate = DB::table('t_e_eventprocess')->leftJoin('t_e_eventprocessconfig as con','con.pid','=','t_e_eventprocess.pid')->where('eventid',$eventId)->orderBy('epid','desc')->first();
                if(!empty($stmpstate) && $stmpstate->state == 2){
                    $stmpstate->step = $stmpstate->step+1;
                }
                if(empty($stmpstate)){
                    $stmpstate = (object)$stmpstate;
                    $stmpstate->step = 1;
                }
                //若不存在状态 为1
                if(empty($lastpid)){
                    $lastpid = (object)$lastpid;
                    $lastpid->step = 1;
                } elseif ($lastpid->state == 2 && empty($stepepid)){
                    $step = DB::table('t_e_eventprocessconfig')->where('pid',$lastpid->pid)->first()->step;
                    if(!empty($configinfo[$step])){
                        $x = $step+1;
                        $lastpid = (object)null;
                        $lastpid->step = $x;
                    }
                }


                //获取所有的日程
                $task = DB::table('t_e_eventtask')->whereIn('epid',$epids)->where('state','<>','2')->orderBy('etid','desc')->get();
                $remark = [];
                foreach($epids as $v){
                    $data1 = DB::table('t_e_eventprocessremark')->where('epid',$v)->orderBy('id','desc')->paginate(5);
                    $data2 = DB::table('t_e_eventprocessremark')->where('epid',$v)->count();
                    if($data2){
                        //若有返回信息则吧反馈的信息对象存放到数组中
                        $remark[$v] = [$data1,$data2];
                    }
                }
                return view("expertUcenter.new_uct_works5",compact('isfirstevent','task',"datas","eventId",'info','configinfo','lastpid','remark','stmpstate'));
        }
        $selExperts=!empty($selExperts)?$selExperts:"";
        $selected=!empty($selected)?$selected:"";
        $view="works".$configId;
        return view("expertUcenter.".$view,compact("datas","counts","selected","selExperts",'selExperts2',"eventId"));
    }

    /**判断用户是否绑定银行卡
     * @return array
     */
    public  function expertHaveCard(){
        $res=array();
        $userId=session('userId');
        $counts=DB::table('t_u_bank')->where('userid',$userId)->count();
        if($counts){
            $states=DB::table('t_u_bank')->where('userid',$userId)->pluck('state');
            if($states==1 ){
                $res['code']='0';
            }elseif($states==0){
                $res['code']='1';
            }else{
                $res['code']='2';
            }
        }else{
            $res['code']='0';
        }
        return $res;
    }

    public function enterpriseRes2(Request $request)
    {
        if(empty(session('userId'))){
            return redirect('/login');
        }
        //获取板块信息
        $datas = DB::table('enterpriseuser as ext');

        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectenterprise')->where(['userid' => session('userId'),'remark' => 1])->lists('enterpriseid');
        }
        //用户回复的数量
        $msgcount =0;
        $domainselect = ['找资金' => '投融资','找技术' => '科研技术', '定战略' => '战略管理', '找市场' => '市场资源'];
        $domainselect2 = ['投融资' => '找资金','科研技术' => '找技术', '战略管理' => '定战略', '市场资源' => '找市场'];
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            /*$role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;*/
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $industry=(isset($get['industry']) && $get['industry'] != "null") ? $get['industry'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            //设置where条件生成where数组
            /*  $rolewhere = !empty($role)?array("category"=>$role):array();*/
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            $industrywhere = !empty($industry)?array("ext.industry"=>$industry):array();
            /*if(!empty($supply)){
                $supply[0] = $domainselect2[$supply[0]];
                $obj = $datas->where($rolewhere)->where('ext.domain1',$supply[0])->where('ext.domain2','like','%'.$supply[1].'%')->where($addresswhere)->where($consultwhere);
                $supply[0] = $domainselect[$supply[0]];
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }*/
            $obj = $datas->where($addresswhere)->where($industrywhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.enterprisename","like","%".$searchname."%");
            }
            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('ext.enterpriseid in (select  enterpriseid from t_u_collectenterprise  where userid='.session('userId').' and remark=1)');
                        $action = '已收藏';
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('ext.enterpriseid in (select  enterpriseid from t_u_messagetoenterprise  where userid='.session('userId').' group by enterpriseid)');
                        $action = '已留言';
                        break;
                }
            } else {
                $action='';
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.id',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {

            }
            $datas = $obj->paginate(4);
            return view("expertUcenter.enterpriseres2",compact('cate','msgcount','domainselect','searchname','datas','collectids','industry','action','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->paginate(4);
        $ordertime = 'desc';
        return view('expertUcenter.enterpriseres2',compact('datas','domainselect','ordertime','collectids','msgcount'));
    }

    public function enterpriseRes(Request $request)
    {
        if(empty(session('userId'))){
            return redirect('/login');
        }
        //获取板块信息
        $datas = DB::table('t_u_enterprise as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('view_enterprisecollectcount as coll','ext.enterpriseid' ,'=' ,'coll.entid')
            ->leftJoin('view_enterprisemesscount as mess','ext.enterpriseid' ,'=' ,'mess.entid')
            ->leftJoin('view_enterprisestatus as status','ext.enterpriseid' ,'=' ,'status.enterpriseid')
            ->select('ext.*','user.phone','coll.count as collcount','mess.count as messcount')
            ->where(['status.configid' => '3','ext.isshow' => 0]);
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectenterprise')->where(['userid' => session('userId'),'remark' => 1])->lists('enterpriseid');
        }
        //用户回复的数量
        $msgcount = count(DB::table('t_u_messagetoenterprise')->where('userid',session('userId'))->groupBy('enterpriseid')->lists('enterpriseid'));
        $domainselect = ['找资金' => '投融资','找技术' => '科研技术', '定战略' => '战略管理', '找市场' => '市场资源'];
        $domainselect2 = ['投融资' => '找资金','科研技术' => '找技术', '战略管理' => '定战略', '市场资源' => '找市场'];
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            /*$role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;*/
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $industry=(isset($get['industry']) && $get['industry'] != "null") ? $get['industry'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            //设置where条件生成where数组
          /*  $rolewhere = !empty($role)?array("category"=>$role):array();*/
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            $industrywhere = !empty($industry)?array("ext.industry"=>$industry):array();
            /*if(!empty($supply)){
                $supply[0] = $domainselect2[$supply[0]];
                $obj = $datas->where($rolewhere)->where('ext.domain1',$supply[0])->where('ext.domain2','like','%'.$supply[1].'%')->where($addresswhere)->where($consultwhere);
                $supply[0] = $domainselect[$supply[0]];
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }*/
            $obj = $datas->where($addresswhere)->where($industrywhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.enterprisename","like","%".$searchname."%");
            }
            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('ext.enterpriseid in (select  enterpriseid from t_u_collectenterprise  where userid='.session('userId').' and remark=1)');
                        $action = '已收藏';
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('ext.enterpriseid in (select  enterpriseid from t_u_messagetoenterprise  where userid='.session('userId').' group by enterpriseid)');
                        $action = '已留言';
                        break;
                }
            } else {
                $obj = $obj->whereIn('status.configid',[3]);
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.enterpriseid',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->paginate(4);
            return view("expertUcenter.enterpriseres",compact('cate','msgcount','domainselect','searchname','datas','collectids','industry','action','address','ordertime','ordercollect','ordermessage'));
        }
        $first123 = DB::table('enterpriseuser');
        $datas = $datas
            ->orderBy("ext.enterpriseid",'desc')->paginate(4);
        $ordertime = 'desc';
        return view('expertUcenter.enterpriseres',compact('datas','domainselect','ordertime','collectids','msgcount'));
    }




    public function enterpriseDetail($enterpriseid)
    {
        if(empty(session('userId'))){
            return redirect('/login');
        }
        $memberrights=DB::table("t_u_memberright")->where("memberid","<>",1)->get();
        $domainselect = ['找资金' => '投融资','找技术' => '科研技术', '定战略' => '战略管理', '找市场' => '市场资源'];
        $array = DB::table('t_u_enterprise as ext')
            ->leftJoin('view_enterprisestatus as status','ext.enterpriseid' ,'=' ,'status.enterpriseid')
            ->where('status.configid',3)
            ->lists('ext.enterpriseid');
        if(!in_array("$enterpriseid",$array)){
            return redirect("/");
        }
        $cate = DB::table('t_common_domaintype')->get();
        //取出指定的企业信息
        $datas = DB::table('t_u_enterprise as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('view_enterprisecollectcount as coll','ext.enterpriseid' ,'=' ,'coll.entid')
            ->leftJoin('view_enterprisemesscount as mess','ext.enterpriseid' ,'=' ,'mess.entid')
            ->leftJoin('view_enterprisestatus as state','state.enterpriseid','=','ext.enterpriseid')
            ->where(['state.configid' => 3])
            ->select('ext.*','user.phone');
        $obj = clone $datas;
        $datas = $datas->where('ext.enterpriseid',$enterpriseid)->first();
        //取出同类下推荐的企业
        $info = ['industry' => $datas->industry,'enterpriseid' => $enterpriseid];
        $recommendNeed = $obj->where('ext.enterpriseid','<>',$info['enterpriseid'])->orderBy('ext.enterpriseid','desc');
        $obj2 = clone $recommendNeed;
        //取出相同二级类下面的供求
        $recommendNeed = $recommendNeed->where(['ext.industry' => $info['industry']])->take(5)->get();

        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_u_collectenterprise')->where(['userid' => session('userId'),'remark' => 1])->lists('enterpriseid');
        }
        //查询留言的信息
        $message = DB::table('t_u_messagetoenterprise as msg')
            ->leftJoin('view_userrole as view','view.userid', '=','msg.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'msg.userid')
            ->leftJoin('t_u_user as user2','user2.userid' ,'=' ,'msg.use_userid')
            ->where('msg.enterpriseid',$enterpriseid)
            ->where('msg.isdelete',0)
            ->select('msg.*','ent.enterprisename','ext.expertname','user.avatar','user.nickname','user.phone','user2.nickname as nickname2','user2.phone as phone2')
            ->orderBy('messagetime','desc')
            ->get();
        //分组取出每个回复的数量
        $getmsgcount = DB::table('t_u_messagetoenterprise')->where('enterpriseid',$enterpriseid)->groupBy('parentid')->select(DB::raw('parentid ,count(*) as count'))->having('parentid','<>',0)->get();
        $msgcount = [];
        foreach ($getmsgcount as $k => $v) {
            $msgcount[$v->parentid] = $v->count;
        }
        $isexpert = true;

        return view("expertUcenter.enterprisedetail",compact('datas','recommendNeed','domainselect','message','collectids','msgcount','cate','memberrights','isexpert'));
    }

    /**处理收藏
     * @param Request $request
     * @return string
     */
    public function dealCollect (Request $request)
    {
        //判断是否登陆
        if(!session('userId')) {
            return 'nologin';
        }
        //判断是否为ajax请求
        if($request->ajax()){
            $data = $request->only('action', 'enterpriseid');
            if(empty($data['enterpriseid'])){
                return 'error';
            }
            $userid = session('userId');
            $where = ['enterpriseid' => $data['enterpriseid'],'userid' => $userid];
            if($data['action'] == 'collect'){
                $is_insert =  DB::table('t_u_collectenterprise')->where($where)->first();
                if($is_insert){
                    $res = DB::table('t_u_collectenterprise')->where($where)->update(['remark' => 1]);
                } else {
                    $res = DB::table('t_u_collectenterprise')->insertGetId([
                        'enterpriseid' => $data['enterpriseid'],
                        'userid' => $userid,
                        'collecttime' => date('Y-m-d H:i:s',time()),
                        'remark' => 1,
                        'updated_at' => date('Y-m-d H:i:s',time())
                    ]);
                }
            } elseif ($data['action'] == 'cancel') {
                $res = DB::table('t_u_collectenterprise')->where($where)->update(['remark' => 0]);
            }
            if($res){
                return 'success';
            } else {
                return 'error';
            }
        }
        return 'error';

    }

    /**回复留言
     * @param Request $request
     * @return string
     */
    public function replyMessage (Request $request)
    {
        if(empty(session('userId'))) {
            return ['msg' => 'nologin','icon' => 5];
        }
        if($request->ajax()){
            $data = $request->only('content', 'needid','parentid','use_userid');
            $data['enterpriseid'] = $data['needid'];
            if($data['use_userid'] == session('userId')){
                return ['msg' => '亲,没必要自己回复自己','icon' => 0];
            }
            $expertuserid = DB::table('t_u_enterprise')->where('enterpriseid',$data['enterpriseid'])->first();
            $userinfo = DB::table('t_u_user')->where('userid',session('userId'))->first();
            if(empty($expertuserid) || empty($userinfo)){
                return ['msg' => '企业不存在或用户不存在','icon' => 0];
            }
            $verifymember = DB::table('t_u_expert as ent')
                ->leftJoin('t_u_expertverify as ver','ver.expertid','=','ent.expertid')
                ->orderBy('ver.id','desc')
                ->where('ent.userid',session('userId'))
                ->first();

            if($expertuserid->userid != session('userId') && (empty($verifymember) || $verifymember->configid != 2)){
                return ['msg' => '不是认证专家或者本企业不能留言','icon' => 0];
            }

            if(!empty($verifymember) && $verifymember->level == -1){
                return ['msg' => '由于您违反了了升维⽹网给企业留留⾔言的规定，已禁⽌止您给企业留留⾔言，如要开启，请联系升维⽹网客服⼈员或拨打网页下方的联系电话','icon' => 0];
            }
            /*if($data['parentid'] != 0){
                $msgcount = DB::table('t_u_messagetoenterprise')->where('parentid',$data['parentid'])->where('isdelete',0)->count();
                if($msgcount >= 5){
                    return ['msg' => '留言下的回复最多回复5次想详细交流可进行申请办事交流','icon' => 6];
                }
            }*/
            $data['userid'] = session('userId');
            $data['messagetime'] = date('Y-m-d H:i:s',time());
            if(!$data['use_userid']){
                $data['use_userid'] = 0;
            }
            unset($data['needid']);
            DB::beginTransaction();
            try{
                $res = DB::table('t_u_messagetoenterprise')->insert($data);
                if($expertuserid->userid != session('userId') && !$data['parentid']){
                    $content = '专家【'.$verifymember->expertname.'】给您发送了一条留言：'.$data['content'];
                    $msg = DB::table('t_m_systemmessage')->insert([
                        'sendid' => 0,
                        'receiveid' => $expertuserid->userid,
                        'sendtime' => date('Y-m-d H:i:s',time()),
                        'title' => '有专家给您留言了',
                        'content' => $content,
                        'state' => 0
                    ]);
                }
                if($expertuserid->userid != session('userId') && $data['parentid']){
                    $content = !empty($userinfo->nickname) ? '用户'.$userinfo->nickname.'给您发送了一条留言：'.$data['content']: '用户'.substr_replace($userinfo->phone,'****',3,4).'给您发送了一条留言：'.$data['content'];
                    $msg = DB::table('t_m_systemmessage')->insert([
                        'sendid' => 0,
                        'receiveid' => $expertuserid->userid,
                        'sendtime' => date('Y-m-d H:i:s',time()),
                        'title' => '有专家给您回复了',
                        'content' => '专家'.$verifymember->expertname.'回复了您：'.$data['content'],
                        'state' => 0
                    ]);
                }
                if($expertuserid->userid == session('userId') && $data['parentid']){
                    $parid = DB::table('t_u_messagetoenterprise')->where('id',$data['parentid'])->first();
                    $msg = DB::table('t_m_systemmessage')->insert([
                        'sendid' => 0,
                        'receiveid' => $parid->userid,
                        'sendtime' => date('Y-m-d H:i:s',time()),
                        'title' => '企业'.$expertuserid->enterprisename.'回复了您的留言',
                        'content' => '企业【'.$expertuserid->enterprisename.'】回复了您的留言：'.$data['content'].' 。[更多详细请到企业资源页查找企业查看]',
                        'state' => 0
                    ]);
                }

                DB::commit();
                return ['msg' => '留言/回复成功','icon' => 1];
            }catch (Exception $e){
                DB::rollback();
                return ['msg' => '留言失败请刷新重试','icon' => 0];
            }
        }
        return ['msg' => '留言失败请刷新重试','icon' => 0];
    }

    /**我的项目评议
     * @return mixed
     */
    public function  myShows(Request $request){
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        $pushs = [];
        if(!empty($expert)){

            $pushs = DB::table('t_s_pushshow')->where('expertid',$expert->expertid)->lists('showid');
            $also = DB::table('t_s_messagetoshow')->where('userid',session('userId'))->lists('showid');
        }

        $datas = DB::table('t_s_show as show')
            ->leftJoin('view_userrole as view','view.userid', '=','show.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','show.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('view_showmesscount as mess','mess.showid' ,'=' ,'show.showid')
            ->leftJoin('view_showstatus as status','status.showid' ,'=' ,'show.showid')
            ->select('show.*','view.role','ent.enterprisename','ent.showimage as entimg','status.configid as flag','mess.count as messcount','ext.showimage as extimg','ext.expertname')
            ->whereIn('show.showid',$pushs);
        //待评议
       $putcount = count(array_diff($pushs,$also));
        //已评议
        $waitcount= count($also);
        /*//商情的数量
        $vipneedcount = DB::table('t_s_pushshow')->where('userid',session('userId'))->count();*/
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $action = ( isset($get['action']) && $get['action'] != "null") ? $get['action'] : null;
            //设置where条件生成where数组


            $obj = $datas;

            if(!empty($action)){
                switch($action){


                    case 'waitverify':
                        $action  = '待评议';
                        $obj = $obj->whereIn('show.showid',array_diff($pushs,$also));;
                        break;
                    case 'refuseverify':
                        $action  = '已评议';
                        $obj = $obj->whereIn('show.showid',$also);;
                        break;
                }
            } else {

            }

            $datas = $obj->orderBy("show.showtime",'desc')->paginate(4);
            foreach($datas as $k => $v){
                if($v->flag == 3){
                    $v->flag2 = '待评议';
                } elseif($v->flag == 5 || $v->flag == 4){
                    $v->flag2 = '已评议';
                }
            }
            return view("expertUcenter.myshows",compact('vipneedcount','waitcount','refusecount','cate','msgcount','datas','action','collectids','putcount','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas
            ->orderBy("show.showtime",'desc')
            ->paginate(4);
        $ordertime = 'desc';
        foreach($datas as $k => $v){
            if($v->flag == 3){
                $v->flag2 = '待评议';
            } elseif($v->flag == 5 || $v->flag == 4){
                $v->flag2 = '已评议';
            }
        }
        return view("expertUcenter.myshows",compact('level','vipneedcount','waitcount','refusecount','cate','datas','ordertime','collectids','putcount','msgcount'));

    }

    /**项目评议详情
     * @return mixed
     */
    public function  showDetail($showId){
        //取出指定的供求信息
        $datas = DB::table('t_s_show as show')
            ->leftJoin('view_userrole as view','view.userid', '=','show.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'show.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->select('ent.brief as desc1','ext.brief as desc2','show.*','ent.enterprisename','ent.address','ext.expertname','user.phone','ent.showimage as entimg','ext.showimage as extimg');
        //获取该供求的当前状态
        $configid = DB::table('t_s_showverify as need')->where('showid',$showId)->orderBy('id','desc')->select('configid')->first();
        $obj = clone $datas;
        $datas = $datas->where('showid',$showId)->first();


        //查询留言的信息
        $message = DB::table('t_s_messagetoshow as msg')
            ->leftJoin('t_u_expert as ext','ext.userid' ,'=' ,'msg.userid')
            ->where('showid',$showId)
            ->where('msg.userid',session('userId'))
            ->select('msg.*','ext.expertname','ext.showimage','ext.expertid')
            ->orderBy('messagetime','desc')
            ->get();
        $cryptid = Crypt::encrypt(session('userId').$showId);
        return view("expertUcenter.showDetail",compact('datas','message','configid','msgcount','cryptid'));
    }

    /*
     *专家回复项目  进行评议
     */
    public function messageToShow(Request $request)
    {
        $data = $request->input();
        if(empty(session('userId'))){
            return ['msg' => '请登录','icon' => 2 ];
        }
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(!empty($expert)){
            $pushs = DB::table('t_s_pushshow')->where('expertid',$expert->expertid)->where('showid',$data['showid'])->first();
        } else {
            return ['msg' => '很抱歉 您不是专家无此权限','icon' => 2];
        }
        if(empty($pushs)){
            return ['msg' => '非法操作','icon' => 2];
        }
        if(!empty($data['isupdate'])){
            $res = DB::table('t_s_messagetoshow')
                    ->where(['showid' => $data['showid'],'userid' => session('userId')])
                    ->update(['content' => $data['content']]);
            if($res){
                return ['msg' => '修改评议成功','icon' => 1];
            } else {
                return ['msg' => '修改评议失败 请重试','icon' => 2];
            }
        } else {
            $res = DB::table('t_s_messagetoshow')
                    ->insert([
                        'content' => $data['content'],
                        'showid' => $data['showid'],
                        'userid' => session('userId'),
                        'messagetime' => date('Y-m-d H:i:s',time())
                    ]);
            if($res){
                return ['msg' => '发布评议成功','icon' => 1];
            } else {
                return ['msg' => '发布评议失败 请重试','icon' => 2];
            }
        }
    }
}
