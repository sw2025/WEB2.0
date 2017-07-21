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
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_n_need as need')
            ->leftJoin('view_userrole as view','view.userid', '=','need.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_user as user','need.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->select('need.*','ent.enterprisename','ent.showimage as entimg','ext.showimage as extimg','ext.expertname');

        if(!empty($get = $request->input())){
            $role=(isset($get['role'])&&$get['role']!="null")?$get['role']:null;
            $supply=(isset($get['supply'])&&$get['supply']!="null")?$get['supply']:null;
            $address=(isset($get['address'])&&$get['address']!="null")?$get['address']:null;
            $ordertime=( isset($get['ordertime'])&&$get['ordertime']!="null")?$get['ordertime']:null;
            $ordercollect=( isset($get['$ordercollect'])&&$get['$ordercollect']!="null")?$get['$ordercollect']:null;
            $ordermessage=( isset($get['$ordermessage'])&&$get['$ordermessage']!="null")?$get['$ordermessage']:null;

            $rolewhere = !empty($size)?array("needtype"=>$size):array();
            $supply = !empty($supply)?array("t_n_need.domain1"=>$supply):array();
            $address = !empty($address)?array("t_u_enterprise.address"=>$address):array();
        }

            $datas = $datas->paginate(10);
        return view("supply.index",compact('cate','datas'));
    }

    /**供求信息详情
     * @return mixed
     */
    public  function detail($supplyId){

        return view("supply.detail");
    }

   
}
