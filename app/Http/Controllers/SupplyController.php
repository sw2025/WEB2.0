<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupplyController extends Controller
{
    /**供求信息列表
     * @return mixed
     */
    public function index(){
        return view("supply.index");
    }

    /**供求信息详情
     * @return mixed
     */
    public  function detail(){
        return view("supply.detail");
    }

   
}
