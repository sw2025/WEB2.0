<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MyExpertController extends Controller
{
    /**专家认证
     * @return mixed
     */
    public function  expert(){

        //$result = DB::table('view_expertstatus')->where(['userid' => session('userId')])->orderBy('configid','desc')->first();
        $cate = DB::table('t_common_domaintype')->get();
        $result = DB::table('t_u_expert')
            ->leftjoin('t_u_expertverify',"t_u_expert.expertid","=","t_u_expertverify.expertid")
            ->where(['userid' => session('userId')])
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->orderBy('configid','desc')
            ->first();
        //dd($result);
        if(!empty($result)) {
            if ($result->configid == 1) {
                return redirect()->action('MyExpertController@expert2');
            } elseif ($result->configid == 2) {
                return redirect()->action('MyExpertController@expert3');
            }
        }
        return view("myexpert.expert",compact('cate','result'));


    }
    /**专家审核
     */
    public function  expert2(){
        $data=DB::table("T_U_USER")
            ->leftJoin("T_U_EXPERT","T_U_USER.USERID","=","T_U_EXPERT.USERID")
            ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERT.EXPERTID","=","T_U_EXPERTVERIFY.expertid")
            ->select("T_U_EXPERT.*","T_U_EXPERTVERIFY.configid")
            ->where("T_U_EXPERT.userid",session('userId'))
            ->where("T_U_EXPERTVERIFY.configid",1)
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->first();
        if(!$data){
            return redirect()->action('MyExpertController@expert');
        }
        return view("myexpert.expert2",compact('data'));
    }
    /**认证成功
     */
    public function expert3(){
        $data=DB::table("T_U_USER")
            ->leftJoin("T_U_EXPERT","T_U_USER.USERID","=","T_U_EXPERT.USERID")
            ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERT.EXPERTID","=","T_U_EXPERTVERIFY.expertid")
            ->select("T_U_EXPERT.*","T_U_EXPERTVERIFY.configid")
            ->where("T_U_EXPERT.userid",session('userId'))
            ->whereIn("T_U_EXPERTVERIFY.configid",[2,4])
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->first();
        if(!$data){
            return redirect()->action('MyExpertController@expert');
        }
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
                $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first();
                $data = $request->input();
                $domain1 = explode('-',$data['industry'])[0];
                $domain2 = explode('-',$data['industry'])[1];
                $domain2 = trim(str_replace('/',',',$domain2),',');
                //开启事务
                DB::beginTransaction();
                try{
                    if(empty($expertid->expertid)) {
                        $expertid = DB::table("T_U_EXPERT")
                            ->insertGetId([
                                "userid" => session('userId'),
                                "expertname" => $data['name'],
                                "category" => $data['category'],
                                "address" => $data['address'],
                                "licenceimage" => $data['photo1'],
                                "showimage" => $data['photo2'],
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                "domain2" => $domain2,
                                "industry"=>$data['industrys'],
                                "created_at" => date("Y-m-d H:i:s", time()),
                                "updated_at" => date("Y-m-d H:i:s", time())
                            ]);
                    }else{
                        $expertdata = DB::table("T_U_EXPERT")
                            ->where('expertid',$expertid->expertid)
                            ->update([
                                "expertname" => $data['name'],
                                "category" => $data['category'],
                                "address" => $data['address'],
                                "licenceimage" => $data['photo1'],
                                "showimage" => $data['photo2'],
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                "domain2" => $domain2,
                                "industry"=>$data['industrys'],
                                "created_at" => date("Y-m-d H:i:s", time()),
                                "updated_at" => date("Y-m-d H:i:s", time())
                            ]);
                        $expertid = $expertid->expertid;
                    }
                    if(!empty($expertid)){
                        $result=DB::table("T_U_EXPERTVERIFY")
                            ->insert([
                                "expertid"=>$expertid,
                                "configid"=>1,
                                "verifytime"=>date("Y-m-d H:i:s",time()),
                                "updated_at"=>date("Y-m-d H:i:s",time())
                            ]);
                    }
                    DB::commit();
                    return ['msg' => '添加专家认证成功,进入审核阶段','icon' => 1];
                }catch(Exception $e){
                
                    DB::rollBack();
                    return ['msg' => '处理失败','icon' => 2];
                }
            }
            return ['msg' => '请登录','icon' => 2];
        }
        return ['msg' => '非法访问','icon' => 2];
    }

    /**我的办事
     * @return mixed
     */
    public function mywork(Request $request){
        //获取到登陆用户的专家的id
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(empty($expert)){
            $expertid = 0;
        } else {
            $expertid = $expert->expertid;
        }
            $countobj = DB::table('t_e_eventresponse as res')
                ->leftJoin('view_eventstatus as status','status.eventid','=','res.eventid');
            $countobj2 = clone $countobj;
            $countobj3 = clone $countobj;
            //专家已响应的办事数量
            $responsecount = $countobj->where(['res.state' => 2,'res.expertid' => $expertid,'status.configid' => 5])->count();
            //专家受邀请（被推送）的办事数量
            $putcount = $countobj2->where(['res.expertid' => $expertid,'status.configid' => 4])->count();
            //专家已经完成的办事数量
            $complatecount = $countobj3->where(['res.state' => 3,'res.expertid' => $expertid,'status.configid' => 7])->count();
            $datas = DB::table('t_e_eventresponse as res')
                ->leftJoin('t_e_event as event','event.eventid','=','res.eventid')
                ->leftJoin('t_u_enterprise as ent','event.userid','=','ent.userid')
                ->leftJoin('view_eventstatus as status','status.eventid','=','res.eventid')
                ->select('res.*','event.domain1','event.domain2','event.brief','status.configid','event.eventtime','ent.enterprisename as name','res.state')
                ->whereRaw('res.id in (select max(`t_e_eventresponse`.`id`) from `t_e_eventresponse` group by `t_e_eventresponse`.`expertid`,eventid)');
            $obj = clone $datas;
            $ajaxobj = clone $datas;
            $eventobj = clone $datas;
            //克隆ajax请求的对象
            $ajaxobj = $ajaxobj->where(['res.expertid' => $expertid]);
            //datas为办事推送列表
            $datas = $datas
                ->where(['res.expertid' => $expertid])
                ->whereIn('status.configid',[4,5])
                ->whereIn('res.state',[0,1])
                ->orderBy('res.id','desc')
                ->paginate(1);

            $waitcount = $eventobj
                ->where(['res.expertid' => $expertid])
                ->whereIn('status.configid',[4,5])
                ->whereIn('res.state',[0,1])
                ->count();
            //datas2为我的办事列表
            $datas2 = $obj
                ->where(['res.expertid' => $expertid])
                ->whereIn('status.configid',[5,6,7,8])
                ->orderBy('res.id','desc')
                ->paginate(1);
            //调用eventclass中的方法进行对象的处理
            $datas = \EventClass::handelObj($datas);
            $datas2 = \EventClass::handelObj($datas2);
            //ajax请求判定返回指定的对象
            if($request->ajax()){
                $action = $request->input()['action'];
                if(!$action){
                    //action为0时世界返回的是办事推送列表
                    return $datas;
                } elseif($action == 1){
                    //action为1的时候返回的是我的办事列表
                    return $datas2;
                } else {
                    //其余的action在ajax请求的时候是configid 通过where条件来进行查询
                    $ajaxobj = $ajaxobj->where(['status.configid' => $action])->paginate(2);
                    $ajaxobj = \EventClass::handelObj($ajaxobj);
                    return $ajaxobj;
                }
            }
            $token = Crypt::encrypt(session('userId'));
            return view("myexpert.newMyWork",compact('datas','datas2','responsecount','putcount','complatecount','token','waitcount'));
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
            ->where(['event.eventid' => $eventid,'expertid' => $expertid])
            ->select('event.*','ent.enterprisename','res.expertid','status.configid')
            ->first();
        if(!$datas){
            return redirect('/');
        } elseif ($datas->configid == 6 || $datas->configid == 8 || $datas->configid == 7){
            return redirect('mywork/workDetail/'.$eventid);
        }
        $token = Crypt::encrypt(session('userId'));
        return view("myexpert.workDetail",compact('datas','token'));
    }

    /**专家响应办事
     * @param Request $request
     * @return array
     */
    public function responseEvent (Request $request) {
        //判断是否为ajax请求
        if($request->ajax()){
            $data = $request->input();
            //对token进行验证
            if(session('userId') == Crypt::decrypt($data['token'])){
                //获取到该用户对应的专家的id
                $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
                DB::beginTransaction();
                try{
                    //查询是否存在响应的情况
                    $verify = DB::table('t_e_eventresponse')->where(['expertid' => $expertid,'eventid' => $data['eventid'],'state' => 2])->first();
                    if(!$verify){
                        DB::table('t_e_eventresponse')->insert([
                            'expertid' => $expertid,
                            'eventid' => $data['eventid'],
                            'state' => 2,
                            'responsetime' => date('Y-m-d H-:i:s',time()),
                            'updated_at' => date('Y-m-d H-:i:s',time())
                        ]);
                    }else {
                        return ['msg' => '您已经响应过此办事','icon' => 2];
                    }
                    //查询这个办事是否已经响应过了
                    $verify2 = DB::table('t_e_eventverify')->where(['eventid' => $data['eventid'],'configid' => 5])->first();
                    if(!$verify2){
                        DB::table('t_e_eventverify')->insert([
                            'eventid' => $data['eventid'],
                            'configid' => 5,
                            'verifytime' =>  date('Y-m-d H-:i:s',time()),
                            'updated_at' => date('Y-m-d H-:i:s',time())
                        ]);
                    }
                    DB::commit();
                    return ['msg' => '响应成功,请等待企业回应','icon' => 1];
                }catch(Exception $e)
                {
                    DB::rollBack();
                    return ['msg' => '处理失败','icon' => 2];
                }
            }
        }
        return ['msg' => '非法操作','icon' => 2];
    }

    /**我的咨询
     * @return mixed
     */
    public function myask(Request $request){
        //获取到登陆用户的专家的id
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(empty($expert)){
            $expertid = 0;
        } else {
            $expertid = $expert->expertid;
        }
        $countobj = DB::table('t_c_consultresponse as res')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid');
        $countobj2 = clone $countobj;
        $countobj3 = clone $countobj;
        //专家已响应的咨询数量
        $responsecount = $countobj->where(['res.state' => 2,'res.expertid' => $expertid,'status.configid' => 5])->count();
        //专家受邀请（被推送）的咨询数量
        $putcount = $countobj2->where(['res.expertid' => $expertid,'status.configid' => 4])->count();
        //专家已经完成的咨询数量
        $complatecount = $countobj3->where(['res.state' => 3,'res.expertid' => $expertid,'status.configid' => 7])->count();

        $datas = DB::table('t_c_consultresponse as res')
            ->leftJoin('t_c_consult as consult','consult.consultid','=','res.consultid')
            ->leftJoin('t_u_enterprise as ent','consult.userid','=','ent.userid')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid')
            ->whereRaw('res.id in (select max(id) from t_c_consultresponse group by consultid)')
            ->select('res.*','consult.domain1','consult.domain2','consult.brief','status.configid','consult.consulttime','consult.starttime','consult.endtime','ent.enterprisename as name');
        $obj = clone $datas;
        $ajaxobj = clone $datas;
        $ajaxobj = $ajaxobj->where(['res.expertid' => $expertid]);

        $countobj4 = clone $datas;
        $count= $countobj4
           ->where(['res.expertid' => $expertid,'status.configid' => 4])
           ->orderBy('res.id','desc')
           ->count();

        $datas = $datas
            ->where(['res.expertid' => $expertid,'status.configid' => 4])
            ->orderBy('res.id','desc')
            ->paginate(2);


        $datas2 = $obj
            ->where(['res.expertid' => $expertid])
            ->whereIn('status.configid',[5,6,7])
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
        $token = Crypt::encrypt(session('userId'));

        return view("myexpert.newMyAsk",compact('datas','datas2','responsecount','putcount','complatecount','token','count'));
    }

    /**我的咨询的详情
     * @return mixed
     */
    public function askDetail($consultId){

        $consultStatus=DB::table("view_consultstatus")->where("consultid",$consultId)->pluck("configid");
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $datas = DB::table('t_c_consult as consult')
            ->leftJoin('t_c_consultresponse as res','consult.consultid','=','res.consultid')
            ->leftJoin('t_u_enterprise as ent','consult.userid','=','ent.userid')
            ->leftJoin('view_consultstatus as status','status.consultid','=','res.consultid')
            ->where(['consult.consultid'=>$consultId,'res.expertid'=>$expertid])
            ->first();
        switch ($consultStatus){
            case 5:
                $token = Crypt::encrypt($consultId.session('userId'));
                return view("myexpert.askDetail05",compact('datas','token'));
                break;
            case 6:
                $selExperts=DB::table("t_c_consult")
                    ->leftJoin("t_c_consultresponse","t_c_consultresponse.consultid","=","t_c_consult.consultid")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
                $comperes=DB::table("t_u_bill")
                    ->leftJoin("t_u_user","t_u_user.userid","=","t_u_bill.userid")
                    ->where("t_u_bill.consultid",$consultId)
                    ->where("t_u_bill.type","支出")
                    ->get();
                return view("myexpert.askDetail06",compact('selExperts','comperes','datas',"consultId"));
                break;

        }

    }

    /**专家响应咨询
     * @param Request $request
     * @return array
     */
    public function responseConsult (Request $request) {
        if($request->ajax()){
            $data = $request->input();
            //对token进行验证
            if(session('userId') == Crypt::decrypt($data['token'])){
                //获取到该用户对应的专家的id
                $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;

                $consultid = DB::table('t_c_consultresponse')->where(['expertid' => $expertid,'state' => 2])->orderBy('responsetime', 'desc')->first()->consultid;
                $endtime=DB::table('t_c_consult')->where('consultid',$consultid)->first()->endtime;
                $starttime=DB::table('t_c_consult')->where('consultid',$consultid)->first()->starttime;
                if($endtime>$starttime){
                    DB::beginTransaction();
                    try{
                        //查询是否存在响应的情况
                        $verify = DB::table('t_c_consultresponse')->where(['expertid' => $expertid,'consultid' => $data['consultid'],'state' => 2])->first();
                        if(!$verify){
                            DB::table('t_c_consultresponse')->insert([
                                'expertid' => $expertid,
                                'consultid' => $data['consultid'],
                                'state' => 2,
                                'responsetime' => date('Y-m-d H-:i:s',time()),
                                'updated_at' => date('Y-m-d H-:i:s',time())
                            ]);
                        }else {
                            return ['msg' => '您已经响应过此咨询事件','icon' => 2];
                        }
                        //查询咨询是否已响应
                        $verify2 = DB::table('t_c_consultverify')->where(['consultid' => $data['consultid'],'configid' => 5])->first();
                        if(!$verify2){
                            DB::table('t_c_consultverify')->insert([
                                'consultid' => $data['consultid'],
                                'configid' => 5,
                                'verifytime' =>  date('Y-m-d H-:i:s',time()),
                                'updated_at' => date('Y-m-d H-:i:s',time())
                            ]);
                        }
                        DB::commit();
                        return ['msg' => '响应成功,等待回应','icon' => 1];
                    }catch(Exception $e)
                    {
                        DB::rollBack();
                        return ['msg' => '处理失败','icon' => 2];
                    }
                }
                return ['msg' => '正在响应','icon' => 2];
            }
        }
        return ['msg' => '非法操作','icon' => 2];
    }
    /**进入视频会议
     * @return mixed
     */
    public function myaskinvt(){
        return view("myexpert.myaskinvt");
    }

   /**收费标准
     * @return mixed
     */
    public function standard(Request $request){

        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
        $fee=DB::table('t_u_expertfee')->where('expertid',$expertid)->orderBy('expertid', 'desc')->first()->fee;

        if($request->ajax()){
            $data = $request->input();
            //dd($expertid);

            $result = DB::table('t_u_expertfee')
                ->where('expertid',$expertid)
                ->update(['fee' => $data['fee']]);

            //dd($result);

            if(!$result){
                return ['msg' => '添加失败','icon' => 2];
            }else{
                return ['msg' => '添加成功','icon' => 1];

            }
        }
        return view("myexpert.standard",compact('fee'));
    }


}
