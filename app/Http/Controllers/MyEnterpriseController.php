<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
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
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            if(!empty($consult) && $consult == '收费'){
                $consultwhere = ['fee.state' => 1];
                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            if(!empty($supply)){
                $obj = $datas->where($rolewhere)->where('ext.domain1',$supply[0])->where('ext.domain2','like','%'.$supply[1].'%')->where($addresswhere)->where($consultwhere);
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.expertname","like","%".$searchname."%");
            }
            if(!empty($action)){
                switch($action){
                    case 'collect':
                        $obj = $obj->whereRaw('ext.expertid in (select  expertid from t_u_collectexpert  where userid='.session('userId').' and remark=1)');
                        $action = '已收藏';
                        //$obj = $obj->where('colneed.userid',session('userId'))->where('colneed.remark',1);
                        break;
                    case 'message':
                        $obj = $obj->whereRaw('ext.expertid in (select  expertid from t_u_messagetoexpert  where userid='.session('userId').' group by expertid)');
                        $action = '已留言';
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
            return view("myenterprise.newExResource",compact('cate','msgcount','searchname','datas','role','collectids','consult','action','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(4);
        $ordertime = 'desc';
        return view("myenterprise.newExResource",compact('cate','datas','ordertime','collectids','msgcount'));
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

        $enterprise = DB::table('t_u_enterprise')->where(['userid' => session('userId')])->first();
        if(!empty($enterprise)){
            $enterpriseid = $enterprise->enterpriseid;
            $configids = DB::table('t_u_enterpriseverify')->where('enterpriseid',$enterpriseid)->orderBy('id','desc')->first();
            if($configids){
                if($configids->configid == 3){
                    return redirect('uct_member/member3/'.$enterpriseid);
                } elseif ($configids->configid == 4){
                    return redirect('uct_member/member4/'.$enterpriseid);
                } elseif ($configids->configid == 2){
                    return redirect('uct_member/member2/'.$enterpriseid);
                }
            }
        }
        return view("myenterprise.member");
    }

    /**ajax处理会员认证
     * @param Request $request
     * @return array
     */
    public function entVerify (Request $request) {
        if($request->ajax()){
            $info = DB::table('t_u_enterprise')->where('userid',session('userId'))->first();
            if($info){
                return ['msg' => '提交失败，您已经认证过了','icon' => 2];
            }
            $data = $request->only(['brief','enterprisename','licenceimage','showimage','size','industry','address']);
            $data['userid'] = session('userId');
            $data['updated_at'] = date('Y-m-d H:i:s',time());
            $res = DB::table('t_u_enterprise')->insertGetId($data);
            if($res){
                $res2 = DB::table('t_u_enterpriseverify')->insert([
                    'enterpriseid' => $res,
                    'configid' => 1,
                    'verifytime' => date('Y-m-d H:i:s',time()),
                    'updated_at' => date('Y-m-d H:i:s',time())

                ]);
                if($res2){
                    return ['msg' => '提交成功，进入审核阶段','icon' => 1,'id' => $res];
                }
                return ['msg' => '提交失败，请重新提交','icon' => 2];
            } else {
                return ['msg' => '提交失败，请重新提交','icon' => 2];
            }
        }
        return ['msg' => '非法请求' ,'icon' => 2];
    }

    /**会员认证2
 * @return mixed
 */
    public  function member2($entid){
        $data = DB::table('t_u_enterprise')->where(['enterpriseid' => $entid,'userid' => session('userId')])->first();
        if(!$data){
           return redirect('/');
        }
        $configid = DB::table('t_u_enterpriseverify')->where('enterpriseid',$entid)->orderBy('id','desc')->first()->configid;
        if($configid == 3){
            return redirect('uct_member/member3/'.$entid);
        } elseif ($configid == 4){
            return redirect('uct_member/member4/'.$entid);
        }
        return view("myenterprise.member2",compact('data'));
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
    public  function member4($entid){
        $data = DB::table('t_u_enterprise')->where(['enterpriseid' => $entid,'userid' => session('userId')])->first();
        return view("myenterprise.member4",compact('data'));
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
                ->select("t_e_event.eventid",'t_e_eventverify.configid',"t_e_event.domain1","t_e_event.domain2","t_e_event.created_at","t_e_event.brief")
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
            $configname = DB::table('t_e_eventverifyconfig')->where('configid',$data->configid)->first()->name;
            $data->configname = $configname;
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
    public function workDetail($eventId,Request $request){
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
        if($request->ajax()){
            $data = $request->input();
            $res = DB::table('t_e_eventprocessremark')->where('epid',$data['epid'])->paginate(1);
            return $res;
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
                break;
            case 6:
                //当config为6正在办事的状态的时候
                //获取到被选择的专家的信息
                $info = DB::table('t_e_eventresponse as res')
                    ->leftJoin('t_u_expert as ext','ext.expertid','=','res.expertid')
                    ->where(['eventid' => $eventId,'state' => 3])
                    ->first();
                //获取到该办事的相关信息
                $datas = DB::table("t_e_event")
                    ->leftJoin("view_eventstatus as status","status.eventid","=","t_e_event.eventid")
                    ->leftJoin('t_u_enterprise as ent','ent.userid','=','t_e_event.userid')
                    ->where("t_e_event.eventid",$eventId)
                    ->first();
                //获取到办事的流程的信息
                $configinfo = DB::table('t_e_eventprocessconfig as con')
                    ->leftJoin('t_e_eventprocess as pro','con.pid','=','pro.pid')
                    ->select('con.pid as ppid','con.*','pro.*')
                    ->orderBy('con.pid')
                    ->get();
                //对信息进行封装
                $configinfo = \EnterpriseClass::processInsert($configinfo);

                //获取到办事进行到的过程
                $lastpid = DB::table('t_e_eventprocess')->where('eventid',$eventId)->orderBy('epid','desc')->first();
                //获取到该办事的所有的过程id
                $epids = DB::table('t_e_eventprocess')->where('eventid',$eventId)->lists('epid');
                //获取所有的日程
                $task = DB::table('t_e_eventtask')->whereIn('epid',$epids)->where('state','<>','2')->orderBy('etid','desc')->get();
                $remark = [];
                foreach($epids as $v){
                    $data1 = DB::table('t_e_eventprocessremark')->where('epid',$v)->paginate(1);
                    $data2 = DB::table('t_e_eventprocessremark')->where('epid',$v)->count();
                    if($data2){
                        //若有返回信息则吧反馈的信息对象存放到数组中
                        $remark[$v] = [$data1,$data2];
                    }
                }
                return view("myenterprise.works6",compact('task',"datas","eventId",'info','configinfo','lastpid','remark'));
        }
        $selExperts=!empty($selExperts)?$selExperts:"";
        $selected=!empty($selected)?$selected:"";
        $view="works".$configId;
        return view("myenterprise.".$view,compact("datas","counts","selected","selExperts","eventId"));
    }

    /*public function getajaxpage (Request $request) {
        $data = $request->input();
    }*/

    public function eventUpload($proid,Request $request)
    {
        if(empty(session('userId'))){
            return ['error' => '请登录','icon' => 2];
        }
        $data = $request->input();
        // 接收文件信息 进行上传
        $file = Input::file('files');
        if($file->isValid()){
            $clientName = $file -> getClientOriginalName();
            //$tmpName = $file ->getFileName();
            //$realPath = $file -> getRealPath();
            $entension = $file -> getClientOriginalExtension();
            //$mimeTye = $file -> getMimeType();
            $fileTypes = ['html','pdf','doc','txt','docx'];
            if(!in_array($entension,$fileTypes)){
                return ['error' => '您上传的不是正确的类型文件','icon' => 2];
            }
            //验证是否为指定身份提交
            $starttype = DB::table('t_e_eventprocessconfig')->where('pid',$proid)->first()->starttype;
            $eventuserid = DB::table('t_e_event')->where('eventid',$data['eventid'])->first()->userid;
            $eventexpertid = DB::table('t_e_eventresponse')->where(['eventid' => $data['eventid'],'state' => 3])->first()->expertid;
            $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
            if($starttype){
                if($expertid != $eventexpertid){
                    return ['error' => '该资料应由专家上传','icon' => 2];
                }
            } else{
                if($eventuserid != session('userId')){
                    return ['error' => '该资料应由企业上传','icon' => 2];
                }
            }
            //将获取到的文件名装换成gb2312的编码方式
            $name = iconv("UTF-8","gb2312", $file->getClientOriginalName());
            $path = $file->move('swUpload/event/'.$data['eventid'].'/'.$proid.'/'.date('mdHis',time()).'/',$name);
            if(!empty($path)){
                //吧路径的编码方式转换成utf-8
                $path = iconv("gb2312","UTF-8", $path);
                //加密路径
                $down = Crypt::encrypt($path);
                $data['pid'] = $proid;
                $data['documenturl'] = $path;
                $data['state'] = 0;
                //获取到该办事的指定的过程的信息
                $verify = DB::table('t_e_eventprocess')->where(['pid' => $proid,'eventid' => $data['eventid']])->first();
                //如果存在过程信息  更改
                if(!empty($verify)){
                    $epid = $verify->epid;
                    DB::table('t_e_eventprocess')->where('epid',$epid)->update(['documenturl' => $path,'state' => 1]);
                } else {
                    $epid = DB::table('t_e_eventprocess')->insertGetId($data);
                }
                return ['path' => $path,'name' => $clientName,'icon' => 1,'downpath' => $down,'epid' => $epid];
            }
            return ['error' => '上传文件失败','icon' => 2];


        }
        return ['error' => '上传文件失败','icon' => 2];
    }

    /**确认资料
     * @param Request $request
     * @return array
     */
    public function trueDocument (Request $request) {
        if($request->ajax()){
            $data = $request->only('epid','pid','eventid');
            //验证是否为指定身份提交
            $starttype = DB::table('t_e_eventprocessconfig')->where('pid',$data['pid'])->first()->starttype;
            $eventuserid = DB::table('t_e_event')->where('eventid',$data['eventid'])->first()->userid;
            $eventexpertid = DB::table('t_e_eventresponse')->where(['eventid' => $data['eventid'],'state' => 3])->first()->expertid;
            $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
            if($starttype){
                if($expertid != $eventexpertid){
                    return ['error' => '该资料应由专家确定','icon' => 2];
                }
            } else{
                if($eventuserid != session('userId')){
                    return ['error' => '该资料应由企业确定','icon' => 2];
                }
            }
            $res = DB::table('t_e_eventprocess')->where('epid',$data['epid'])->update(['state' => 2]);
            if($res){
                return ['msg' => '确认成功' ,'icon' => 1];
            }
            return ['error' => '您已经确认过资料了哦~','icon' => 2];
        }
        return ['error' => '非法请求','icon' => 2];
    }

    /**专家或者企业进行反馈
     * @param Request $request
     * @return array
     */
    public function sendRemark(Request $request)
    {
        if($request->ajax()){
            if(empty(session('userId'))){
                return ['error' => '请登陆后操作','icon' => 2];
            }
            $data = $request->input();
            $eventid = $data['eventid'];
            unset($data['eventid']);
            //获取到这个办事的发起人
            $eventuserid = DB::table('t_e_event')->where('eventid',$eventid)->first()->userid;
            //获取到这个办事被选择的专家的expertid
            $eventexpertid = DB::table('t_e_eventresponse')->where(['eventid' => $eventid,'state' => 3])->first()->expertid;
            //获取到当前登录用户的专家的id
            $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
            //若这个用户是专家  若不是 则只需判定办事的发起人是不是这个当前的登录者
            if(!empty($expertid)){
                //若被选择的专家id不是登录用户专家id 且 办事发起人不是当前用户
                if($eventexpertid != $expertid && $eventuserid != session('userId')){
                    return ['error' => '您不是办事企业或者受邀专家','icon' => 2];
                }
                //判定发起人是谁
                if($eventuserid == session('userId')){
                    $data['adduser'] = DB::table('t_u_enterprise')->where('userid',session('userId'))->first()->enterprisename;
                } elseif ($eventexpertid == $expertid){
                    $data['adduser'] = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertname;
                }
            } else {
                if($eventuserid != session('userId')){
                    return ['error' => '您不是办事企业','icon' => 2];
                } else {
                    $data['adduser'] = DB::table('t_u_enterprise')->where('userid',session('userId'))->first()->enterprisename;
                }
            }
            $data['addtime'] = date('Y-m-d H:i:s',time());
            DB::table('t_e_eventprocessremark')->insert($data);
            return ['msg' => '反馈成功' , 'icon' => 1];

        }
        return ['error' => '非法请求','icon' => 2];
    }

    /**添加过程的最后一步
     * @param Request $request
     * @return int
     */
    public function addEventTask(Request $request)
    {
        $data = $request->input();
        $res = DB::table('t_e_eventprocess')->where(['pid' => $data['pid'],'eventid' => $data['eventid']])->first();
        if(empty($res)){
            $data['state'] = 0;
            $epid = DB::table('t_e_eventprocess')->insertGetId($data);
            return $epid;
        }
        return 0;
    }

    /**提交日程
     * @param Request $request
     * @return array
     */
    public function submitTask(Request $request)
    {
        if($request->ajax()){
            $data = $request->input();
            //获取到这个办事的发起人
            $eventuserid = DB::table('t_e_event')->where('eventid',$data['eventid'])->first()->userid;
            //获取到这个办事被选择的专家的expertid
            $eventexpertid = DB::table('t_e_eventresponse')->where(['eventid' => $data['eventid'],'state' => 3])->first()->expertid;
            //获取到当前登录用户的专家的id
            $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
            if($eventuserid == session('userId') || $expertid == $eventexpertid){
                if(!$data['state']){
                    $etid = DB::table('t_e_eventtask')->insertGetId([
                        'epid' => $data['epid'],
                        'taskname' => $data['taskname'],
                        'createuserid' => session('userId'),
                        'addtime' => date('Y-m-d H:i:s',time()),
                        'state' => 0,
                    ]);
                    if($etid){
                        return ['msg' => '添加日程成功','icon' => 1,'etid' => $etid];
                    }
                    return ['error' => '添加日程失败','icon' => 2];
                } elseif ($data['state'] == 1){
                    if($eventuserid == session('userId')){
                        $name = DB::table('t_u_enterprise')->where('userid',session('userId'))->first()->enterprisename;
                        $operate = '企业'.$name.'完成此日程';
                    } else {
                        $name = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertname;
                        $operate = '专家'.$name.'完成此日程';
                    }
                    $res = DB::table('t_e_eventtask')->where('etid',$data['etid'])->update([
                        'state' => 1,
                        'finishtime' => date('Y-m-d H:i:s',time()),
                        'operate' => $operate
                    ]);
                    if($res){
                        return ['msg' => '完成日程成功','icon' => 1];
                    }
                    return ['error' => '处理失败','icon' => 2];
                } elseif ($data['state'] == 2){
                    if($eventuserid == session('userId')){
                        $name = DB::table('t_u_enterprise')->where('userid',session('userId'))->first()->enterprisename;
                        $operate = '企业'.$name.'删除此日程';
                    } else {
                        $name = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertname;
                        $operate = '专家'.$name.'删除此日程';
                    }
                    $res = DB::table('t_e_eventtask')->where('etid',$data['etid'])->update([
                        'state' => 2,
                        'deletetime' => date('Y-m-d H:i:s',time()),
                        'operate' => $operate
                    ]);
                    if($res){
                        return ['msg' => '删除日程成功','icon' => 1];
                    }
                    return ['error' => '处理失败','icon' => 2];
                }
                return ['error' => '处理失败','icon' => 2];

            }
            return ['error' => '非本次办事参与人','icon' => 2];
        }
        return ['error' => '非法请求','icon' => 2];
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
            //获取到get中的数据并处理            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $consult=(isset($get['consult']) && $get['consult'] != "null") ? $get['consult'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("category"=>$role):array();
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();            if(!empty($consult) && $consult == '收费'){                $consultwhere = ['fee.state' => 1];                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            if(!empty($supply)){
                $obj = $datas->where($rolewhere)->where('ext.domain1',$supply[0])->where('ext.domain2','like','%'.$supply[1].'%')->where($addresswhere)->where($consultwhere);
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }            //判断是否有搜索的关键字
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
            DB::table("t_e_eventverify")->insert([
                'eventid' => $_POST['eventId'],
                "configid"=>6,
                "verifytime"=>date("Y-m-d H:i:s",time()),
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
            $counts=DB::table("t_e_eventtcomment")->where([ "eventid"=>$eventId,"expertid"=>$_POST['expertId']])->count();
            if($counts){
                DB::table("t_e_eventtcomment")->where([ "consultid"=>$eventId,"expertid"=>$_POST['expertId']])->update([
                    "score"=>$_POST['score'],
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
            }else {
                DB::table("t_e_eventtcomment")->insert([
                    "eventid" => $eventId,
                    "expertid" => $_POST['expertId'],
                    "score" => $_POST['score'],
                    "comment" => "",
                    "commenttime" => date("Y-m-d H:i:s", time()),
                    "created_at" => date("Y-m-d H:i:s", time()),
                    "updated_at" => date("Y-m-d H:i:s", time()),
                ]);
            }
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
        return view("myenterprise.newVideoManage",compact("datas","type","counts"));
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
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
                $comperes=DB::table("t_u_bill")
                    ->leftJoin("t_u_user","t_u_user.userid","=","t_u_bill.userid")
                    ->where("t_u_bill.consultid",$consultId)
                   ->where("t_u_bill.userid",$userId)
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
        $comperes=!empty($comperes)?$comperes:"";
        $view="video".$configId;
        return view("myenterprise.".$view,compact("datas","counts","selected","selExperts","consultId","userId","comperes"));
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
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();
            if(!empty($consult) && $consult == '收费'){
                $consultwhere = ['fee.state' => 1];
                $datas = $datas->where('fee.fee','<>','null');
            } elseif(!empty($consult) && $consult == '免费'){
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }
            if(!empty($supply)){
                $obj = $datas->where($rolewhere)->where('ext.domain1',$supply[0])->where('ext.domain2','like','%'.$supply[1].'%')->where($addresswhere)->where($consultwhere);
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }
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
            \UserClass::createGroups($expertIDS,$_POST['consultId']);
            $result['code']="success";
        }else{
            $result['code']="error";
        }
        return $result;
    }
    /**视频星级评分
     * @return array
     */
    public function  toVideoExpertMsg(){
        $result=array();
        $consultId=$_POST['consultId'];
        try{
            $counts=DB::table("t_c_consultcomment")->where([ "consultid"=>$consultId,"expertid"=>$_POST['expertId']])->count();
            if($counts){
                DB::table("t_c_consultcomment")->where([ "consultid"=>$consultId,"expertid"=>$_POST['expertId']])->update([
                    "score"=>$_POST['score'],
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
            }else{
                DB::table("t_c_consultcomment")->insert([
                    "consultid"=>$consultId,
                    "expertid"=>$_POST['expertId'],
                    "score"=>$_POST['score'],
                    "comment"=>"",
                    "commenttime"=>date("Y-m-d H:i:s",time()),
                    "created_at"=>date("Y-m-d H:i:s",time()),
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
            }
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

    /**视频内容评论
     * @return array
     */
    public function   toVideoExpertContent(){
        $result=array();
        $consultId=$_POST['consultId'];
        try{
            DB::table("t_c_consultcomment")->where(["consultid"=>$consultId,"expertid"=>$_POST['expertId']])->update([
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
    
    public function manage(){
        $userId=session('userId');
        $type=isset($_GET['domain'])?$_GET['domain']:false;
        switch ($type){
            case '找资金':
                $type2 = '投融资';
                break;
            case '找技术':
                $type2 = '产品升级换代';
                break;
            case '定战略':
                $type2 = '战略定位';
                break;
            case '找市场':
                $type2 = '市场拓展';
                break;
            default :
                $type2 = 0;
                break;
        }
        $typeWhere=($type2)?array("t_e_event.domain1"=>$type2):array();
            $result=DB::table("t_e_event")
            ->leftJoin("t_e_eventverify","t_e_eventverify.eventid","=","t_e_event.eventid")
            ->select("t_e_event.eventid",'t_e_eventverify.configid',"t_e_event.domain1","t_e_event.domain2","t_e_event.created_at","t_e_event.brief")
            ->whereRaw('t_e_eventverify.id in (select max(id) from t_e_eventverify group by eventid)')
            ->where("t_e_event.userid",$userId)
            ->where($typeWhere);
        $count=clone $result;
        $datas=$result->orderBy("t_e_event.created_at","desc")->paginate(6);
        $counts=$count->count();
        foreach ($datas as $data){
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            $totals=DB::table("t_e_eventresponse")->where("eventid",$data->eventid)->count();
            if($totals!=0){
                $data->state="指定专家";
            }else{
                $data->state="匹配专家";
            }
            switch($data->domain1){
                case '投融资':
                    $data->icon = 'v-manage-link-icon';
                    break;
                case '产品升级换代':
                    $data->icon = 'v-manage-link-icon nature1';
                    break;
                case '战略定位':
                    $data->icon = 'v-manage-link-icon nature2';
                    break;
                case '市场拓展':
                    $data->icon = 'v-manage-link-icon nature3';
                    break;
                default :
                    $data->icon = 'v-manage-link-icon';
                    break;
            }
            $configname = DB::table('t_e_eventverifyconfig')->where('configid',$data->configid)->first()->name;
            $data->configname = $configname;
        }
        return view("myenterprise.newWorkManage",compact("datas","type","counts",'type2'));
    }

    public function manageVideo(){
        $userId=session('userId');
        $type=isset($_GET['domain'])?$_GET['domain']:0;
        if($type){
            switch ($type){
                case '找资金':
                    $type2 = '投融资';
                    break;
                case '找技术':
                    $type2 = '产品升级换代';
                    break;
                case '定战略':
                    $type2 = '战略定位';
                    break;
                case '找市场':
                    $type2 = '市场拓展';
                    break;
                default :
                    $type2 = 0;
                    break;
            }
        }else{
            $type = '全部';
            $type2 = 0;

        }
        $typeWhere=($type2)?array("t_c_consult.domain1"=>$type2):array();
        $result=DB::table("t_c_consult")
            ->leftJoin("t_c_consultverify","t_c_consultverify.consultid","=","t_c_consult.consultid")
            ->select("t_c_consult.consultid",'t_c_consultverify.configid',"t_c_consult.domain1","t_c_consult.domain2","t_c_consult.created_at","t_c_consult.starttime","t_c_consult.endtime","t_c_consult.brief")
            ->whereRaw('t_c_consultverify.id in (select max(id) from t_c_consultverify group by consultid)')
            ->where("t_c_consult.userid",$userId)
            ->where($typeWhere);
        $count=clone $result;
        $datas=$result->orderBy("t_c_consult.created_at","desc")->paginate(6);
        $counts=$count->count();
        foreach ($datas as $data){
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            $totals=DB::table("t_c_consultresponse")->where("consultid",$data->consultid)->count();
            if($totals!=0){
                $data->state="指定专家";
            }else{
                $data->state="匹配专家";
            }
            switch($data->domain1){
                case '投融资':
                    $data->icon = 'v-manage-link-icon';
                    break;
                case '产品升级换代':
                    $data->icon = 'v-manage-link-icon nature1';
                    break;
                case '战略定位':
                    $data->icon = 'v-manage-link-icon nature2';
                    break;
                case '市场拓展':
                    $data->icon = 'v-manage-link-icon nature3';
                    break;
                default :
                    $data->icon = 'v-manage-link-icon';
                    break;
            }
            $configname = DB::table('t_c_consultverifyconfig')->where('configid',$data->configid)->first()->name;
            $data->configname = $configname;
        }
        return view("myenterprise.newVideoManage",compact("datas","type","counts",'type2'));
    }

}
