<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShowController extends Controller
{
    /**
     * 项目提交页面
     */
    public function Index($showid=0)
    {
        if(!empty($showid)){
            $showinfo = DB::table('t_s_show')->where('showid',$showid)->first();
            $basedata = unserialize($showinfo->basicdata);
            $expertids = explode(',',$showinfo->expertids);
            $showimages = DB::table('t_u_expert')->whereIn('expertid',$expertids)->select('showimage','expertname')->get();
        }
        if(!empty(session('userId'))){
            $entinfo = DB::table('t_u_enterprise')->where('userid',session('userId'))->select('enterprisename','job','industry')->first();
        }
        $cate = DB::table('t_common_domaintype')->where('level',1)->get();
        return view('show.index',compact('showid','cate','showinfo','basedata','showimages','entinfo'));
    }

    /**提交项目
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function submitShow(Request $request)
    {
        $data = $request->input();
        $file = $request->file('file');
        $userid = empty(session('userId')) ? '':session('userId');
        $showid = $data['showid'];
        if($data['upload'] != 1){
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('YmdHis'). uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            } else {
                return ['msg' => '上传失败~','icon' => 2,'code' => 3];
            }
        }
        //保存文件


        DB::beginTransaction();
        try{
            //判断用户是否登录 改变/插入企业表数据
            if($userid){
                $enterprise = DB::table('t_u_enterprise')->where('userid',$userid)->first();
                if(!empty($enterprise)){
                    DB::table('t_u_enterprise')->where('userid',$userid)->update([
                        'enterprisename' => $data['entername'],
                        'job' => $data['enterjob'],
                        'industry' => $data['industry']
                    ]);
                } else {
                    DB::table('t_u_enterprise')->where('userid',$userid)->insert([
                        'enterprisename' => $data['entername'],
                        'job' => $data['enterjob'],
                        'industry' => $data['industry']
                    ]);
                }
            }
            //插入项目表数据
            //判断系统匹配或者自选专家
            if($data['selecttype'] == '系统匹配'){
                $expertnumbers = intval($data['selectnumbers']);
                $expertids = DB::table('t_u_expert')
                    ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                    ->where('state.configid', 2)
                    ->where(['domain1' => $data['domain']])
                    ->whereRaw('1=1  group by rand()')
                    ->limit($expertnumbers)
                    ->lists('t_u_expert.expertid');

                if(empty($expertids)){
                    $expertids = [0];
                }

                $expertids = join(',',$expertids);
                $data['selectnumbers'] = intval($data['selectnumbers']);
            } else {
                $expertids = $data['selectnumbers'];
                $data['selectnumbers'] = count(explode(',',$data['selectnumbers']));
            }

            $basedata = [
                    'role' => $data['role'],
                    'stage' => $data['stage'],
                    'paytype' => $data['paytype'],
                    'enterprisename' => $data['entername'],
                    'job' => $data['enterjob'],
                    'industry' => $data['industry'],
                    'selecttype' => $data['selecttype'],
                    'selectnumbers' => $data['selectnumbers'],
            ];
            if($showid){
                if($data['upload'] != 1){
                    $arr = [
                        'userid' => $userid,
                        'oneword' => $data['oneword'],
                        'title' => $data['projectname'],
                        'domain1' => $data['domain'],
                        'brief' => $data['projecttxt'],
                        'expertids' => $expertids,
                        'showtime' => date('Y-m-d H:i:s',time()),
                        'bpurl' => $filename,
                        'bpname' => $originalName,
                        'basicdata' => serialize($basedata)
                    ];
                } else {
                    $arr = [
                        'userid' => $userid,
                        'oneword' => $data['oneword'],
                        'title' => $data['projectname'],
                        'domain1' => $data['domain'],
                        'brief' => $data['projecttxt'],
                        'expertids' => $expertids,
                        'showtime' => date('Y-m-d H:i:s',time()),
                        'basicdata' => serialize($basedata)
                    ];
                }

               DB::table('t_s_show')->where('showid',$showid)->update($arr);
            } else {
                $showid = DB::table('t_s_show')->insertGetId([
                    'userid' => $userid,
                    'oneword' => $data['oneword'],
                    'title' => $data['projectname'],
                    'domain1' => $data['domain'],
                    'brief' => $data['projecttxt'],
                    'expertids' => $expertids,
                    'showtime' => date('Y-m-d H:i:s',time()),
                    'bpurl' => $filename,
                    'bpname' => $originalName,
                    'basicdata' => serialize($basedata)
                ]);
                DB::table('t_s_showverify')->insert([
                    'showid' => $showid,
                    'configid' => 1,
                    'verifytime' => $data['projecttxt'],
                ]);
            }



            DB::commit();
            $msg = ['msg' => '提交成功','icon' => 1,'code' => 4,'url' => url('keepshow',$showid)];

        }catch(Exception $e){
            DB::rollback();
            $msg = ['msg' => '提交失败','icon' => 2,'code' => 6];
            throw $e;
        }
        return $msg;
    }

    /**保存项目评议待支付页面
     * @param $showid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function keepShow($showid)
    {
        $configid = self::getNewShowVerify($showid);
        $showinfo = DB::table('t_s_show')->where('showid',$showid)->first();
        $basedata = unserialize($showinfo->basicdata);
        $expertids = explode(',',$showinfo->expertids);
        $showimages = DB::table('t_u_expert')->whereIn('expertid',$expertids)->select('showimage','expertname')->get();
        return view('show.keepshow',compact('showinfo','basedata','showimages','configid'));
    }


    static private function getNewShowVerify($showid){
        $configid = DB::table('view_showstatus')->where('showid',$showid)->pluck('configid');
        return $configid;
    }


    /**
     * 选择专家页面
     */
    public function selectExpert(Request $request)
    {
        $userid = empty(session('userId'))?0:session('userId');
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user','ext.userid' ,'=' ,'user.userid')
            ->leftJoin('t_u_expertfee as fee','fee.expertid' ,'=' ,'ext.expertid')
            ->leftJoin('view_expertstatus as status','ext.expertid' ,'=' ,'status.expertid')
            ->where('status.configid',2)
            ->where("ext.userid","<>",$userid)
            ->where("ext.iscomment",1)
            ->select('ext.*','fee.linefee','fee.fee');
        $type = '';
        //获得用户的收藏
        //判断是否为http请求
        if(!empty($get = $request->input())){
            //获取到get中的数据并处理
            $searchname=(isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $supply=(isset($get['supply']) && $get['supply'] != "null") ? $get['supply'] : null;
            $address=(isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $ordertime=( isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : 'desc';
            $type = ( isset($get['type']) && $get['type'] != "null") ? $get['type'] : '';
            $addresswhere = !empty($address)?array("ext.address"=>$address):array();

            if(!empty($supply)){
                $obj = $datas->where('ext.domain1',$supply)->where($addresswhere);
            } else {
                $obj = $datas->where($addresswhere);
            }            //判断是否有搜索的关键字
            if(!empty($searchname)){
                $obj = $obj->where("ext.expertname","like","%".$searchname."%");
            }
            //对三种排序进行判断
            if(!empty($ordertime)){
                $obj = $obj->orderBy('ext.expertid',$ordertime);
            }

            $datas = $obj->paginate(9);

            return view("public.selectExpert",compact('type','cate','searchname','datas','supply','address','ordertime'));
        }

        $datas = $datas->orderBy("ext.expertid",'desc')->paginate(9);
        $ordertime = 'desc';
        return view("public.selectExpert",compact('type','cate','datas','ordertime'));
    }

    /**支付判断
     * @param Request $request
     */
    public function payJudge(Request $request)
    {
        $data = $request->input();
        if(!empty(session('userId')) && !empty($data['type']) && !empty($data['id'])){
            $return = self::getPayData(session('userId'),$data['type'],$data['id']);
            return $return;
        } else {
            return ['icon' => 2,'code' => 2,'type' => $data['type'],'id' => $data['id']];
        }
    }

    /**吧支付所需要的参数数据返回
     * @param $userid
     * @param $type
     * @param $id
     * @return array
     */
    static public function getPayData($userid,$type,$id){
        $payType = 'payMoney';

        switch ($type){
            case 'show':
                $showverify = DB::table('view_showstatus')->where('showid',$id)->pluck('configid');
                if($showverify == 1){
                    $basicdata = DB::table('t_s_show')->where('showid',$id)->pluck('basicdata');
                    $basicdata = unserialize($basicdata);
                    $amount = $basicdata['selectnumbers']*env('showPrice');
                    $channel = $basicdata['paytype'] == '微信支付' ? 'wx_pub_qr' :'alipay_pc_direct';
                    $type = 'show';
                    $showid = $id;
                    $urlType = url('/keepshow',$id);
                    $subject = '升维网项目评议';
                    return [
                        'icon' => 1,
                        'data' => [
                            'payType' => $payType,
                            'userid' => $userid,
                            'channel' => $channel,
                            'type' => $type,
                            'showid' => $showid,
                            'urlType' => $urlType,
                            'subject' => $subject,
                            'amount' => $amount
                        ]
                    ];
                } else {
                    return [
                        'icon' => 2,
                        'msg' => '已支付'
                    ];
                }

            case 'meet':
                /*$basicdata = DB::table('t_m_meet')->where('meetid',$id)->pluck('basicdata');
                $amount = $basicdata['selectnumbers']*env('showPrice');
                $channel = $basicdata['paytype'] == '微信支付' ? 'wx_pub_qr' :'alipay_pc_direct';
                $type = 'show';
                $showid = $id;
                $urlType = url('/keepshow',$id);
                $subject = '升维网项目评议';
                return [
                    'payType' => $payType,
                    'userid' => $userid,
                    'channel' => $channel,
                    'type' => $type,
                    'showid' => $showid,
                    'urlType' => $urlType,
                    'subject' => $subject,
                    'amount' => $amount
                ];*/
        }
    }

    /**
     * 线下路演
     */
    public function lineShowIndex()
    {
        if(!empty(session('userId'))){
            $entinfo = DB::table('t_u_enterprise')->where('userid',session('userId'))->select('enterprisename','job','industry')->first();
        }
        $cate = DB::table('t_common_domaintype')->where('level',1)->get();
        return view('show.lineshowindex',compact('cate','entinfo'));
    }

    /**
     * 线下路演提交按钮
     */
    public function submitLineShow(Request $request)
    {
        $data = $request->input();
        $file = $request->file('file');
        $userid = empty(session('userId')) ? '':session('userId');
        $lineshowid = $data['lineshowid'];
        if($data['upload'] != 1){
        if ($file->isValid()) {

            // 获取文件相关信息
        $originalName = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径
        $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
        $filename = date('YmdHis'). uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
        $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
        } else {
            return ['msg' => '上传失败~','icon' => 2,'code' => 3];
        }
        }
        DB::beginTransaction();
        try {

            //判断用户是否登录 改变/插入企业表数据
            if($userid){
                $enterprise = DB::table('t_u_enterprise')->where('userid',$userid)->first();
                if(!empty($enterprise)){
                    DB::table('t_u_enterprise')->where('userid',$userid)->update([
                        'enterprisename' => $data['entername'],
                        'job' => $data['enterjob'],
                        'industry' => $data['industry']
                    ]);
                } else {
                    DB::table('t_u_enterprise')->where('userid',$userid)->insert([
                        'enterprisename' => $data['entername'],
                        'job' => $data['enterjob'],
                        'industry' => $data['industry']
                    ]);
                }
            }

            $lineshowid = DB::table('t_s_lineshow')->insertGetId([
                    "userid" => $userid,
                    "title" =>$data['projectname'],
                    "describe" =>$data['projecttxt'],
                    "remarks" =>$data['remarks'],
                    'bpurl' => $filename,
                    'bpname' => $originalName,
                    "puttime" =>date('Y-m-d H:i:s',time()),
                    "created_at" =>date('Y-m-d H:i:s',time()),
                    "updated_at" =>date('Y-m-d H:i:s',time())
            ]);

            DB::commit();
            $msg = ['msg' => '提交成功', 'icon' => 1, 'code' => 4, 'url' => url('keeplineshow', $lineshowid)];
        }catch(Exception $e){
                //异常处理
                $msg = ['msg' => '提交失败','icon' => 2,'code' => 6];
                throw $e;
            }
        return $msg;
    }

    /**
     *
     */
    public function keeplineshow($lineshowid)
    {

        $lineShowData = DB::table('t_s_lineshow')
            ->leftJoin('t_u_enterprise','t_u_enterprise.userid','=','t_s_lineshow.userid')
            ->where('lineshowid',$lineshowid)
            ->select('t_s_lineshow.*','t_u_enterprise.enterprisename','t_u_enterprise.job','t_u_enterprise.industry')
            ->first();

        return view('show.keeplineshow',compact('lineShowData'));
    }

}
