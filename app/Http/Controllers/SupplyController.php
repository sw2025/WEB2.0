<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            ->select('need.*','ent.enterprisename','ent.showimage as entimg','ext.showimage as extimg','ext.expertname');
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
            $datas = $obj->paginate(2);
            return view("supply.index",compact('cate','searchname','datas','role','supply','address','ordertime','ordercollect','ordermessage'));
        }
        $datas = $datas->orderBy("need.needtime",'desc')->paginate(2);
        $ordertime = 'desc';
        return view("supply.index",compact('cate','datas','ordertime'));
    }

    /**供求信息详情
     * @return mixed
     */
    public  function detail($supplyId){
        //取出指定的供求信息
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'need.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->select('ent.brief as desc1','ext.brief as desc2','need.*','ent.enterprisename','ent.address','ext.expertname','user.phone','ent.showimage as entimg','ext.showimage as extimg');
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

        //查询留言的信息
        $message = DB::table('t_n_messagetoneed as msg')
            ->leftJoin('view_userrole as view','view.userid', '=','msg.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'msg.userid')
            ->where('needid',$supplyId)
            ->select('msg.*','ent.enterprisename','ext.expertname','user.nickname','user.name')
            ->get();
        return view("supply.detail",compact('datas','recommendNeed','message'));
    }

   
}
