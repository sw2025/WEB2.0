<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//首页
Route::get('/','IndexController@index');
//登陆
Route::get('/login','LoginController@login');
//注册
Route::get('/register','LoginController@register');
//忘记密码
Route::get('/forget','LoginController@forget');
//获取验证码
Route::post('/getCode','LoginController@getCode');
//登陆信息验证处理
Route::post('/loginHandle','LoginController@loginHandle');
//注册信息验证处理
Route::post('/registerHandle','LoginController@registerHandle');
//忘记密码信息验证处理
Route::post('/forgetHandle','LoginController@forgetHandle');
//退出
Route::post('quit','LoginController@quit');


//提交项目评议页面
Route::get('showIndex/{showid?}','ShowController@Index');
//保存项目评议
Route::post('submitShow','ShowController@submitShow');
//保存项目评议页面
Route::get('keepshow/{showid}','ShowController@keepshow');
//项目评议选择专家页面
Route::any('selectExpert','ShowController@selectExpert');


//提交线下约见页面
Route::get('meetIndex/{meetid?}','MeetController@Index');
//保存约见
Route::post('submitMeet','MeetController@submitMeet');
//保存约见页面
Route::get('keepmeet/{meetid}','MeetController@keepmeet');

//判断支付
Route::post('payJudge','ShowController@payJudge');
//ping++支付接口
Route::post("charge",'PingpayController@charge');
//线下路演发布页
Route::get('lineShowIndex','ShowController@lineShowIndex');

/**************个人中心  我是企业 **************/
//企业个人中心首页
Route::get('entindex/index','EnterpriseUcenter@Index');
//企业个人中心我的评议首页
Route::get('entmyshow/myshowindex','EnterpriseUcenter@myshowIndex');
//企业个人中心修改企业数据
Route::post('modifyEntData','EnterpriseUcenter@modifyEntData');
