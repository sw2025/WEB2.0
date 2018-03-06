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
    public function Index($showid='')
    {
        if(!empty($showid)){
            $showinfo = DB::table('t_s_show')->where('showid',$showid)->first();
            $basedata = unserialize($showinfo->basedata);
        }
        $cate = DB::table('t_common_domaintype')->where('level',1)->get();
        return view('show.index',compact('cate','showinfo','basedata'));
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
                $expertnumbers = $data['selectnumbers'];
                $expertids = DB::table('t_u_expert')
                    ->leftJoin('view_expertstatus as state','state.expertid','=','t_u_expert.expertid')
                    ->where('state.configid', 2)
                    ->where(['domain1' => $data['domain']])
                    ->whereRaw('1=1  group by rand()')
                    ->limit($expertnumbers)
                    ->pluck('t_u_expert.expertid');
                if(empty($expertids)){
                    $expertids = [0];
                }
                $expertids = implode(',',$expertids);
            } else {
                $expertids = 0;
            }

            $basedata = [
                    'role' => $data['role'],
                    'stage' => $data['stage'],
                    'paytype' => $data['paytype'],
                    'enterprisename' => $data['entername'],
                    'job' => $data['enterjob'],
                    'industry' => $data['industry']
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

                $showid = DB::table('t_s_show')->update($arr)->where('showid',$showid);
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
            }

            DB::table('t_s_showverify')->insert([
                'showid' => $showid,
                'configid' => 1,
                'verifytime' => $data['projecttxt'],
            ]);

            DB::commit();
            $msg = ['msg' => '提交成功','icon' => 1,'code' => 4,'url' => url('keepshow',$showid)];

        }catch(Exception $e){
            DB::rollback();
            $msg = ['msg' => '提交失败','icon' => 2,'code' => 6];
            throw $e;
        }
        return $msg;
    }


    public function keepShow($showid)
    {
        $showinfo = DB::table('t_s_show')->where('showid',$showid)->first();
        $basedata = unserialize($showinfo->basedata);
        return view('show.keepshow',compact('showinfo','basedata'));
    }

}
