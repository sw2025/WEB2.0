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
        $invest=DB::table("T_N_NEED")
            ->leftJoin("T_N_NEEDVERIFY","T_N_NEEDVERIFY.needid","=","T_N_NEED.needid")
            ->select("T_N_NEED.needid","T_N_NEED.created_at","T_N_NEED.brief")
            ->whereRaw('T_N_NEEDVERIFY.id in (select max(id) from T_N_NEEDVERIFY group by  T_N_NEEDVERIFY.needid)')
            ->where("configid",3)
            ->orderBy("T_N_NEED.created_at","desc");
        $work=clone $invest;
        $product=clone $invest;
        $market=clone $invest;
        $invests=$invest->where("domain1","资金需求")->take(5)->get();
        $works=$work->where("domain1","战略与管理")->take(5)->get();
        $products=$product->where("domain1","找技术")->take(5)->get();
        $markets=$market->where("domain1","寻合作")->take(5)->get();
        $invests=\NeedClass::dataHandle($invests);
        $works=\NeedClass::dataHandle($works);
        $products=\NeedClass::dataHandle($products);
        $markets=\NeedClass::dataHandle($markets);
        return view("index.index",compact("invests","works","products","markets"));
    }

    /**
     * 首页获取专家数据
     * @return array
     */
    public  function returnData(){
        $result=array();
        $expertType=!empty($_POST['type'])?$_POST['type']:"知名机构";
        switch($expertType){
            case "知名机构":
                $expertType="机构";
            break;
            case "资深专家":
                $expertType="专家";
                break;
            case "成功企业家":
                $expertType="企业家";
                break;
        }
        $datas=DB::table("T_U_EXPERT")
                ->leftJoin("T_U_EXPERTFEE","T_U_EXPERTFEE.expertid","=","T_U_EXPERT.expertid")
                ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERTVERIFY.expertid","=","T_U_EXPERT.expertid")
                ->select("T_U_EXPERT.expertname","T_U_EXPERT.brief","T_U_EXPERT.expertid","T_U_EXPERT.category","T_U_EXPERT.domain1","T_U_EXPERTFEE.fee","T_U_EXPERTFEE.state","T_U_EXPERT.showimage")
                ->where("isfirst",1)
                ->where("category",$expertType)
                ->whereIn("T_U_EXPERTVERIFY.configid",[2,4])
                ->whereRaw("T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by T_U_EXPERTVERIFY.expertid)")
                ->take(5)
                ->orderBy("T_U_EXPERT.created_at","desc")
                ->get();
            foreach ($datas as $data){
                if($data->state==0){
                    $data->fee="免费";
                }else{
                    $data->fee=$data->fee."元";
                }
                if(!empty(session('userId'))){
                    $userId=session('userId');
                    $collects=DB::table("T_U_COLLECTEXPERT")->where("userid",$userId)->where("expertid",$data->expertid)->pluck("remark");
                    if(empty($collects) || $collects=="0"){
                        $data->collect=0;
                    }else{
                        $data->collect=1;
                    }
                }else{
                    $data->collect=0;
                }
            }
        if($datas){
            $result['code']="success";
            $result['msg']=$datas;
        }else{
            $result['code']="error";
        }
        return $result;
    }

}
