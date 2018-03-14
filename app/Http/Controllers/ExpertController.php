<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpertController extends Controller
{
    /**专家列表
     * @return mixed
     */
    public function index(Request $request)
    {
        //获取板块信息
        $cate = DB::table('t_common_domaintype')->get();
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user', 'ext.userid', '=', 'user.userid')
            ->leftJoin('t_u_expertfee as fee', 'ext.expertid', '=', 'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll', 'ext.expertid', '=', 'coll.expertid')
            ->leftJoin('view_expertmesscount as mess', 'ext.expertid', '=', 'mess.expertid')
            ->leftJoin('view_expertstatus as status', 'ext.expertid', '=', 'status.expertid')
            ->where('status.configid', 2)
            ->select('ext.*', 'user.phone', 'fee.fee','fee.linefee', 'fee.state', 'coll.count as collcount', 'mess.count as messcount');
        //获得用户的收藏
        $collectids = [];
        if (session('userId')) {
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'), 'remark' => 1])->lists('expertid');
        }
        $domainselect = ['找资金' => '投融资', '找技术' => '科研技术', '定战略' => '战略管理', '找市场' => '市场资源'];
        $domainselect2 = ['投融资' => '找资金', '科研技术' => '找技术', '战略管理' => '定战略', '市场资源' => '找市场'];
        //判断是否为http请求
        if (!empty($get = $request->input())) {
            //获取到get中的数据并处理
            $searchname = (isset($get['searchname']) && $get['searchname'] != "null") ? $get['searchname'] : null;
            $role = (isset($get['role']) && $get['role'] != "null") ? $get['role'] : null;
            $supply = (isset($get['supply']) && $get['supply'] != "null") ? explode('/', $get['supply']) : null;
            $address = (isset($get['address']) && $get['address'] != "null") ? $get['address'] : null;
            $consult = (isset($get['consult']) && $get['consult'] != "null") ? $get['consult'] : null;
            $ordertime = (isset($get['ordertime']) && $get['ordertime'] != "null") ? $get['ordertime'] : null;
            $ordercollect = (isset($get['ordercollect']) && $get['ordercollect'] != "null") ? $get['ordercollect'] : null;
            $ordermessage = (isset($get['ordermessage']) && $get['ordermessage'] != "null") ? $get['ordermessage'] : null;
            //设置where条件生成where数组
            $rolewhere = !empty($role) ? array("category" => $role) : array();

            $addresswhere = !empty($address) ? array("ext.address" => $address) : array();
            if (!empty($consult) && $consult == '收费') {
                $consultwhere = ['fee.state' => 1];
            } elseif (!empty($consult) && $consult == '免费') {
                $consultwhere = ['fee.state' => 0];
            } else {
                $consultwhere = [];
            }

            if (!empty($supply)) {
                $supply[0] = $domainselect2[$supply[0]];
                $obj = $datas->where($rolewhere)->where('ext.domain1', $supply[0])->where('ext.domain2', 'like', '%' . $supply[1] . '%')->where($addresswhere)->where($consultwhere);
                $supply[0] = $domainselect[$supply[0]];
            } else {
                $obj = $datas->where($rolewhere)->where($addresswhere)->where($consultwhere);
            }

            //判断是否有搜索的关键字
            if (!empty($searchname)) {
                $obj = $obj->where("ext.expertname", "like", "%" . $searchname . "%");
            }
            //对三种排序进行判断
            if (!empty($ordertime)) {
                $obj = $obj->orderBy('ext.expertid', $ordertime);
            } elseif (!empty($ordercollect)) {
                $obj = $obj->orderBy('coll.count', $ordercollect);
            } else {
                $obj = $obj->orderBy('mess.count', $ordermessage);
            }
            $datas = $obj->paginate(12);

            return view("expert.index", compact('cate', 'searchname', 'datas', 'role', 'collectids', 'consult', 'domainselect', 'supply', 'address', 'ordertime', 'ordercollect', 'ordermessage'));
        }
        $datas = $datas->orderBy("ext.expertid", 'desc')->paginate(8);
        $ordertime = 'desc';

        return view("expert.index", compact('cate', 'datas', 'ordertime', 'collectids', 'domainselect'));

    }

    /**专家详情
     * @return mixed
     */
    public function detail($expertid)
    {
        $memberrights = DB::table("t_u_memberright")->where("memberid", "<>", 1)->get();
        $domainselect = ['找资金' => '投融资', '找技术' => '科研技术', '定战略' => '战略管理', '找市场' => '市场资源'];
        $array = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_expertfee as fee', 'ext.expertid', '=', 'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll', 'ext.expertid', '=', 'coll.expertid')
            ->leftJoin('view_expertmesscount as mess', 'ext.expertid', '=', 'mess.expertid')
            ->leftJoin('view_expertstatus as status', 'ext.expertid', '=', 'status.expertid')
            ->where('status.configid', 2)
            ->lists('ext.expertid');
        if (!in_array("$expertid", $array)) {
            return redirect("/");
        }
        $cate = DB::table('t_common_domaintype')->get();
        //取出指定的供求信息
        $datas = DB::table('t_u_expert as ext')
            ->leftJoin('t_u_user as user', 'ext.userid', '=', 'user.userid')
            ->leftJoin('t_u_expertfee as fee', 'ext.expertid', '=', 'fee.expertid')
            ->leftJoin('view_expertcollectcount as coll', 'ext.expertid', '=', 'coll.expertid')
            ->leftJoin('view_expertmesscount as mess', 'ext.expertid', '=', 'mess.expertid')
            ->leftJoin('view_expertstatus as state', 'state.expertid', '=', 'ext.expertid')
            ->leftJoin('t_u_expertfee as expertfee', 'expertfee.expertid', '=', 'ext.expertid')
            ->where(['state.configid' => 2])
            ->select('ext.*', 'user.phone', 'fee.fee', 'fee.state','expertfee.linefee');
        $obj = clone $datas;
        $datas = $datas->where('ext.expertid', $expertid)->first();
        //取出同类下推荐的供求
        $info = ['domain1' => $datas->domain1, 'domain2' => $datas->domain2, 'expertid' => $datas->expertid];
        $recommendNeed = $obj->where('ext.expertid', '<>', $info['expertid'])->orderBy('expertid', 'desc');
        $obj2 = clone $recommendNeed;
        //取出相同二级类下面的供求
        $recommendNeed = $recommendNeed->where(['ext.domain2' => $info['domain2'], 'ext.domain1' => $info['domain1']])->take(5)->get();
        //不足5条时 在一级类下面查找供求
        if (count($recommendNeed) < 5) {
            $commedomain1 = $obj2->where('ext.domain1', $info['domain1'])->where('ext.domain2', '<>', $info['domain2'])->take(5 - count($recommendNeed))->get();
            $recommendNeed = array_merge($recommendNeed, $commedomain1);
        }
        //获得用户的收藏
        $collectids = [];
        if (session('userId')) {
            $collectids = DB::table('t_u_collectexpert')->where(['userid' => session('userId'), 'remark' => 1])->lists('expertid');
        }
        //查询留言的信息
        $message = DB::table('t_u_messagetoexpert as msg')
            ->leftJoin('view_userrole as view','view.userid', '=','msg.userid')
            ->leftJoin('t_u_enterprise as ent','ent.enterpriseid', '=','view.enterpriseid')
            ->leftJoin('t_u_expert as ext','ext.expertid' ,'=' ,'view.expertid')
            ->leftJoin('t_u_user as user','user.userid' ,'=' ,'msg.userid')
            ->leftJoin('t_u_user as user2','user2.userid' ,'=' ,'msg.use_userid')
            ->where('msg.expertid',$expertid)
            ->where('msg.isdelete',0)
            ->select('msg.*','ent.enterprisename','ext.expertname','user.avatar','user.nickname','user.phone','user2.nickname as nickname2','user2.phone as phone2')
            ->orderBy('messagetime','desc')
            ->get();
        //分组取出每个回复的数量
        $getmsgcount = DB::table('t_u_messagetoexpert')->where('expertid',$expertid)->groupBy('parentid')->select(DB::raw('parentid ,count(*) as count'))->having('parentid','<>',0)->get();
        $msgcount = [];
        foreach ($getmsgcount as $k => $v) {
            $msgcount[$v->parentid] = $v->count;
        }
        $eventinfo = null;
        $isexpert = false;
        if (!empty(session('userId'))) {
            $expertinfo = DB::table('view_expertstatus')->where(['userid' => session('userId'), 'expertid' => $expertid])->first();
            if (!empty($expertinfo)) {
                $eventinfo = DB::table('t_e_eventresponse as res')
                    ->leftJoin('t_e_event as event', 'event.eventid', '=', 'res.eventid')
                    ->leftJoin('t_u_enterprise as ent', 'event.userid', '=', 'ent.userid')
                    ->leftJoin('view_eventstatus as status', 'status.eventid', '=', 'res.eventid')
                    ->select('res.*', 'event.domain1', 'event.domain2', 'event.brief', 'ent.showimage', 'event.eventtime', 'event.eventtime', 'ent.enterprisename as name', 'res.state')
                    ->whereRaw('res.id in (select max(`t_e_eventresponse`.`id`) from `t_e_eventresponse` group by `t_e_eventresponse`.`expertid`,eventid)')
                    ->where(['res.expertid' => $expertid])
                    ->whereIn('status.configid', [4, 5, 6, 7, 8, 9])
                    ->where('res.state', '<>', 5)
                    ->orderBy('res.id', 'desc')
                    ->get();
                $eventinfo = \EventClass::handelObj2($eventinfo);
                $isexpert = true;
            } else {
                $eventinfo = DB::table('t_e_eventresponse as res')
                    ->leftJoin('t_e_event as event', 'event.eventid', '=', 'res.eventid')
                    ->leftJoin('t_u_enterprise as ent', 'event.userid', '=', 'ent.userid')
                    ->leftJoin('view_eventstatus as status', 'status.eventid', '=', 'res.eventid')
                    ->select('res.*', 'event.domain1', 'ent.showimage', 'event.domain2', 'event.brief', 'event.eventtime', 'event.eventtime', 'ent.enterprisename as name', 'res.state')
                    ->whereRaw('res.id in (select max(`t_e_eventresponse`.`id`) from `t_e_eventresponse` group by `t_e_eventresponse`.`expertid`,eventid)')
                    ->where(['res.expertid' => $expertid, 'event.userid' => session('userId')])
                    ->whereIn('status.configid', [4, 5, 6, 7, 8, 9])
                    ->where('res.state', '<>', 5)
                    ->orderBy('res.id', 'desc')
                    ->get();
                $eventinfo = \EventClass::handelObj2($eventinfo);
            }
        }
        return view("expert.detail", compact('datas', 'recommendNeed', 'domainselect', 'message', 'collectids', 'msgcount', 'cate', 'memberrights', 'eventinfo', 'isexpert'));
    }

    //发布留言
    public function message(Request $request)
    {
        $data = $request->input();
        $userid = session('userId');
        $result = DB::table('t_u_messagetoexpert')->insert([
                'userid' => $userid,
                'expertid' => $data['expertId'],
                'content' => $data['describe'],
                'messagetime' => date('Y-m-d H:i:s',time()),
                'parentid' => $data['messageid'],
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time())
            ]);

        if($result){
            return $res = ['state'=>1];
        }else{
            return $res = ['state'=>2];
        }
    }

    //收藏专家
    public function collectExpert()
    {
        $array = array();
        $userId = session("userId");
        $count = DB::table("T_U_COLLECTEXPERT")->where("userid", $userId)->where("expertid", $_POST['expertId'])->count();
        if ($count) {
            $result = DB::table("T_U_COLLECTEXPERT")->where("userid", $userId)->where("expertid", $_POST['expertId'])->update([
                "remark" => $_POST['remark'],
                "updated_at" => date("Y-m-d H:i:s", time()),
            ]);
        } else {
            $result = DB::table("T_U_COLLECTEXPERT")->insert([
                "userid" => $userId,
                "expertid" => $_POST['expertId'],
                "collecttime" => date("Y-m-d H:i:s", time()),
                "remark" => $_POST['remark'],
                "created_at" => date("Y-m-d H:i:s", time()),
                "updated_at" => date("Y-m-d H:i:s", time()),
            ]);
        }
        if ($result) {
            return $array['code'] = "success";
        } else {
            return $array['code'] = "false";
        }
    }


    /**处理收藏
     * @param Request $request
     * @return string
     */
    public function dealCollect(Request $request)
    {
        //判断是否登陆
        if (!session('userId')) {
            return 'nologin';
        }
        //判断是否为ajax请求
        if ($request->ajax()) {
            $data = $request->only('action', 'supplyid');
            if (empty($data['supplyid'])) {
                return 'error';
            }
            $userid = session('userId');
            $where = ['expertid' => $data['supplyid'], 'userid' => $userid];
            if ($data['action'] == 'collect') {
                $is_insert = DB::table('t_u_collectexpert')->where($where)->first();
                if ($is_insert) {
                    $res = DB::table('t_u_collectexpert')->where($where)->update(['remark' => 1]);
                } else {
                    $res = DB::table('t_u_collectexpert')->insertGetId([
                        'expertid' => $data['supplyid'],
                        'userid' => $userid,
                        'collecttime' => date('Y-m-d H:i:s', time()),
                        'remark' => 1,
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ]);
                }
            } elseif ($data['action'] == 'cancel') {
                $res = DB::table('t_u_collectexpert')->where($where)->update(['remark' => 0]);
            }
            if ($res) {
                return 'success';
            } else {
                return 'error';
            }
        }
        return 'error';

    }

    /**回复留言
     * @param Request $request
     * @return string
     */
    public function replyMessage(Request $request)
    {
        if (empty(session('userId'))) {
            return ['msg' => 'nologin', 'icon' => 5];
        }
        if ($request->ajax()) {
            $data = $request->only('content', 'needid', 'parentid', 'use_userid');
            if ($data['use_userid'] == session('userId')) {
                return ['msg' => '亲,没必要自己回复自己', 'icon' => 0];
            }
            $data['expertid'] = $data['needid'];
            $expertuserid = DB::table('t_u_expert')->where('expertid', $data['expertid'])->first();
            $userinfo = DB::table('t_u_user')->where('userid', session('userId'))->first();
            if (empty($expertuserid) || empty($userinfo)) {
                return ['msg' => '专家不存在或用户不存在', 'icon' => 0];
            }
            $verifymember = DB::table('t_u_enterprise as ent')
                ->leftJoin('t_u_enterpriseverify as ver', 'ver.enterpriseid', '=', 'ent.enterpriseid')
                ->orderBy('ver.id', 'desc')
                ->where('ent.userid', session('userId'))
                ->first();
            if ($expertuserid->userid != session('userId') && (empty($verifymember) || $verifymember->configid != 3)) {
                return ['msg' => '不是认证企业或者本专家不能留言', 'icon' => 0];
            }
            if ($data['parentid'] != 0) {
                $msgcount = DB::table('t_u_messagetoexpert')->where('parentid', $data['parentid'])->where('isdelete', 0)->count();
                if ($msgcount >= 5) {
                    return ['msg' => '留言下的回复最多回复5次想详细交流可异步办事', 'icon' => 6];
                }
            }
            unset($data['needid']);
            $data['userid'] = session('userId');
            $data['messagetime'] = date('Y-m-d H:i:s', time());
            DB::beginTransaction();
            try {
                $res = DB::table('t_u_messagetoexpert')->insert($data);
                if ($expertuserid->userid != session('userId') && !$data['parentid']) {
                    $content = !empty($userinfo->nickname) ? '用户' . $userinfo->nickname . '给您发送了一条留言：' . $data['content'] : '用户' . substr_replace($userinfo->phone, '****', 3, 4) . '给您发送了一条留言：' . $data['content'];
                    $msg = DB::table('t_m_systemmessage')->insert([
                        'sendid' => 0,
                        'receiveid' => $expertuserid->userid,
                        'sendtime' => date('Y-m-d H:i:s', time()),
                        'title' => '有用户给您留言了',
                        'content' => $content,
                        'expertid' => $data['expertid'],
                        'state' => 0
                    ]);
                }
                if ($expertuserid->userid != session('userId') && $data['parentid'] && !$data['use_userid']) {
                    $content = !empty($userinfo->nickname) ? '用户' . $userinfo->nickname . '给您发送了一条留言：' . $data['content'] : '用户' . substr_replace($userinfo->phone, '****', 3, 4) . '给您发送了一条留言：' . $data['content'];
                    $parid = DB::table('t_u_messagetoexpert')->where('id', $data['parentid'])->first();
                    if (empty($parid)) {
                        return 'error';
                    }
                    if ($parid->userid != session('userId')) {
                        $msg = DB::table('t_m_systemmessage')->insert([
                            'sendid' => 0,
                            'receiveid' => $parid->userid,
                            'sendtime' => date('Y-m-d H:i:s', time()),
                            'title' => '有用户给您留言了',
                            'content' => $content,
                            'expertid' => $data['expertid'],
                            'state' => 0
                        ]);
                    }
                }
                if ($expertuserid->userid != session('userId') && $data['parentid'] && $data['use_userid']) {
                    $content = !empty($userinfo->nickname) ? '用户' . $userinfo->nickname . '给您发送了一条留言：' . $data['content'] : '用户' . substr_replace($userinfo->phone, '****', 3, 4) . '给您发送了一条留言：' . $data['content'];
                    if ($data['use_userid'] != session('userId')) {
                        $msg = DB::table('t_m_systemmessage')->insert([
                            'sendid' => 0,
                            'receiveid' => $data['use_userid'],
                            'sendtime' => date('Y-m-d H:i:s', time()),
                            'title' => '有用户给您留言了',
                            'content' => $content,
                            'expertid' => $data['expertid'],
                            'state' => 0
                        ]);
                    }
                }
                DB::commit();
                return ['msg' => '留言/回复成功', 'icon' => 1];
            } catch (Exception $e) {
                DB::rollback();
                return ['msg' => '留言失败请刷新重试', 'icon' => 0];
            }
        }
        return ['msg' => '留言失败请刷新重试', 'icon' => 0];
    }
}