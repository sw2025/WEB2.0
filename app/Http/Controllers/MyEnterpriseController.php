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
}
