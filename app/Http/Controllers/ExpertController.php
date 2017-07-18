<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExpertController extends Controller
{
    /**专家列表
     * @return mixed
     */
    public function index(){
        return view("expert.index");
    }

    /**专家详情
     * @return mixed
     */
    public  function detail(){
        return view("expert.detail");
    }




}
