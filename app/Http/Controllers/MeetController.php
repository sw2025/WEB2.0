<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/5
 * Time: 11:33
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class MeetController extends Controller
{

    /**
     * 约见投资人页面
     *
     **/
    public function Index($meetid=0)
    {
        if(!empty($meetid)) {
            $meetData = DB::table('t_m_meet')->where('meetid',$meetid)->first();
            $basedata = unserialize($meetData->basicdata);
            $expertData = DB::table('t_u_expert')->where('expertid',$meetData->expertid)->select('showimage','expertname')->first();
            return view('meet.index',compact('meetData','expertData','basedata','meetid','cate'));
        }

        $cate = DB::table('t_common_domaintype')->where('level',1)->get();
        return view('meet.index',compact('meetData','expertData','basedata','meetid','cate'));
    }

    /**
     * 约见投资人页面
     *
     **/
    public function keepmeet($meetid)
    {
        $meetData = DB::table('t_m_meet')->where('meetid',$meetid)->first();

        $basedata = unserialize($meetData->basicdata);

        $expertData = DB::table('t_u_expert')->where('expertid',$meetData->expertid)->select('showimage','expertname')->first();


        return view('meet.keepmeet',compact('meetData','expertData','basedata','meetid'));
    }


    /**
     * 提交约见投资人资料
     */
    public function submitMeet(Request $request)
    {
        $data = $request->input();
        $userid = empty(session('userId')) ? '':session('userId');

        DB::beginTransaction();
        try{
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

            if($data['meetid']){

                $basedata = [
                    'paytype' => $data['paytype'],
                    'enterprisename' => $data['entername'],
                    'job' => $data['enterjob'],
                    'industry' => $data['industry'],
                    'expertname' => $data['name'],
                    'oneword' => $data['oneword']
                    ];

                DB::table('t_m_meet')->where('meetid',$data['meetid'])->update([
                    "userid"=> 1,
                    "timelot"=>$data['timelot'],
                    "expertid"=> $data['expertid'],
                    "contents"=> $data['projecttxt'],
                   /* "price"=> $data['linefee'],
                    "timelot"=> $data['timelot'],*/
                    'basicdata'=> serialize($basedata),
                    "puttime"=> date('Y-m-d H:i:s',time()),
                    "created_at"=> date('Y-m-d H:i:s',time()),
                    "updated_at"=> date('Y-m-d H:i:s',time()),
                ]);

                DB::commit();
                $msg = ['msg' => '提交成功','icon' => 1,'code' => 4,'url' => url('keepmeet',$data->meetid)];

            }else{


            $basedata = [
                'paytype' => $data['paytype'],
                'enterprisename' => $data['entername'],
                'job' => $data['enterjob'],
                'industry' => $data['industry'],
                'expertname' => $data['name'],
                'oneword' => $data['oneword']
            ];

            $meetid = DB::table('t_m_meet')->insertGetId([
                "userid"=> 1,
                "timelot"=>$data['timelot'],
                "expertid"=> $data['expertid'],
                "contents"=> $data['projecttxt'],
                "price"=> $data['linefee'],
                "timelot"=> $data['timelot'],
                'basicdata'=> serialize($basedata),
                "puttime"=> date('Y-m-d H:i:s',time()),
                "created_at"=> date('Y-m-d H:i:s',time()),
                "updated_at"=> date('Y-m-d H:i:s',time()),
            ]);

            DB::table('t_m_meetverify')->insert([
                "meetid" =>$meetid,
                "configid" =>1,
                "verifytime" =>date('Y-m-d H:i:s')
            ]);

            DB::commit();
            $msg = ['msg' => '提交成功','icon' => 1,'code' => 4,'url' => url('keepmeet',$meetid)];
          }

        }catch(Exception $e){
            //异常处理
            $msg = ['msg' => '提交失败','icon' => 2,'code' => 6];
            throw $e;
        }
        return $msg;
    }

}