<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index(){
        $datas=DB::table("T_U_EXPERT")
                ->leftJoin("T_U_EXPERTFEE","T_U_EXPERTFEE.expertid","=","T_U_EXPERT.expertid")
                ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERTVERIFY.expertid","=","T_U_EXPERT.expertid")
                ->select("T_U_EXPERT.expertname","T_U_EXPERT.brief","T_U_EXPERT.expertid","T_U_EXPERT.category","T_U_EXPERT.domain1","T_U_EXPERTFEE.fee","T_U_EXPERTFEE.state","T_U_EXPERT.showimage")
                ->where("isfirst",1)
                ->where('category','专家')
                ->whereIn("T_U_EXPERTVERIFY.configid",[2,4])
                ->whereRaw("T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by T_U_EXPERTVERIFY.expertid)")
                ->take(12)
                ->orderBy("T_U_EXPERT.order","asc")
                ->orderBy("T_U_EXPERT.expertid","desc")
                ->get();

        return view("index.index",compact("datas"));
    }


    public function pdfUpload (){
        $shuffle = substr(time(), 3).rand(1000, 9999);
        return view('public.upload',compact("shuffle"));
    }

    public function acceptFile(Request $request){
        $file = $request->file('file');
        $code = $request->only('code');
        // 获取文件相关信息
        $originalName = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径
        $type = $file->getClientMimeType();     // image/jpeg

        // 上传文件
        $filename = date('YmdHis') . uniqid() . '.' . $ext;
        // 使用我们新建的uploads本地存储空间（目录）
        $bool = Storage::disk('uploads2')->put($filename, file_get_contents($realPath));
        $verify = DB::table('tokenverifyupload')->where('code',$code)->first();
        if(!empty($verify)){
            DB::table('tokenverifyupload')->where('code',$code)->update([
                'filepath' => $filename,
                'filename' => $originalName
            ]);
        }
        
    }

    public function getUploadStatus(Request $request){
        $code = $request->only('code');
        $verify = DB::table('tokenverifyupload')->where('code',$code)->first();
        if(empty($verify)){
            return ['code' => 2];
        } else {
            if(empty($verify->filepath)){
                return ['code' => 1];
            } else {
                return ['code' => 3];
            }
            
        }
    }


}
