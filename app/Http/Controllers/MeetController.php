<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/5
 * Time: 11:33
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class MeetController extends Controller
{

    /**
     * 约见投资人页面
     *
     **/
    public function Index($meetid=0)
    {
        $cate = DB::table('t_common_domaintype')->where('level',1)->get();

        return view('meet.index',compact('cate','meetid'));
    }


    /**
     * 查询投资人资费
     */
  /*  public function selectFee()
    {

        $expertid = (explode(" ",$_POST['ids']));
        foreach ($expertid as $value){
            DB::table('t_u_expert')
                ->leftJoin('t_u_expertfee','t_u_expert.expertid','=','t_u_expertfee.expertid')
                ->where('t_u_expertfee.state',0)
                ->where('t_u_expert',$value)->select('t_u_expert.expertname','t_u_expertfee.linefee')
                ->first();
        }
        dd($expertid);
    }*/

    //提交约见投资人资料

    public function sublitMeet(Request $request)
    {
        $data = $request->input();
        $userid = empty(session('userId')) ? '':session('userId');
        DB::beginTransaction();
        try{


        }catch(\Illuminate\Database\QueryException $e){
            //异常处理
        }
    }
}