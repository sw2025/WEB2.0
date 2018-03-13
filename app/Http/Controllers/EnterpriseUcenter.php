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
    public function myShowIndex()
    {
        $userid = session('userId');
        //获取项目评议所有数据
        $data = DB::table('t_s_show as show')
            ->leftJoin('view_showstatus as status','status.showid','=','show.showid')
            ->where('show.userid',$userid)
            ->select('show.*','status.configid')
            ->orderBy('show.showid','desc')
            ->where('show.level',1)
            ->paginate(3);
        $expertinfo = [];
        $configname = [1 => '已保存',2 => '已支付' ,3 => '未通过审核',4 => '已推送/已评议' ,5 => '已完成',6 => '已评价'];
        foreach($data as $k => $v){
            $expert = DB::table('t_s_pushshow')
                ->leftJoin('t_u_expert','t_u_expert.expertid','=','t_s_pushshow.expertid')
                ->where('t_s_pushshow.showid',$v->showid)
                ->whereRaw('t_s_pushshow.id in (select max(id) from t_s_pushshow group by showid,expertid)')
                ->select('t_u_expert.expertid','t_u_expert.showimage','t_u_expert.expertname','t_s_pushshow.state')
                ->get();
            $expertinfo[$k] = $expert;
            $v->configname = $configname[$v->configid];
        }
        return view('enterpriseUcenter.myshowindex',compact('data','expertinfo'));
    }

    //
    public function myShowDetail($showid)
    {
        $data = DB::table('t_s_show')->where('showid',$showid)->first();
        $mess = DB::table('t_s_messagetoshow as mess')
                ->leftJoin('t_u_expert as expert','expert.userid','=','mess.userid')
                ->where('showid',$showid)
                ->select('mess.*','expert.expertname','expert.expertid')
                ->get();
        return view('enterpriseUcenter.showdetail',compact('data','mess'));
    }

    public function myMeetIndex()
    {
        $userid = session('userId');
        //获取项目评议所有数据
        $data = DB::table('t_m_meet as meet')
            ->leftJoin('t_m_meetverify as verify','verify.meetid','=','meet.meetid')
            ->leftJoin('t_u_expert as expert','expert.expertid','=','meet.expertid')
            ->where('meet.userid',$userid)
            ->where('meet.type',1)
            ->whereRaw('verify.id in (select max(id) from t_m_meetverify group by meetid)')
            ->select('meet.*','verify.configid','expert.*')
            ->orderBy('meet.meetid','desc')
            ->paginate(4);
        $configname = [1 => '已保存',2 => '已支付' ,3 => '已响应',4 => '已拒绝' ,5 => '已完成'];
        $meettype = [1 => '线下约谈' ,0 => '线上约谈'];
        foreach($data as $v) {
            $expert = DB::table('t_u_expert')
                ->leftJoin('t_u_user', 't_u_user.userid', '=', 't_u_expert.userid')
                ->where('expertid', $v->expertid)
                ->select('t_u_expert.expertid', 't_u_expert.showimage', 't_u_expert.expertname', 'domain1', 't_u_user.phone', 't_u_user.userid')
                ->first();
            $expertinfo[$expert->expertid] = $expert;
            $v->configname = $configname[$v->configid];
            $v->meettypename = $meettype[$v->meettype];
        }
        return view('enterpriseUcenter.mymeetindex',compact('data','expertinfo'));
    }

    public function intoMeeting($meetid)
    {


        $datas=DB::table("t_m_meet as meet")
            ->leftJoin("t_m_meetverify","t_m_meetverify.meetid","=","meet.meetid")
            ->leftJoin('t_u_enterprise as ent','meet.userid','=','ent.userid')
            ->where(['meet.meetid'=>$meetid])
            ->select('meet.*','ent.*','t_m_meetverify.*')
            ->first();
        $expert = DB::table('t_u_expert')->where('expertid',$datas->expertid)->first();
        /* $selExperts=DB::table("t_c_consult")
             ->leftJoin("t_c_consultresponse","t_c_consultresponse.consultid","=","t_c_consult.consultid")
             ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
             ->where("t_c_consultresponse.state",3)
             ->where("t_c_consultresponse.consultid",$consultId)
             ->get();*/
        /* $comperes=DB::table("t_u_bill")
             ->leftJoin("t_u_user","t_u_user.userid","=","t_u_bill.userid")
             ->where("t_u_bill.consultid",$consultId)
             ->where("t_u_bill.type","支出")
             ->get();*/
        return view("enterpriseUcenter.meeting",compact('selExperts','expert','comperes','datas',"meetid"));
    }


    /*
     * 约见完成
     */
    public  function finishMeet(){
        $consutId=$_POST['meetId'];
        $type=$_POST['type'];
        $content = empty($_POST['msg']) ? '' : '异常终止:'.$_POST['msg'];
        if($type=='end'){
            $configId=7;
            $state=4;
        }else{
            $configId=9;
            $state=5;
        }
        $res=array();
        DB::beginTransaction();
        try{
            DB::table('t_c_consultverify')->insert([
                'consultid'=>$consutId,
                'configid'=>$configId,
                'verifytime'=>date('Y-m-d H:i:s',time()),
                'remark'=>$content,
                'created_at'=>date('Y-m-d H:i:s',time()),
                'updated_at'=>date('Y-m-d H:i:s',time()),
            ]);
            $expertIds=DB::table('t_c_consultresponse')
                ->where(['consultid'=>$consutId,'state'=>3])
                ->select('expertid')
                ->distinct()
                ->get();
            foreach($expertIds as $value){
                DB::table('t_c_consultresponse')->insert([
                    'consultid'=>$consutId,
                    'expertid'=>$value->expertid,
                    'responsetime'=>date('Y-m-d H:i:s'),
                    'state'=>$state,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                    'updated_at'=>date('Y-m-d H:i:s',time()),

                ]);
            }
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            throw $e;
        }
        if(!isset($e)){
            $res['code']='success';
        }else{
            $res['code']='error';
        }
        return $res;
    }

    public function myDavIndex()
    {
        $userid = session('userId');
        //获取项目评议所有数据
        $data = DB::table('t_m_meet as meet')
            ->leftJoin('t_m_meetverify as verify','verify.meetid','=','meet.meetid')
            ->leftJoin('t_u_expert as expert','expert.expertid','=','meet.expertid')
            ->where('meet.userid',$userid)
            ->where('meet.type',0)
            ->whereRaw('verify.id in (select max(id) from t_m_meetverify group by meetid)')
            ->select('meet.*','verify.configid','expert.*')
            ->orderBy('meet.meetid','desc')
            ->paginate(4);
        $configname = [1 => '已保存',2 => '已支付' ,3 => '已响应',4 => '已拒绝' ,5 => '已完成'];
        $meettype = [1 => '线下约谈' ,0 => '线上约谈'];
        foreach($data as $v) {
            $expert = DB::table('t_u_expert')
                ->leftJoin('t_u_user', 't_u_user.userid', '=', 't_u_expert.userid')
                ->where('expertid', $v->expertid)
                ->select('t_u_expert.expertid', 't_u_expert.showimage', 't_u_expert.expertname', 'domain1', 't_u_user.phone', 't_u_user.userid')
                ->first();
            $expertinfo[$expert->expertid] = $expert;
            $v->configname = $configname[$v->configid];
            $v->meettypename = $meettype[$v->meettype];
        }
        return view('enterpriseUcenter.mydavindex',compact('data','expertinfo'));
    }

    public function myLineShowIndex()
    {
        $userid = session('userId');

        $data = DB::table("t_s_lineshow")->where('userid',$userid)->paginate(4);

        return view('enterpriseUcenter.mylineshowindex',compact('data','expertinfo'));
    }

    public function mySectorIndex()
    {
        $userid = session('userId');
        $data = DB::table('t_c_consult as consult')
            ->leftJoin('view_consultstatus as status','status.consultid','=','consult.consultid')
            ->where('consult.userid',$userid)
            ->select('consult.*','status.configid')
            ->orderBy('consult.consultid','desc')
            ->paginate(3);
        $expertinfo = [];
        $configname = [1=>'',2=>'',3=>'',8=>'',4 => '待专家响应',5 => '专家已响应' ,6 => '正在咨询中',7 => '已完成',9 => '异常终止'];
        foreach($data as $k => $v){
            $expert = DB::table('t_c_consultresponse as res')
                ->leftJoin('t_u_expert as exp','exp.expertid','=','res.expertid')
                ->where('res.consultid',$v->consultid)
                ->whereRaw('res.id in (select max(id) from t_c_consultresponse group by consultid,expertid)')
                ->select('exp.expertid','exp.showimage','exp.domain1','exp.expertname','res.state')
                ->get();
            $expertinfo[$k] = $expert;
            $v->configname = $configname[$v->configid];
        }
        return view('enterpriseUcenter.mysectorindex',compact('data','expertinfo'));
    }

    public function supplySector()
    {
        return view('enterpriseUcenter.supplysector');
    }

    public function sectorDetail($consultId)
    {
        $userId=session("userId");
        $datas=DB::table("t_c_consult")
            ->leftJoin("t_c_consultverify","t_c_consultverify.consultid","=","t_c_consult.consultid")
            ->where("t_c_consult.consultid",$consultId)
            ->whereRaw('t_c_consultverify.id in (select max(id) from t_c_consultverify group by consultid)')
            ->get();
        $counts=DB::table("t_c_consultresponse")->where("consultid",$consultId)->where('state',1)->count();
        $counts2=DB::table("t_c_consultresponse")->where("consultid",$consultId)->where('state',0)->count();
        foreach ($datas as $data){
            $configId=$data->configid;
            if(!$counts){
                $counts = $counts2;
                $data->state="指定专家";
            }else{
                $data->state="系统分配";
            }
            $data->timelong = (strtotime($data->endtime)-strtotime($data->starttime))/60;
            $data->starttime=date("Y年m月d日 H:i:s",strtotime($data->starttime));
            $data->endtime=date("Y年m月d日 H:i:s",strtotime($data->endtime));
        }
        DB::table('t_c_consult')->where('consultid',$consultId)->update(['entislook' => 1]);
        switch($configId){
            case 4:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->whereIn("t_c_consultresponse.state",[0,1])
                    ->where("consultid",$consultId)
                    ->get();
                $selected=count($selExperts);
                break;
            case 5:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->leftJoin("t_u_expertfee","t_u_expertfee.expertid","=","t_u_expert.expertid")
                    ->select("t_u_expert.*","t_u_expertfee.fee","t_c_consultresponse.consultid","t_u_expertfee.state")
                    ->where("t_c_consultresponse.state",2)
                    ->where("consultid",$consultId)
                    ->get();
                $expertcost = 0;
                foreach($selExperts as $v){
                    $expertcost += $v->fee;
                }
                $selected=count($selExperts);
                break;
            case 6:
                $selExperts=DB::table("t_c_consult")
                    ->leftJoin("t_c_consultresponse","t_c_consultresponse.consultid","=","t_c_consult.consultid")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
                $ExpertMoneys=DB::table("t_u_bill")
                    ->where("t_u_bill.consultid",$consultId)
                    ->where("type","收入")
                    ->sum('money');
                if($ExpertMoneys){
                    $selectExpertMoney=$ExpertMoneys;
                }else{
                    $selectExpertMoney="免费";
                }
                $comperes=DB::table("t_u_user")->where("userid",session('userId'))->get();
                break;
            case 7:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_c_consultcomment","t_c_consultresponse.expertid","=","t_c_consultcomment.expertid" )
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
                break;
            case 8:
                $selExperts=DB::table("t_c_consultresponse")
                    ->leftJoin("t_c_consultcomment","t_c_consultresponse.expertid","=","t_c_consultcomment.expertid" )
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("t_c_consultresponse.consultid",$consultId)
                    ->get();
                $configId = 7;
                break;
            case 9:

                $selExperts=DB::table("t_u_enterprise")
                    ->where('userid',$datas[0]->userid)
                    ->first();
                $selExperts2=DB::table("t_c_consultresponse")
                    ->leftJoin("t_u_expert","t_c_consultresponse.expertid","=","t_u_expert.expertid")
                    ->where("t_c_consultresponse.state",3)
                    ->where("consultid",$consultId)
                    ->get();
                break;
        }
        $selExperts=!empty($selExperts)?$selExperts:"";
        $selected=!empty($selected)?$selected:"";
        $comperes=!empty($comperes)?$comperes:"";
        $view="video".$configId;
        return view("enterpriseUcenter.".$view,compact("datas","counts","selected","selExperts","consultId","userId","selectExpertMoney",'expertcost','selExperts2',"comperes"));

    }
}
