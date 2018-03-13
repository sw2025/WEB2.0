<?php
    class  UserClass extends BaseClass
    {
        /**
         * 登录验证
         * @param $userName
         * @param $passWord
         * @return array
         */
        public static function LoginVerify($phone, $passWord)
        {
            $array = array();
            $nameCount = DB::table("T_U_USER")->where("phone", $phone)->count();
            if ($nameCount) {
                $counts = \App\User::where("phone", $phone)->where("password", md5($passWord))->get()->toArray();
                if (count($counts) != 0) {
                    $array['code'] = "success";
                    session(["userId" => $counts[0]['userid']]);
                    $array['userId'] = $counts[0]['userid'];
                    $array['name'] = !empty($counts[0]['nickname'])?$counts[0]['nickname']:substr_replace($phone,'****',3,4);
                    $roles=DB::table("view_userrole")->where('userid',$counts[0]['userid'])->pluck("role");
                    $array['role']=$roles;
                    session(['role' => $roles]);
                    session(['phone' => substr_replace($phone,'****',3,4)]);
                } else {
                    $array['code'] = "pwd";
                    $array['msg'] = "密码错误!";
                }
            } else {
                $array['code'] = "phone";
                $array['msg'] = "手机号尚未注册!";
            }
            return $array;
        }

        /**注册验证
         * @param $phone
         * @param $role
         * @param $pwd
         * @return array
         * @throws Exception
         */
        public static function regVerify($phone, $role, $pwd)
        {
            $result = array();
           /* if ($role == "企业") {
                $table = "T_U_ENTERPRISE";
            } else {
                $table = "T_U_EXPERT";
            }*/
            $counts =\App\User::where("phone", $phone)->get()->toArray();
            if (count($counts) == 0) {
                DB::beginTransaction();
                try {
                    $userid = DB::table("T_U_USER")->insertGetId([
                        "phone" => $phone,
                        "password" => md5($pwd),
                        "registertime" => date("Y-m-d H:i:s", time()),
                        "created_at" => date("Y-m-d H:i:s", time()),
                        "updated_at" => date("Y-m-d H:i:s", time()),
                    ]);
                    /*DB::table($table)->insert([
                        "userid" => $userid,
                        "created_at" => date("Y-m-d H:i:s", time()),
                        "updated_at" => date("Y-m-d H:i:s", time()),
                    ]);*/
                    DB::table("t_m_systemmessage")->insert([
                        "sendid"=>0,
                        "receiveid"=>$userid,
                        "sendtime"=>date("Y-m-d H:i:s",time()),
                        "title"=>"感谢您注册升维网",
                        "content"=>"您已成功注册升维网",
                        "state"=>0,
                        "created_at"=>date("Y-m-d H:i:s",time()),
                        "updated_at"=>date("Y-m-d H:i:s",time()),
                    ]);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                if (!isset($e)) {
                    self::getAccId($userid,$phone);
                    $counts = \App\User::where('userid',$userid)->get()->toArray();
                    $result['code'] = "success";
                    session(["userId" =>$userid ]);
                    $result['userId'] = $userid;
                    $result['name'] = !empty($counts[0]['nickname'])?$counts[0]['nickname']:substr_replace($phone,'****',3,4);
                    $roles=DB::table("view_userrole")->where('userid',$userid)->pluck("role");
                    session(['role' => $roles]);
                    session(['phone' => substr_replace($phone,'****',3,4)]);
                    $result['role']=$roles;
                } else {
                    $result['code'] = "phone";
                    $result['msg'] = "注册失败,请重新注册";
                }
                return $result;
            }else{
                $result['code'] = "phone";
                $result['msg'] = "该手机号已经注册!";
                return $result;
            }

        }

        //找回密码验证
        public static function forgetVerify($phone, $pwd)
        {
            $result = array();
            $counts = \App\User::where("phone", $phone)->get()->toArray();
            if (count($counts) != 0) {
                $res = DB::table("T_U_USER")->where("phone", $phone)->update([
                    "password" => md5($pwd),
                    "updated_at" => date("Y-m-d H:i:s", time()),
                ]);
                if ($res) {
                    $result['code'] = "success";
                } else {
                    $result['code'] = "phone";
                    $result['msg'] = "找回失败!";
                }
                return $result;
            }
            $result['code'] = "phone";
            $result['msg'] = "该手机号尚未注册!";
            return $result;
        }
        //找回密码验证
        public static function changeVerify($phone, $userId)
        {
            $result = array();
            $counts = \App\User::where("phone", $phone)->get()->toArray();
            if (count($counts) == 0) {
                $res = DB::table("T_U_USER")->where("userid", $userId)->update([
                    "phone" => $phone,
                    "updated_at" => date("Y-m-d H:i:s", time()),
                ]);
                if ($res) {
                    $result['code'] = "success";
                    $result['msg'] = "修改成功!";
                    $result['url'] = url('personalSet');
                } else {
                    $result['code'] = "error";
                    $result['msg'] = "修改失败!";
                }
                return $result;
            }
            $result['code'] = "phone";
            $result['msg'] = "该手机号已经存在!";
            return $result;
        }

        /**获取用户余额
         * @param $userId
         * @return mixed
         */
        public static function getMoney($userId)
        {
            try {
                $incomes = DB::table("T_U_BILL")->where(["userid" => $userId, "type" => "收入"])->sum("money");
                $pays = DB::table("T_U_BILL")->where(["userid" => $userId, "type" => "支出"])->sum("money");
                $expends = DB::table("T_U_BILL")->where(["userid" => $userId, "type" => "在途"])->sum("money");
                $balance = $incomes - $pays - $expends;
            } catch (Exception $e) {
                throw $e;
            }
            if (!isset($e)) {
                return $balance;
            }
        }

        /**网易云信accid和token
         * @param $userId
         * @param $nickname
         * @throws Exception
         */
        public static  function getAccId($userId,$phone){
            $AppKey = env('AppKey');
            $AppSecret = env('AppSecret');
            $serverApi = new \ServerApiClass($AppKey, $AppSecret);
            $accid = "sw_" . $userId;
            $name = substr_replace($phone,'****',3,4);
            $props="";
            $icon="/avatar.jpg";
            $token="";
            $result = $serverApi->createUserId($accid, $name,$props,$icon,$token);
            if ($result['code'] == 200) {
                try {
                    DB::table("t_u_user")->where("userid", $userId)->update([
                        "accid" => $accid,
                        "imtoken" => $result['info']['token'],
                    ]);
                } catch (Exception $e) {
                    throw $e;
                }
            }
        }

        /**网易云信更新用户名片
         * @param $accid
         * @param $name
         * @param $icon
         */
        public  static  function updateName($accid,$name,$icon){
            $AppKey = env('AppKey');
            $AppSecret = env('AppSecret');
            $serverApi = new ServerApiClass($AppKey, $AppSecret);
            $result=$serverApi->updateUinfo($accid,$name,$icon);
        }

        /**反选专家之后，创建网易云的群
         * @param $expertIDS
         * @param $consultId
         */
        public  static function createGroups($expertIDS,$consultId){
            $accids=array();
            $userIds=DB::table("t_u_expert")->select("userid")->whereIn("expertid",$expertIDS)->get();
            foreach ($userIds as $userId){
                $accid=DB::table('t_u_user')->where("userid",$userId->userid)->pluck("accid");
                $accids[]=$accid;
            }
            $tname="咨询讨论组";
            $phone=DB::table("t_u_user")->where("userid",session('userId'))->pluck("accid");
            $AppKey = env('AppKey');
            $AppSecret = env('AppSecret');
            $serverApi = new \ServerApiClass($AppKey, $AppSecret);
            $msg="欢迎";
            $codes=$serverApi->createGroup($tname,$phone,$accids,'','',$msg,'0','0','0');
            DB::table("t_s_im")->insert([
                "userid"=>session('userId'),
                "tid"=>$codes['tid'],
                "state"=>0,
                "consultid"=>$consultId,
                "eventid"=>"",
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);
        }

        /**办事反选专家之后，创建网易云的群
         * @param $expertIDS
         * @param $consultId
         */
        public  static function createEventGroups($expertIDS,$eventId){

            $accids=array();
            $userIds=DB::table("t_u_expert")->select("userid")->whereIn("expertid",$expertIDS)->get();
            foreach ($userIds as $userId){
                $accid=DB::table('t_u_user')->where("userid",$userId->userid)->pluck("accid");
                $accids[]=$accid;
            }
            $userID=DB::table("t_e_event")->where("eventid",$eventId)->pluck("userid");
            $tname="办事讨论组";
            $phone=DB::table("t_u_user")->where("userid",$userID)->pluck("accid");
            $AppKey = env('AppKey');
            $AppSecret = env('AppSecret');
            $serverApi = new \ServerApiClass($AppKey, $AppSecret);
            $msg="欢迎";
            $codes=$serverApi->createGroup($tname,$phone,$accids,'','',$msg,'0','0','0');
            $res=DB::table("t_s_im")->insert([
                "userid"=>$userID,
                "tid"=>$codes['tid'],
                "state"=>0,
                "consultid"=>'',
                "eventid"=>$eventId,
                "created_at"=>date("Y-m-d H:i:s",time()),
                "updated_at"=>date("Y-m-d H:i:s",time())
            ]);
        }
    }
?>