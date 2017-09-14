<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplyController extends Controller
{
    /**供求信息列表
     * @return mixed
     */
    public function index(Request $request){
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
            ->where('status.configid',3)
            ->select('need.*','ent.enterprisename','view.role','ent.showimage as entimg','coll.count as collcount','mess.count as messcount','ext.showimage as extimg','ext.expertname');
        //获得用户的收藏
        $collectids = [];
        if(session('userId')){
            $collectids = DB::table('t_n_collectneed')->where(['userid' => session('userId'),'remark' => 1])->lists('needid');
        }
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role=(isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? explode('/',$get['supply']) : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect=( isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage=( isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role)?array("needtype"=>$role):array();
            $supplywhere = !empty($supply)?array("need.domain1"=>$supply[0],'need.domain2' => $supply[1]):array();
            $addresswhere = !empty($address)?array("ent.address"=>$address):array();
            $obj = $datas->where($rolewhere)->where($supplywhere)->where($addresswhere);
            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("need.brief","like","%".$searchname."%");
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('need.needtime',$ordertime);
            } elseif(!empty($ordercollect)){
                $obj = $obj->orderBy('coll.count',$ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count',$ordermessage);
            }
            $datas = $obj->paginate(12);
            return view("supply.index",compact('cate','searchname','datas','role','collectids','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("need.needtime",'desc')->paginate(12);
        $ordertime = 'desc';
        return view("supply.index",compact('cate','datas','ordertime','collectids'));
    }

    /**供求信息详情
     * @return mixed
     */
    public  function detail($supplyId,Request $request){
        /*Log::useFiles(storage_path().'/logs/'.date('Y-m-d').'_looks.log','info');
        Log::info('**'.ip2long($request->getClientIp()).'||'.$supplyId.'||'.$request->path().'||'.date('Y-m-d H:i:s').'**');*/
        //Log::info('looks',[ 'ip' => ip2long($request->getClientIp()), 'supplyid' => $supplyId, 'urlpath' => $request->path(), 'date' => date('Y-m-d H:i:s')]);
        /*$str = file_get_contents(storage_path().'/logs/'.date('Y-m-d').'_looks.log');
        $str = explode('**',$str);
        foreach($str as $v){
            $stemp = explode('||',$v);
            if(count($stemp) == 4){
                $arr[$stemp[1]][] = $stemp[0];
                $arr[$stemp[1]] = array_unique($arr[$stemp[1]]);
            }
        }*/
        if(!Cache::has('iplooks'.$supplyId) || Cache::get('iplooks'.$supplyId) != ip2long($request->getClientIp()).'|'.$supplyId){
            $looksinsert = DB::table('t_n_need')->where('needid',$supplyId)->increment('looks');
            if($looksinsert){
                Cache::put('iplooks'.$supplyId, ip2long($request->getClientIp()).'|'.$supplyId, 120);
            }
        }

        //取出指定的供求信息
        $verify = DB::table('view_needstatus')->where('needid',$supplyId)->first()->configid;
        if($verify != 3){
            if($verify == 1){
                return redirect(url('uct_myneed/examineNeed',$supplyId));
            } elseif ($verify == 2){
                return redirect(url('uct_myneed/supplyNeed',$supplyId));
            } else {
                return '您的需求已解决';
            }
        }
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'need.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->select('ent.brief as desc1','view.role','ext.brief as desc2','need.*','ent.enterprisename','ent.address','ext.expertname','user.phone','ent.showimage as entimg','ext.showimage as extimg');
        $obj = clone $datas;
        $datas = $datas->where('needid',$supplyId)->first();
        //取出同类下推荐的供求
        $info = ['domain1' => $datas->domain1,'domain2' =>$datas->domain2,'needid' => $datas->needid];
        $recommendNeed = $obj->where('needid','<>',$info['needid'])->orderBy('needtime','desc');
        $obj2 = clone $recommendNeed;
        //取出相同二级类下面的供求
        $recommendNeed = $recommendNeed->where(['need.domain2' => $info['domain2'],'need.domain1' => $info['domain1']])->take(5)->get();
        //不足5条时 在一级类下面查找供求
        if(count($recommendNeed) < 5){
            $commedomain1 = $obj2->where('need.domain1',$info['domain1'])->where('need.domain2','<>',$info['domain2'])->take(5-count($recommendNeed))->get();
            $recommendNeed = array_merge($recommendNeed,$commedomain1);
        }
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
            ->select('msg.*','ent.enterprisename','ext.expertname','user.avatar','user.nickname','user.phone','user2.nickname as nickname2','user2.phone as phone2')
            ->orderBy('messagetime','desc')
            ->get();
        //分组取出每个回复的数量
        $getmsgcount = DB::table('t_n_messagetoneed')->where('needid',$supplyId)->groupBy('parentid')->select(DB::raw('parentid ,count(*) as count'))->having('parentid','<>',0)->get();
        $msgcount = [];
        foreach ($getmsgcount as $k => $v) {
            $msgcount[$v->parentid] = $v->count;
        }
        return view("supply.detail",compact('datas','recommendNeed','message','collectids','msgcount'));
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
            if(empty($data['supplyid'])){
                return 'error';
            }
            $userid = session('userId');
            $where = ['needid' => $data['supplyid'],'userid' => $userid];
            $verify = DB::table('view_needstatus')->where('needid',$data['supplyid'])->first()->configid;
            if($verify != 3){
                return 'error';
            }
            if($data['action'] == 'collect'){
                $is_insert =  DB::table('t_n_collectneed')->where($where)->first();
                if($is_insert){
                    $res = DB::table('t_n_collectneed')->where($where)->update(['remark' => 1]);
                } else {
                    $res = DB::table('t_n_collectneed')->insertGetId([
                        'needid' => $data['supplyid'],
                        'userid' => $userid,
                        'collecttime' => date('Y-m-d H:i:s',time()),
                        'remark' => 1,
                        'updated_at' => date('Y-m-d H:i:s',time())
                    ]);
                }
            } elseif ($data['action'] == 'cancel') {
                $res = DB::table('t_n_collectneed')->where($where)->update(['remark' => 0]);
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
            $data['userid'] = session('userId');
            $data['messagetime'] = date('Y-m-d H:i:s',time());
            $res = DB::table('t_n_messagetoneed')->insert($data);
            if($res){
                return 'success';
            } else {
                return 'error';
            }
        }
        return 'error';
    }
}