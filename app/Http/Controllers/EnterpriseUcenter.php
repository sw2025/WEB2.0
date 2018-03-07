<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EnterpriseUcenter extends Controller
{


    public function __construct()
    {
        parent::__construct();

    }

    /**企业个人中心首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Index()
    {
        $userid = session('userId');
        $entinfo = DB::table('t_u_enterprise')->where('userid', $userid)->first();
        return view('enterpriseUcenter.enterpriseinfo',compact('entinfo'));
    }

    /**ajax修改企业数据
     * @param Request $request
     */
    public function modifyEntData(Request $request)
    {
        if(empty(session('userId'))){
            return ['icon' => 2,'msg' => '未登录请登录','url' => url('/login')];
        }
        $data = $request->input();
        $entinfo = DB::table('t_u_enterprise')->where('userid',session('userId'))->pluck('enterpriseid');
        if(empty($entinfo)){
            $res = DB::table('t_u_enterprise')->insert([
                'enterprisename' => $data['entname'],
                'job' => $data['job'],
                'industry' => $data['industry'],
                'size' => $data['size'],
                'userid' => session('userId')
            ]);
        } else {
            $res = DB::table('t_u_enterprise')->where('userid',session('userId'))->update([
                'enterprisename' => $data['entname'],
                'job' => $data['job'],
                'industry' => $data['industry'],
                'size' => $data['size'],
            ]);
        }

        if($res){
            return ['icon' => 1,'msg' => '修改成功'];
        } else {
            return ['icon' => 3,'msg' => '您已经修改过了'];
        }
    }

    /**我的项目评议列表展示页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myshowIndex()
    {
        $userid = session('userId');
        //获取项目评议所有数据
        $data = DB::table('t_s_show as show')
            ->leftJoin('view_showstatus as status','status.showid','=','show.showid')
            ->where('show.userid',$userid)
            ->select('show.*','status.configid')
            ->orderBy('show.showid','desc')
            ->paginate(3);
        $expertinfo = [];
        $configname = [1 => '已保存',2 => '已支付' ,3 => '未通过审核',4 => '已推送' ,5 => '已完成',6 => '已评价'];
        foreach($data as $k => $v){
            $expert = DB::table('t_u_expert')
                ->whereIn('expertid',explode(',',$v->expertids))
                ->select('expertid','showimage','expertname')
                ->get();
            $expertinfo[$k] = $expert;
            $v->configname = $configname[$v->configid];
        }
        return view('enterpriseUcenter.myshowindex',compact('data','expertinfo'));
    }
}
