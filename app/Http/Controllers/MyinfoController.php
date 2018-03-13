<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyinfoController extends Controller
{
    public function myinfo(){
        $userid = session('userId');
        $datas=DB::table("t_m_systemmessage")
            ->where("receiveid",$userid)
            ->where("state",'<>',2)
            ->paginate(3);
        return view('myinfo.myinfo',compact('datas'));
    }
    /**修改信息已读或者删除
     * @param Request $request
     * @return array
     */
    public function flagRead (Request $request) {
        if($request->ajax()){
            $data = $request->input('data');
            $state = $request->input('state');
            $userId = session('userId');
            $res = DB::table('t_m_systemmessage')->whereIn('id',$data)->where('receiveid',$userId)->update([
                'state' => $state,
                'updated_at' => date("Y-m-d H:i:s",time())
            ]);
            if($state == 1){
                return ['msg' => '修改已读成功','icon' => 1];
            } elseif ($state == 2){
                return ['msg' => '删除消息成功','icon' => 1];
            }

        }
        return ['msg' => '非法请求','icon' => 2];
    }
}
