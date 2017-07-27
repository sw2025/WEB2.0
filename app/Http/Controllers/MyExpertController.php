<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyExpertController extends Controller
{
    /**专家认证
     * @return mixed
     */
    public function  expert(){

        $result = DB::table('view_expertstatus')->where(['userid' => session('userId')])->orderBy('configid','desc')->first();
        $cate = DB::table('t_common_domaintype')->get();
        if($result){
            if($result->configid == 2){
                return redirect()->action('MyExpertController@expert2');
            }else{
                return redirect()->action('MyExpertController@expert3');
            }
        }else{
            return view("myexpert.expert",compact('cate'));
        }

    }
    /**专家审核
     */
    public function  expert2(){

        $data=DB::table("T_U_USER")
            ->leftJoin("T_U_EXPERT","T_U_USER.USERID","=","T_U_EXPERT.USERID")
            ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERT.EXPERTID","=","T_U_EXPERTVERIFY.expertid")
            ->select("T_U_EXPERT.*")
            ->where("T_U_EXPERT.userid",3)
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->first();
        return view("myexpert.expert2",compact('data'));
    }
    /**认证成功
     */
    public function expert3(){

        $data=DB::table("T_U_USER")
            ->leftJoin("T_U_EXPERT","T_U_USER.USERID","=","T_U_EXPERT.USERID")
            ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERT.EXPERTID","=","T_U_EXPERTVERIFY.expertid")
            ->select("T_U_EXPERT.*")
            ->where("T_U_EXPERT.userid",3)
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->first();
        //dd($data);
        return view("myexpert.expert3",compact('data'));
    }


    /**专家资料提交
     */
    public function expertData(Request $request)
    {

        //判断是否为ajax请求
        if($request->ajax()){
            //判断是否登陆
            if(!empty(session('userId'))){
                $data = $request->input();
                /*$role = DB::table('view_userrole')->where('userid',session('userId'))->first()->role;*/
                $domain1 = explode('/',$data['industry'])[0];
                $domain2 = explode('/',$data['industry'])[1];
                //开启事务
                DB::beginTransaction();
                try{
                    $expertid=DB::table("T_U_EXPERT")
                        ->insertGetId([
                            "userid"=>session('userId'),
                            "expertname"=>$data['name'],
                            "category"=>$data['category'],
                            "address"=>$data['address'],
                            "licenceimage"=>$data['photo1'],
                            "showimage"=>$data['photo2'],
                            "brief"=> $data['brief'],
                            "domain1"=>$domain1,
                            "domain2"=>$domain2,
                            "created_at"=>date("Y-m-d H:i:s",time()),
                            "updated_at"=>date("Y-m-d H:i:s",time())
                        ]);

                    if(!empty($expertid)){
                        $result=DB::table("T_U_EXPERTVERIFY")
                            ->insert([
                                "expertid"=>$expertid,
                                "configid"=>1,
                                "remark"=>$data['brief'],
                                "verifytime"=>date("Y-m-d H:i:s",time()),
                                "created_at"=>date("Y-m-d H:i:s",time()),
                                "updated_at"=>date("Y-m-d H:i:s",time())
                            ]);
                    }

                    DB::commit();
                    return ['msg' => '添加需求成功,进入审核阶段','icon' => 1];
                }catch(Exception $e)
                {
                    DB::rollBack();
                    return ['msg' => '处理失败','icon' => 2];
                }
            }
            return ['msg' => '请登录','icon' => 2];
        }
        return ['msg' => '非法访问','icon' => 2];

    /*  $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $array=array();*/

        //$userid = $_SESSION['userid'];

    }
}
