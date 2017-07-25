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
}
