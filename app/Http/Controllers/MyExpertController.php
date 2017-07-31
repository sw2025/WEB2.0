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
                    return ['msg' => '添加专家认证成功,进入审核阶段','icon' => 1];
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

    /**我的办事
     * @return mixed
     */
    public function mywork(Request $request){
        //获取到登陆用户的专家的id
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $countobj = DB::table('t_e_eventresponse as res')
            ->leftJoin('view_eventstatus as status','status.eventid','=','res.eventid');
        $countobj2 = clone $countobj;
        $countobj3 = clone $countobj;
        //专家已响应的办事数量
        $responsecount = $countobj->where(['res.state' => 3,'res.expertid' => $expertid,'status.configid' => 5])->count();
        //专家受邀请（被推送）的办事数量
        $putcount = $countobj2->where(['res.expertid' => $expertid,'status.configid' => 4])->count();
        //专家已经完成的办事数量
        $complatecount = $countobj3->where(['res.state' => 4,'res.expertid' => $expertid,'status.configid' => 7])->count();
        $datas = DB::table('t_e_eventresponse as res')
            ->leftJoin('t_e_event as event','event.eventid','=','res.eventid')
            ->leftJoin('t_u_enterprise as ent','event.userid','=','ent.userid')
            ->leftJoin('view_eventstatus as status','status.eventid','=','res.eventid')
            ->whereRaw('res.id in (select max(id) from t_e_eventresponse group by eventid)')
            ->select('res.*','event.domain1','event.domain2','event.brief','status.configid','event.eventtime','ent.enterprisename as name');
        $obj = clone $datas;
        $ajaxobj = clone $datas;
        $ajaxobj = $ajaxobj->where(['res.expertid' => $expertid]);
        $datas = $datas
            ->where(['res.expertid' => $expertid,'status.configid' => 4])
            ->orderBy('res.id','desc')
            ->paginate(2);
        $datas2 = $obj
            ->where(['res.expertid' => $expertid])
            ->whereIn('status.configid',[4,5,7])
            ->orderBy('res.id','desc')
            ->paginate(2);
        $datas = \EventClass::handelObj($datas);
        $datas2 = \EventClass::handelObj($datas2);
        if($request->ajax()){
            $action = $request->input()['action'];
            if(!$action){
                return $datas;
            } elseif($action == 1){
                return $datas2;
            } else {
                $ajaxobj = $ajaxobj->where(['status.configid' => $action])->paginate(2);
                $ajaxobj = \EventClass::handelObj($ajaxobj);
                return $ajaxobj;
            }
        }
        return view("myexpert.mywork",compact('datas','datas2','responsecount','putcount','complatecount'));
    }

    /**我的办事详情
     * @return mixed
     */
    public function  workDetail($eventid){
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $datas = DB::table('t_e_event as event')
            ->leftJoin('t_e_eventresponse as res','event.eventid','=','res.eventid')
            ->leftJoin('t_u_enterprise as ent','event.userid','=','ent.userid')
            ->leftJoin('view_eventstatus as status','status.eventid','=','res.eventid')
            ->where('event.eventid',$eventid)
            ->first();
        if($datas->expertid != $expertid){
            return redirect('/');
        }
        return view("myexpert.workDetail",compact('datas'));
    }

    /**我的咨询
     * @return mixed
     */
    public function myask(Request $request){
        //获取到登陆用户的专家的id
       /* $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $countobj = DB::table('t_c_consultresponse as res')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid');
        $countobj2 = clone $countobj;
        $countobj3 = clone $countobj;
        //专家已响应的咨询数量
        $responsecount = $countobj->where(['res.state' => 3,'res.expertid' => $expertid,'status.configid' => 5])->count();
        //专家受邀请（被推送）的咨询数量
        $putcount = $countobj2->where(['res.expertid' => $expertid,'status.configid' => 4])->count();
        //专家已经完成的咨询数量
        $complatecount = $countobj3->where(['res.state' => 4,'res.expertid' => $expertid,'status.configid' => 7])->count();
        $datas = DB::table('t_c_consultresponse as res')
            ->leftJoin('t_c_consult as consult','consult.consultid','=','res.consultid')
            ->leftJoin('t_u_enterprise as ent','consult.userid','=','ent.userid')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid')
            ->whereRaw('res.id in (select max(id) from t_c_consultresponse group by consultid)')
            ->select('res.*','consult.domain1','consult.domain2','consult.brief','status.configid','consult.consulttime','ent.enterprisename as name');
        $obj = clone $datas;
        $ajaxobj = clone $datas;
        $ajaxobj = $ajaxobj->where(['res.expertid' => $expertid]);
        $datas = $datas
            ->where(['res.expertid' => $expertid,'status.configid' => 4])
            ->orderBy('res.id','desc')
            ->paginate(2);
        $datas2 = $obj
            ->where(['res.expertid' => $expertid])
            ->whereIn('status.configid',[4,5,7])
            ->orderBy('res.id','desc')
            ->paginate(2);
        $datas = \ConsultClass::handelObj($datas);
        $datas2 = \ConsultClass::handelObj($datas2);
        if($request->ajax()){
            $action = $request->input()['action'];
            if(!$action){
                return $datas;
            } elseif($action == 1){
                return $datas2;
            } else {
                $ajaxobj = $ajaxobj->where(['status.configid' => $action])->paginate(2);
                $ajaxobj = \ConsultClass::handelObj($ajaxobj);
                return $ajaxobj;
            }
        }
        return view("myexpert.myask",compact('datas','datas2','responsecount','putcount','complatecount'));*/
        return view("myexpert.myask");
    }

    /**我的咨询的详情
     * @return mixed
     */
    public function  askDetail($consultid){

        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $datas = DB::table('t_e_consult as consult')
            ->leftJoin('t_c_consultresponse as res','consult.consultid','=','res.consultid')
            ->leftJoin('t_u_enterprise as ent','consult.userid','=','ent.userid')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid')
            ->where('consult.consultid',$consultid)
            ->first();
        if($datas->expertid != $expertid){
            return redirect('/');
        }
        return view("myexpert.askDetail",compact('datas'));
    }

    /**进入视频会议
     * @return mixed
     */
    public function myaskinvt(){
        return view("myexpert.myaskinvt");
    }
    
}
