<?php
    class  UserClass extends BaseClass{
        /**
         * 登录验证
         * @param $userName
         * @param $passWord
         * @return array
         */
        public static  function  LoginVerify($phone,$passWord){
            $array=array();
            $nameCount=DB::table("T_U_USER")->where("phone",$phone)->count();
            if($nameCount){
                $counts=\App\User::where("phone",$phone)->where("password",md5($passWord))->get()->toArray();
                if(count($counts)!=0){
                    $array['code']="success";
                    session(["userId"=>$counts[0]['userid']]);
                    $array['userId']=$counts[0]['userid'];
                    $array['name']=$counts[0]['name'];
                }else{
                    $array['code']="pwd";
                    $array['msg']="密码错误!";
                }
            }else{
                $array['code']="phone";
                $array['msg']="手机号尚未注册!";
            }
            return $array;
        }

        public  function regVerify($phone,$role,$pwd){
            $result=array();
            if($role=="企业"){
                $table="T_U_ENTERPRISE";
            }else{
                $table="T_U_EXPERT";
            }
            $counts=User::where("phone",$phone)->get()->toArray();
            if(count($counts)==0){
                DB::beginTransaction();
                try{
                    $userid=DB::table("T_U_USER")->insertGetId([
                        "phone"=>$phone,
                        "password"=>md5($pwd),
                        "registertime"=>date("Y-m-d H:i:s",time()),
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                    DB::table($table)->insert([
                        "userid"=>$userid,
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                    DB::commit();
                }catch(Exception $e){
                    DB::rollback();
                    throw $e;
                }
                if(!isset($e)){
                    $result['code']="success";
                    session(["userId"=>$counts[0]['userid']]);
                    $result['userId']=$counts[0]['userid'];
                    $result['name']=$counts[0]['name'];
                }else{
                    $result['code']="phone";
                    $result['msg']="注册失败,请重新注册";
                }
                return $result;
            }
            $result['code']="phone";
            $result['msg']="该手机号已经注册!";
            return $result;
        }
        //找回密码验证
        public  function  forgetVerify($phone,$pwd){
            $result=array();
            $counts=User::where("phone",$phone)->get()->toArray();
            if(count($counts)!=0){
                $res=DB::table("T_U_USER")->where("phone",$phone)->update([
                    "password"=>md5($pwd),
                    "updated_at"=>date("Y-m-d H:i:s",time()),
                ]);
                if($res){
                    $result['code']="success";
                }else{
                    $result['code']="phone";
                    $result['msg']="找回失败!";
                }
                return $result;
            }
            $result['code']="phone";
            $result['msg']="该手机号尚未注册!";
            return $result;
        }


    }
?>