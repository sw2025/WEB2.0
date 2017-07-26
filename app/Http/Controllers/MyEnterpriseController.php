<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyEnterpriseController extends Controller
{
    /**专家资源库
     * @return mixed
     */
    public function  resource(){
        return view("myenterprise.resource");
    }

    /**专家资源详情
     * @return mixed
     */
    public  function resDetail(){
        return view("myenterprise.resDetail");
    }

    /**会员认证
     * @return mixed
     */
    public  function uct_member(){
        return view("myenterprise.member");
    }

    /**会员认证2
 * @return mixed
 */
    public  function member2(){
        return view("myenterprise.member2");
    }
    /**会员认证3
     * @return mixed
     */
    public  function member3(){
        return view("myenterprise.member3");
    }
    /**会员认证4
     * @return mixed
     */
    public  function member4(){
        return view("myenterprise.member4");
    }

    /**办事服务
     * @return mixed
     */
    public  function works(){
        return view("myenterprise.works");
    }

    /**申请办事服务
     * @return mixed
     */
    public function work1(){
        return view("myenterprise.work1");
    }

    /**申请办事服务2
     * @return mixed
     */
    public function work2(){
        return view("myenterprise.work2");
    }
    /**申请办事服务3
     * @return mixed
     */
    public function work3(){
        return view("myenterprise.work3");
    }
    /**申请办事服务4
     * @return mixed
     */
    public function work4(){
        return view("myenterprise.work4");
    }
    /**申请办事服务5
     * @return mixed
     */
    public function work5(){
        return view("myenterprise.work5");
    }
    /**申请办事服务6
     * @return mixed
     */
    public function work6(){
        return view("myenterprise.work6");
    }

    /**视频咨询
     * @return mixed
     */
    public function video(){
        return view("myenterprise.video");
    }
    /**申请视频咨询1
     * @return mixed
     */
    public function video1(){
        return view("myenterprise.video1");
    }
    /**视申请视频咨询2
     * @return mixed
     */
    public function video2(){
        return view("myenterprise.video2");
    }
    /**申请视频咨询3
     * @return mixed
     */
    public function video3(){
        return view("myenterprise.video3");
    }
    /**申请视频咨询4
     * @return mixed
     */
    public function video4(){
        return view("myenterprise.video4");
    }
    /**申请视频咨询5
     * @return mixed
     */
    public function video5(){
        return view("myenterprise.video5");
    }
    /**申请视频咨询6
     * @return mixed
     */
    public function video6(){
        return view("myenterprise.video6");
    }
    
}
