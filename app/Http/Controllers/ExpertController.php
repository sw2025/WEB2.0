<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpertController extends Controller
{
    /**专家列表
     * @return mixed
     */
    public function index(Request $request){
        //获取板块信息

        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','ext.expertid' ,'=' ,'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll','ext.expertid' ,'=' ,'coll.expertid')
            ->leftJoin('view_expertmesscount as mess','ext.expertid' ,'=' ,'mess.expertid')
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
            $datas = $obj->paginate(5);
            return view("expert.index",compact('cate','searchname','datas','role','collectids','consult','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(5);
        $ordertime = 'desc';
        return view("expert.index",compact('cate','datas','ordertime','collectids'));

    }

    /**专家详情
     * @return mixed
     */
    public  function detail($expertid){
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
        return view("expert.detail",compact('datas','recommendNeed','message','collectids','msgcount'));
    }
    //收藏专家
    public  function  collectExpert(){
        $array=array();
        $userId=session("userId");
        $count=DB::table("T_U_COLLECTEXPERT")->where("userid",$userId)->where("expertid",$_POST['expertId'])->count();
        if($count){
            $result=DB::table("T_U_COLLECTEXPERT")->where("userid",$userId)->where("expertid",$_POST['expertId'])->update([
                "remark"=>$_POST['remark'],
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }else{
            $result=DB::table("T_U_COLLECTEXPERT")->insert([
                "userid"=>$userId,
                "expertid"=>$_POST['expertId'],
                "collecttime"=>date("Y-m-d H:i:s",time()),
                "remark"=>$_POST['remark'],
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }
        if($result){
            return $array['code']= "success";
        }else{
            return $array['code']="false";
        }
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
            $data = $request->only('action', 'supplyid');
            $userid = session('userId');
            $where = ['expertid' => $data['supplyid'],'userid' => $userid];
            if($data['action'] == 'collect'){
                $is_insert =  DB::table('t_u_collectexpert')->where($where)->first();
                if($is_insert){
                    $res = DB::table('t_u_collectexpert')->where($where)->update(['remark' => 1]);
                } else {
                    $res = DB::table('t_u_collectexpert')->insertGetId([
                        'expertid' => $data['supplyid'],
                        'userid' => $userid,
                        'collecttime' => date('Y-m-d H:i:s',time()),
                        'remark' => 1,
                        'updated_at' => date('Y-m-d H:i:s',time())
                    ]);
                }
            } elseif ($data['action'] == 'cancel') {
                $res = DB::table('t_u_collectexpert')->where($where)->update(['remark' => 0]);
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
        if(!session('userId')) {
            return 'nologin';
        }
        if($request->ajax()){
            $data = $request->only('content', 'needid','parentid','use_userid');
            $data['expertid'] = $data['needid'];
            unset($data['needid']);
            $data['userid'] = session('userId');
            $data['messagetime'] = date('Y-m-d H:i:s',time());
            $res = DB::table('t_u_messagetoexpert')->insert($data);
            if($res){
                return 'success';
            } else {
                return 'error';
            }
        }
        return 'error';
    }
}