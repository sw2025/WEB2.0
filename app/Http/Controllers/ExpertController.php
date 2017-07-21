<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExpertController extends Controller
{
    /**专家列表
     * @return mixed
     */
    public function index(){
        return view("expert.index");
    }

    /**专家详情
     * @return mixed
     */
    public  function detail(){
        return view("expert.detail");
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





}
