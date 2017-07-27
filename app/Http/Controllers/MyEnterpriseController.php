<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            $action = empty($get['action']) ? null : $get['action'];
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
                ->leftJoin("t_e_eventresponse","t_e_eventresponse.eventid","=","t_e_event.eventid")
                ->leftJoin("t_e_eventverify","t_e_eventverify.eventid","=","t_e_event.eventid")
                ->select("t_e_event.eventid","t_e_event.domain1","t_e_event.domain2","t_e_event.created_at","t_e_event.brief","t_e_eventresponse.state")
                ->whereRaw('t_e_eventverify.id in (select max(id) from t_e_eventverify group by eventid)')
                ->where("t_e_event.userid",$userId)
                ->where($typeWhere);
        $count=clone $result;
        $datas=$result->orderBy("t_e_event.created_at","desc")->paginate(2);
        $counts=$count->count();
        foreach ($datas as $data){
            $data->work=$data->domain1."/".$data->domain2;
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            if($data->state==0){
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
            case 8:
                $type="已评价";
            break;
            case 9:
                $type="异常终止";
            break;
        }
        return view("myenterprise.works",compact("datas","type","counts"));
    }
    public function workDetail($eventId){
        dd(123);
    }

    /**申请办事服务
     * @return mixed
     */
    public function applyWork(){

        return view("myenterprise.work1");
    }
    /**视频咨询
     * @return mixed
     */
    public function video(){
        return view("myenterprise.video");
    }
    /**申请视频咨询1
     * @return mixed
     */
    public function video1(){
        return view("myenterprise.video1");
    }
    /**视申请视频咨询2
     * @return mixed
     */
    public function video2(){
        return view("myenterprise.video2");
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
