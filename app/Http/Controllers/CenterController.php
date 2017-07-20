<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CenterController extends Controller
{
    /**基本资料
     * @return mixed
     */
    public function index(){
        return view("ucenter.index");
    }

    /**修改手机号
     * @return mixed
     */
    public function  changeTel(){
        return view("ucenter.changeTel");
    }

    /**
     * 充值提现
     * @return mixed
     */
    public function recharge(){
        return view("ucenter.recharge");
    }

    /**充值
     * @return mixed
     */
    public function rechargeMoney(){
        return view("ucenter.rechargeMoney");
    }

    /**提现
     * @return mixed
     */
    public function cash(){
        return view("ucenter.cash");
    }

    /**我的信息
     * @return mixed
     */
    public  function  myinfo(){
        return view("ucenter.myinfo");
    }

    /**我的需求
     * @return mixed
     */
    public function  supplyNeed(){
        return view("ucenter.supplyNeed");
    }

    /**专家认证
     * @return mixed
     */
    public function  expert(){
        return view("ucenter.expert");
    }
    
   

}
