<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
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
        $invests=$invest->where("DOMAIN1","融资投资")->take(5)->get();
        $works=$work->where("DOMAIN1","战略合作")->take(5)->get();
        $products=$product->where("DOMAIN1","产品升级")->take(5)->get();
        $markets=$market->where("DOMAIN1","市场运营")->take(5)->get();
        return view("index.index",compact("invests","works","products","markets"));
    }

}
