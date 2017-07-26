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

        //$userid = $_SESSION['userid'];
        $result=DB::table("T_U_USER")
            ->leftJoin("T_U_EXPERT","T_U_USER.USERID","=","T_U_EXPERT.USERID")
            ->leftJoin("T_U_EXPERTVERIFY","T_U_EXPERT.EXPERTID","=","T_U_EXPERTVERIFY.expertid")
            ->select("T_U_EXPERTVERIFY.configid")
            ->where("T_U_EXPERT.userid",3)
            ->whereRaw('T_U_EXPERTVERIFY.id in (select max(id) from T_U_EXPERTVERIFY group by expertid)')
            ->first();

   /*     if($result->configid == 1){
            return view("myexpert.expert");
        }elseif ($result->configid == 2){
            return redirect()->action('MyExpertController@expert2');
        }else{
            return redirect()->action('MyExpertController@expert3');
        }*/

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
    public function expertData()
    {

    /*  $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $array=array();*/

        //$userid = $_SESSION['userid'];

        $expertid=DB::table("T_U_EXPERT")
            ->insertGetId([
                "userid"=>11,
                "expertname"=>$_POST['name'],
                "category"=>$_POST['category'],
                "address"=>$_POST['address'],
                "licenceimage"=>$_POST['photo1'],
                "showimage"=>$_POST['photo2'],
                "brief"=>isset($_POST['brief'])?$_POST['brief']:"",
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);

        if(!empty($expertid)){
            $result=DB::table("T_U_EXPERTVERIFY")
                ->insert([
                    "expertid"=>$expertid,
                    "configid"=>1,
                    "remark"=>isset($_POST['brief'])?$_POST['brief']:"",
                    "verifytime"=>date("Y-m-d H:i:s",time()),
                    "created_at"=>date("Y-m-d H:i:s",time()),
                    "updated_at"=>date("Y-m-d H:i:s",time())
                ]);
        }

        if($result){
            $array['code']="success";
            return $array;
        }else{
            $array['code']="error";
            return $array;
        }
    }
}
