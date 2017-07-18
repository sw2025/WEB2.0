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
    
   

}
