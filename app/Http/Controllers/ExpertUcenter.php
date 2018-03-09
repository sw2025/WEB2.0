<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpertUcenter extends Controller
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
        $cate = DB::table('t_common_domaintype')->where('level',1)->get();
        $data = DB::table('t_u_expert as expert')
                ->leftJoin('view_expertstatus as status','expert.expertid','=','status.expertid')
                ->where('expert.userid', $userid)
                ->first();

        return view('expertUcenter.expertinfo',compact('data','cate'));
    }

    public function submitExpertVerify(Request $request)
    {
        //判断是否为ajax请求
        if($request->ajax()){
            //判断是否登陆
            if(!empty(session('userId'))){
                $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first();
                $data = $request->input();
                $domain1 = $data['domain'];
                $file = $request->file('file');
                //开启事务
                DB::beginTransaction();
                try{
                    if ($file->isValid()) {

                        // 获取文件相关信息
                        $originalName = $file->getClientOriginalName(); // 文件原名
                        $ext = $file->getClientOriginalExtension();     // 扩展名
                        $realPath = $file->getRealPath();   //临时文件的绝对路径
                        $type = $file->getClientMimeType();     // image/jpeg

                        // 上传文件
                        $filename = date('YmdHis'). uniqid() . '.' . $ext;
                        // 使用我们新建的uploads本地存储空间（目录）
                        $bool = Storage::disk('uploadexpert')->put($filename, file_get_contents($realPath));
                    } else {
                        return ['msg' => '上传失败~','icon' => 2,'code' => 4];
                    }
                    if(empty($expertid->expertid)) {
                        $expertid = DB::table("T_U_EXPERT")
                            ->insertGetId([
                                "userid" => session('userId'),
                                "expertname" => $data['expertname'],
                                "address" => $data['address'],
                                "showimage" => '/images/'.$filename,
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                'organiza' => $data['organiza'],
                                'job' => $data['job'],
                                'worklife' => $data['worklife'],
                                'edubg' => $data['edubg'],
                                'workexperience' => $data['workexperience'],
                            ]);
                    }else{
                        $expertdata = DB::table("T_U_EXPERT")
                            ->where('expertid',$expertid->expertid)
                            ->update([
                                "expertname" => $data['name'],
                                "address" => $data['address'],
                                "showimage" => '/images/'.$filename,
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                'organiza' => $data['organiza'],
                                'job' => $data['job'],
                                'worklife' => $data['worklife'],
                                'edubg' => $data['edubg'],
                                'enterjob' => $data['enterjob'],
                            ]);
                        $expertid = $expertid->expertid;
                    }
                    if(!empty($expertid)){
                        // $configid=DB::table("t_u_expertverify")->where("expertid",$expertid)->orderBy("ID",'desc')->first();
                        $result=DB::table("T_U_EXPERTVERIFY")
                            ->insert([
                                "expertid"=>$expertid,
                                "configid"=>1,
                                "verifytime"=>date("Y-m-d H:i:s",time()),
                                "updated_at"=>date("Y-m-d H:i:s",time())
                            ]);
                    }
                    DB::commit();
                    return ['msg' => '添加专家认证成功,进入审核阶段','icon' => 1,'code' => 1];
                }catch(Exception $e){

                    DB::rollBack();
                    return ['msg' => '处理失败','icon' => 2,'code' => 2];
                }
            }
            return ['msg' => '请登录','icon' => 2,'code' => 3];
        }
        return ['msg' => '非法访问','icon' => 2,'code' => 2];
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
