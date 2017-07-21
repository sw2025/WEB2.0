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
Route::get('/','IndexController@index');
//首页专家数据
Route::post('returnData','IndexController@returnData');
//专家列表
Route::post('collectExpert','ExpertController@collectExpert');
//登录
Route::get('login','LoginController@login');
//注册
Route::get('register','LoginController@register');
//找回密码
Route::get('forget','LoginController@forget');
//登录验证
Route::post('loginHandle','LoginController@loginHandle');
//注册验证
Route::post('registerHandle','LoginController@registerHandle');
//注册验证
Route::post('forgetHandle','LoginController@forgetHandle');
//退出
Route::post('quit','LoginController@quit');
//获取验证码
Route::post('getCode','LoginController@getCode');
//专家列表
Route::get('expert','ExpertController@index');
//专家详情
Route::get('expert/detail','ExpertController@detail');
//专家详情
Route::get('expert/detail/{expertId}','ExpertController@detail');
//供求信息
Route::get('supply','SupplyController@index');
//供求信息详情
Route::get('supply/detail/{supplyId}','SupplyController@detail');
<<<<<<< HEAD
=======

/**************************************收藏留言相关路由*********************************************/
//供求收藏
Route::post('dealcollect','SupplyController@dealCollect');
//供求留言
Route::post('replymessage','SupplyController@replyMessage');
//专家收藏
Route::post('dealextcollect','ExpertController@dealCollect');
//专家留言
Route::post('replyextmessage','ExpertController@replyMessage');

>>>>>>> origin/lds
/**************************************个人中心的路由***********************************************/
//基本资料
Route::get('uct_basic','CenterController@index');
//修改手机号
Route::get('uct_basic/changeTel','CenterController@changeTel');
//充值提现
Route::get('uct_recharge','CenterController@recharge');
//充值
Route::get('uct_recharge/rechargeMoney','CenterController@rechargeMoney');
//体现
Route::get('uct_recharge/cash','CenterController@cash');
//我的信息
Route::get('uct_myinfo','CenterController@myinfo');
//我的需求
Route::get('uct_myneed','CenterController@supplyNeed');
//专家认证
Route::get('uct_expert','CenterController@expert');