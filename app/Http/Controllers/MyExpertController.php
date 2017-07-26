<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyExpertController extends Controller
{
    /**专家认证
     * @return mixed
     */
    public function  expert(){
        return view("myexpert.expert");
    }

    /**我的办事
     * @return mixed
     */
    public function mywork(){
        return view("myexpert.mywork");
    }

    /**我的办事详情
     * @return mixed
     */
    public function  workDetail(){
        return view("myexpert.workDetail");
    }

    /**我的咨询
     * @return mixed
     */
    public function myask(){
        return view("myexpert.myask");
    }

    /**我的咨询的详情
     * @return mixed
     */
    public function  askDetail(){
        return view("myexpert.askDetail");
    }

    /**进入视频会议
     * @return mixed
     */
    public function myaskinvt(){
        return view("myexpert.myaskinvt");
    }
    
}
