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
        $domain2 = DB::table('t_i_investment')->where('type',1)->get();
        $preference = DB::table('t_i_investment')->where('type',2)->get();
        return view('expertUcenter.expertinfo',compact('data','cate','domain2','preference'));
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
                    if(trim($data['upload']) != 1){
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
                                "domain2" => $data['domain2'],
                                "preference" => $data['preference'],
                                'organiza' => $data['organiza'],
                                'job' => $data['job'],
                                'worklife' => $data['worklife'],
                                'edubg' => $data['edubg'],
                                'workexperience' => $data['workexperience'],
                            ]);
                    }else{
                        if(trim($data['upload']) == 1 ){
                            $arr = [
                                "expertname" => $data['expertname'],
                                "address" => $data['address'],
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                "domain2" => $data['domain2'],
                                "preference" => $data['preference'],
                                'organiza' => $data['organiza'],
                                'job' => $data['job'],
                                'worklife' => $data['worklife'],
                                'edubg' => $data['edubg'],
                                'workexperience' => $data['workexperience'],
                            ];
                        } else {
                            $arr = [
                                "expertname" => $data['expertname'],
                                "address" => $data['address'],
                                "showimage" => '/images/'.$filename,
                                "brief" => $data['brief'],
                                "domain1" => $domain1,
                                "domain2" => $data['domain2'],
                                "preference" => $data['preference'],
                                'organiza' => $data['organiza'],
                                'job' => $data['job'],
                                'worklife' => $data['worklife'],
                                'edubg' => $data['edubg'],
                                'workexperience' => $data['workexperience'],
                            ];
                        }
                        $expertdata = DB::table("T_U_EXPERT")
                            ->where('expertid',$expertid->expertid)
                            ->update($arr);
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
            ->where('show.level',1)
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
        return view('expertUcenter.myshowindex',compact('data','expertinfo'));
    }

    /**我的项目评议列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myShowList()
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();

        $datas = DB::table('t_s_show as show')
            ->leftJoin('t_u_enterprise as ent','ent.userid', '=','show.userid')
            ->leftJoin('view_showstatus as status','status.showid' ,'=' ,'show.showid')
            ->leftJoin('t_s_pushshow as push','push.showid' ,'=' ,'show.showid')
            ->select('show.*','push.state','ent.enterprisename')
            ->where('push.expertid',$expert->expertid)
            ->whereRaw('push.id in (select max(id) from t_s_pushshow group by showid,expertid)')
            ->orderBy('show.showid','desc')
            ->paginate(3);
        return view('expertUcenter.showlist',compact('datas','expertinfo'));
    }

    /**
     * 项目详情
     */
    public function showDetail($showid)
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        $data = DB::table('t_s_show as show')
            ->leftJoin('t_s_pushshow as push','push.showid' ,'=' ,'show.showid')
            ->whereRaw('push.id in (select max(id) from t_s_pushshow group by showid,expertid)')
            ->where('show.showid',$showid)
            ->where('push.expertid',$expert->expertid)
            ->first();
        $message = DB::table('t_s_messagetoshow')->where(['showid' => $showid,'userid' => session('userId')])->first();
        return view('expertUcenter.showedit',compact('data','message'));
    }

    /**发布项目评议
     * @param Request $request
     * @return array
     */
    public function dealPostShow(Request $request)
    {
        $data = $request->input();
        $mess = DB::table('t_s_messagetoshow')->where(['showid' => $data['showid'],'userid' => session('userId')])->first();
        if(!empty($mess)){
            DB::table('t_s_messagetoshow')
                ->where(['showid' => $data['showid'],'userid' => session('userId')])
                ->update([
                    'content' => $data['content1'],
                    'content2' => $data['content2'],
                    'isyes' => $data['isyes']
                ]);
            return [ 'msg' => '修改评议成功','icon' => 1];
        } else {
            $verify = DB::table('t_u_expert as expert')
                ->leftJoin('t_s_pushshow as push','push.expertid','=','expert.expertid')
                ->where('expert.userid',session('userId'))
                ->where('push.showid',$data['showid'])
                ->first();
            if(!empty($verify)){
                DB::table('t_s_messagetoshow')
                    ->insert([
                        'showid' => $data['showid'],
                        'userid' => session('userId'),
                        'content' => $data['content1'],
                        'content2' => $data['content2'],
                        'isyes' => $data['isyes'],
                        'messagetime' => date('Y-m-d H:i:s')
                    ]);
                DB::table('t_s_pushshow')->insert([
                    'expertid' => $verify->expertid,
                    'showid' => $data['showid'],
                    'state' => 2,
                    'pushtime' => date('Y-m-d H:i:s')
                ]);
                return [ 'msg' => '发表评议成功','icon' => 1];
            } else {
                return ['msg' => '不是该项目评议的专家','icon' => 2];
            }
        }

    }

    /**我的约见列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myMeetList()
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();

        $datas = DB::table('t_m_meet as meet')
            ->leftJoin('t_u_enterprise as ent','ent.userid', '=','meet.userid')
            ->leftJoin('t_m_meetverify as verify','verify.meetid', '=','meet.meetid')
            ->where('meet.expertid',$expert->expertid)
            ->where('verify.configid','<>',1)
            ->whereRaw('verify.id in (select max(id) from t_m_meetverify group by meetid)')
            ->select('meet.*','verify.configid','ent.enterprisename')
            ->orderBy('meet.meetid','desc')
            ->paginate(3);
        return view('expertUcenter.meetlist',compact('datas','expertinfo'));
    }

    /**我的约见详情页
     * @param $meetid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myMeetDetail($meetid)
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();

        $data = DB::table('t_m_meet as meet')
            ->leftJoin('t_u_enterprise as ent','ent.userid', '=','meet.userid')
            ->leftJoin('t_m_meetverify as verify','verify.meetid', '=','meet.meetid')
            ->where('meet.expertid',$expert->expertid)
            ->where('meet.meetid',$meetid)
            ->where('verify.configid','<>',1)
            ->whereRaw('verify.id in (select max(id) from t_m_meetverify group by meetid)')
            ->select('meet.*','verify.configid','ent.enterprisename')
            ->first();
        return view('expertUcenter.meetdetail',compact('data'));
    }

    /**处理约见
     * @param Request $request
     * @return array
     */
    public function dealMeet(Request $request)
    {
        $data = $request->input();
        $meetinfo = DB::table('t_m_meet as meet')
            ->leftJoin('t_u_expert as expert','meet.expertid', '=','expert.expertid')
            ->where(['meetid' => $data['meetid']])
            ->where('expert.userid',session('userId'))
            ->first();
        if(!empty($meetinfo)){
            if($data['meetdeal']){
                DB::table('t_m_meetverify')->insert([
                    'meetid' => $data['meetid'],
                    'configid' => 3,
                    'verifytime' => date('Y-m-d H:i:s')
                ]);
                \UserClass::createMeetGroups($meetinfo->expertid,$data['meetid']);
            } else {
                DB::table('t_m_meetverify')->insert([
                    'meetid' => $data['meetid'],
                    'configid' => 4,
                    'verifytime' => date('Y-m-d H:i:s'),
                    'remark' => $data['remark']
                ]);
            }
            return ['msg' => '处理成功','icon' => 1];

        }
        return ['msg' => '不是约见的专家','icon' => 2];


    }

    public function intoMeeting($meetid)
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(empty(session('userId')) || empty($expert->expertid)){
            return redirect('login');
        }

        $datas=DB::table("t_m_meet as meet")
            ->leftJoin("t_m_meetverify","t_m_meetverify.meetid","=","meet.meetid")
            ->leftJoin('t_u_enterprise as ent','meet.userid','=','ent.userid')
            ->where(['meet.meetid'=>$meetid,'meet.expertid'=>$expert->expertid])
            ->select('meet.*','ent.*','t_m_meetverify.*')
            ->first();

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
        return view("expertUcenter.meeting",compact('selExperts','expert','comperes','datas',"meetid"));
    }

    /**我的私董会列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mySectorList()
    {
        $expert = DB::table('t_u_expert')->where('userid',session('userId'))->first();

        $datas = DB::table('t_c_consult as consult')
            ->leftJoin('t_u_enterprise as ent','ent.userid', '=','consult.userid')
            ->leftJoin('view_consultstatus as status','status.consultid' ,'=' ,'consult.consultid')
            ->leftJoin('t_c_consultresponse as res','res.consultid' ,'=' ,'consult.consultid')
            ->select('consult.*','res.state','ent.enterprisename')
            ->where('res.expertid',$expert->expertid)
            ->whereRaw('res.id in (select max(id) from t_c_consultresponse group by consultid,expertid)')
            ->orderBy('consult.consultid','desc')
            ->paginate(3);
        return view('expertUcenter.sectorlist',compact('datas','expertinfo'));
    }

    /**专家响应咨询
     * @param Request $request
     * @return array
     */
    public function responseConsult (Request $request) {
        if($request->ajax()){
            $data = $request->input();

            //对token进行验证
            $startTime=DB::table('t_c_consult')->where('consultid',$data['consultid'])->pluck('starttime');
            $endTime=DB::table('t_c_consult')->where('consultid',$data['consultid'])->pluck('endtime');
            //获取到该用户对应的专家的id
            $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first()->expertid;
            $workIngConsults=DB::table('view_expertresponsetime')
                ->where("view_expertresponsetime.expertid",$expertid)
                ->whereRaw('(starttime between  "'.$startTime.'" and "'.$endTime.'" or endtime between "'.$startTime .'" and "'.$endTime .'" or starttime < "'.$startTime.'" and endtime > "'.$endTime.'") and state in (2,3)')
                ->count();
            if(!$data['consultdeal']){
                DB::table('t_c_consultresponse')->insert([
                    'consultid' => $data['consultid'],
                    'expertid' => $expertid,
                    'responsetime' => date('Y-m-d H:i:s'),
                    'state' => 5,
                    'remark' => $data['remark']
                ]);
                return ['msg' => '处理成功,您的会议已失效','icon' => 1];
            } else {
                if(!$workIngConsults){
                    DB::beginTransaction();
                    try{
                        //查询是否存在响应的情况
                        $verify = DB::table('t_c_consultresponse')->where(['expertid' => $expertid,'consultid' => $data['consultid'],'state' => 2])->first();
                        if(!$verify){
                            $res=DB::table('t_c_consultresponse')->insert([
                                'expertid' => $expertid,
                                'consultid' => $data['consultid'],
                                'state' => 2,
                                'responsetime' => date('Y-m-d H-:i:s',time()),
                                'updated_at' => date('Y-m-d H-:i:s',time())
                            ]);
                            if($res){
                                $name=DB::table("t_u_expert")->where("expertid",$expertid)->pluck('expertname');
                                $phone=DB::table('t_c_consult')
                                    ->leftJoin('t_u_user','t_c_consult.userid','=','t_u_user.userid')
                                    ->where('consultid',$data['consultid'])
                                    ->pluck('phone');
                                $time=DB::table('t_c_consult')->where('consultid',$data['consultid'])->pluck('created_at');
                               /* $this->_sendSms($phone,'私董会','answer',$name,$time);*/
                            }
                        }else {
                            return ['msg' => '您已经同意过此会议事件','icon' => 2];
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
                        return ['msg' => '处理成功,请您等待企业确定后进入会议','icon' => 1];
                    }catch(Exception $e)
                    {
                        DB::rollBack();
                        return ['msg' => '处理失败','icon' => 2];
                    }
                }
            }

            return ['msg' => '你在这个时间段已经有其他的会议了,请合理安排时间','icon' => 2];

        }
        return ['msg' => '非法操作FF000001','icon' => 2];
    }

    public function intoSector($consultId)
    {
        $consultStatus=DB::table("view_consultstatus")->where("consultid",$consultId)->pluck("configid");
        $expertid = DB::table('t_u_expert')->where('userid',session('userId'))->first();
        if(empty(session('userId')) || empty($expertid->expertid)){
            return redirect('login');
        }
        DB::table("t_c_consult")->where('consultid',$consultId)->update(['extislook' => 1]);

        $datas=DB::table("t_c_consult")
            ->leftJoin('t_c_consultresponse as res','t_c_consult.consultid','=','res.consultid')
            ->leftJoin("t_c_consultverify","t_c_consultverify.consultid","=","t_c_consult.consultid")
            ->leftJoin('t_u_enterprise as ent','t_c_consult.userid','=','ent.userid')
            ->where(['t_c_consult.consultid'=>$consultId,'res.expertid'=>$expertid->expertid])
            ->whereRaw('t_c_consultverify.id in (select max(id) from t_c_consultverify group by consultid)')
            ->whereRaw('res.id in (select max(id) from t_c_consultresponse group by consultid,expertid)')
            ->select('t_c_consult.*','res.*','ent.*','t_c_consultverify.*','t_c_consult.brief')
            ->first();


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
        return view("expertUcenter.sectorDetail",compact('selExperts','comperes','datas',"consultId"));

    }

    public function myCharge()
    {
        $userId=session("userId");
        $incomes=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"收入"])->sum("money");
        $pays=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"支出"])->sum("money");
        $expends=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"在途"])->sum("money");
        $balance=$incomes-$pays-$expends;

        //$bankcard=DB::table("t_u_bank")->where(["userid"=>$userId,"state"=>0])->pluck("bankcard");

        $bankcard=DB::table("t_u_bank")->where(["userid"=>$userId])->pluck("bankcard");
        $state=DB::table("t_u_bank")->where("userid",$userId)->pluck("state");
        return view("expertUcenter.mycharge",compact("incomes","pays","expends","balance","bankcard","state"));
    }

    /**个人中心首页充值，消费记录
     * @return array
     */
    public  function getRecord(){
        $type=$_POST['type'];
        $startPage=isset($_POST['startPage'])?$_POST['startPage']:1;
        $offset=($startPage-1)*10;
        $userId=session("userId");
        $result=array();
        $counts=DB::table("T_U_BILL")->where("userid",$userId)->where("payflag",1)->count();
        $datas=DB::table("T_U_BILL")->select("brief","payno","money","created_at","type")->where("userid",$userId)->where("payflag",1)->orderBy('id','desc')->skip($offset)->take(10)->get();

        $counts=!empty(ceil($counts/10))?ceil($counts/10):0;
        foreach ($datas as $data){
            $data->created_at=date("Y-m-d",strtotime($data->created_at));
            if($data->type=="收入"){
                $data->money="+".$data->money;
            }else{
                $data->money="-".$data->money;
            }
        }
        if($datas){
            $result['code']="success";
            $result['counts']=$counts;
            $result['startPage']=$startPage;
            $result['msg']=$datas;
        }else{
            $result['code']="error";
        }
        return $result;

    }

    /**设置专家资费页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chargeStandard()
    {
        $userid = session('userId');
        $expertinfo = DB::table('t_u_expert as expert')
                ->leftJoin('t_u_expertfee as fee','fee.expertid','=','expert.expertid')
                ->where('expert.userid',$userid)
                ->first();
        return view("expertUcenter.chargeStandard",compact("expertinfo"));

    }

    /**
     * post设置专家资费
     */
    public function PostchargeStandard(Request $request)
    {
        $data = $request;
        $userid = session('userId');
        if(!empty($userid)){
            $expert = DB::table('t_u_expert')->where('userid',$userid)->pluck('expertid');
            if(empty($expert)){
                return ['icon' =>2 ,'msg' => '您还未认证，请去认证','url' => url('/expindex/index')];
            }
            DB::table('t_u_expert')->where('userid',$userid)->update([
                'iscomment' => $data['iscomment'],
                'islinemeet' => $data['islinemeet'],
                'isonlinemeet' => $data['isonlinemeet']
            ]);
            if($data['fee']){
                $arr = ['fee' => $data['fee'],'state' => 1,'linefee' => $data['linefee']];
            } else {
                $arr = ['fee' => $data['fee'],'state' => 0,'linefee' => $data['linefee']];
            }

            DB::table('t_u_expertfee')->where('expertid',$expert)->update($arr);
            return ['icon' => 1,'msg' => '修改成功'];

        }
        return ['icon' => 2,'msg' => '请登录','url' => url('login').'?returnurl='.url('/expmycharge/chargeStandard')];
    }

    /**更改银行卡号
     * @return array
     */
    public  function updateCard(){
        $res=array();
        $result=DB::table("t_u_bank")->where("userid",$_POST['userId'])->update([
            "state"=>1,
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($result){
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return $res;
    }

    /**判断用户是否绑定银行卡
     * @return array
     */
    public  function expertHaveCard(){
        $res=array();
        $userId=session('userId');
        $counts=DB::table('t_u_bank')->where('userid',$userId)->count();
        if($counts){
            $states=DB::table('t_u_bank')->where('userid',$userId)->pluck('state');
            if($states==1 ){
                $res['code']='0';
            }elseif($states==0){
                $res['code']='1';
            }else{
                $res['code']='2';
            }
        }else{
            $res['code']='0';
        }
        return $res;
    }

    /**提现
     * @return mixed
     */
    public function cash(){
        $userId=session("userId");
        $incomes=DB::table("T_U_BILL")->where(["userid"=>$userId,"type"=>"收入"])->sum("money");
        $pays=DB::table("T_U_BILL")->where("userid",$userId)->whereIn("type",["支出","在途"])->sum("money");
        $balance=$incomes-$pays;
        return view("expertUcenter.cash",compact("balance"));
    }

    /**申请提现
     * @return array
     */
    public function applicationCashs(){
        $res=array();
        $money=$_POST['money'];
        $userId=$_POST['userId'];
        $payno=$this->getPayNum("提现");
        $result=DB::table("t_u_bill")->insert([
            "userid"=>$userId,
            "type"=>"在途",
            "channel"=>"提现申请",
            "money"=>$money,
            "payno"=>$payno,
            "billtime"=>date("Y-m-d H:i:s",time()),
            "brief"=>"提现",
            "created_at"=>date("Y-m-d H:i:s",time()),
            "updated_at"=>date("Y-m-d H:i:s",time()),
        ]);
        if($result){
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return $res;
    }

    public  function haveCard(){
        $res=array();
        $userId=session('userId');
        $counts=DB::table('t_u_bank')->where('userid',$userId)->count();
        if($counts){
            $states=DB::table('t_u_bank')->where('userid',$userId)->pluck('state');
            if($states==1 ){
                $res['code']='0';
            }elseif($states==0){
                $res['code']='1';
            }else{
                $res['code']='2';
            }
        }else{
            $res['code']='0';
        }

        return $res;
    }

    /**添加银行卡
     * @return mixed
     */
    public  function  card(){
        return view("expertUcenter.card");
    }

    /**银行卡处理
     * @return mixed
     */
    public  function  cardHandle(){
        $res=array();
        $userId=session("userId");
        $counts=DB::table("t_u_bank")->where("userid",$userId)->count();
        if($counts){
            $result=DB::table("t_u_bank")->where("userid",$userId)->update([
                "userid"=>$userId,
                "bankname"=>$_POST['bankName'],
                "account"=>$_POST['account'],
                "bankcard"=>$_POST['bankCard'],
                "bankfullname"=>$_POST['bankFullName'],
                "state"=>2,
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }else{
            $result=DB::table("t_u_bank")->insert([
                "userid"=>$userId,
                "bankname"=>$_POST['bankName'],
                "account"=>$_POST['account'],
                "bankcard"=>$_POST['bankCard'],
                "bankfullname"=>$_POST['bankFullName'],
                "state"=>2,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
        }
        if($result){
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return  $res;

    }

    /**银行卡处理
     * @return mixed
     */
    public  function  verifyCard(Request $request){
        $res=array();
        $data=$request->all();
        $money=DB::table("t_u_bank")->where("userId",$data['userId'])->pluck("money");
        if($money==$data['money']){
            DB::table('t_u_bank')->where('userId',$data['userId'])->update([
                "state"=>0,
                "updated_at"=>date("Y-m-d H:i:s",time()),
            ]);
            $res['code']="success";
        }else{
            $res['code']="error";
        }
        return $res;

    }


}
