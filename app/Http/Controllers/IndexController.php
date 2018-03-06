<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index(){
      
      
        $datas=DB::table("T_U_EXPERT")
                ->leftJoin("T_U_EXPERTFEE","T_U_EXPERTFEE.expertid","=","T_U_EXPERT.expertid")
                ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERTVERIFY.expertid","=","T_U_EXPERT.expertid")
                ->select("T_U_EXPERT.expertname","T_U_EXPERT.brief","T_U_EXPERT.expertid","T_U_EXPERT.category","T_U_EXPERT.domain1","T_U_EXPERTFEE.fee","T_U_EXPERTFEE.state","T_U_EXPERT.showimage")
                ->where("isfirst",1)
                ->whereIn("T_U_EXPERTVERIFY.configid",[2,4])
                ->whereRaw("T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by T_U_EXPERTVERIFY.expertid)")
                ->take(12)
                ->orderBy("T_U_EXPERT.order","asc")
                ->orderBy("T_U_EXPERT.expertid","desc")
                ->get();
           
        return view("index.index",compact("datas"));
    }



}
