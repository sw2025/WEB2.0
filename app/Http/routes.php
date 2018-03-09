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


//提交约见页面
Route::get('meetIndex/{meetid?}','MeetController@Index');
//保存约见
Route::post('submitMeet','MeetController@submitMeet');
//保存约见页面
Route::get('keepmeet/{meetid}','MeetController@keepmeet');

//提交约见大V约见页面
Route::get('daVIndex/{meetid?}','MeetController@Index');
//提交约见大V约见页面
Route::get('keepdav/{meetid}','MeetController@keepmeet');

//判断支付
Route::post('payJudge','ShowController@payJudge');
//ping++支付接口
Route::post("charge",'PingpayController@charge');
//线下路演发布页
Route::get('lineShowIndex','ShowController@lineShowIndex');
//线下路演发布页
Route::post('submitLineShow','ShowController@submitLineShow');
//线下路演
Route::get('keeplineshow/{lineshowid}','ShowController@keeplineshow');

/**************个人中心  我是企业 **************/
//首页
Route::get('entindex/index','EnterpriseUcenter@Index');
//评议列表页
Route::get('entmyshow/myshowindex','EnterpriseUcenter@myShowIndex');
//修改企业数据
Route::post('modifyEntData','EnterpriseUcenter@modifyEntData');
//约见投资人列表页
Route::get('entmymeet/mymeetindex','EnterpriseUcenter@myMeetIndex');
//约见大V列表页
Route::get('entmydav/mydavindex','EnterpriseUcenter@myDavIndex');
//线下路演列表页
Route::get('entmylineshow/mylineshowindex','EnterpriseUcenter@myLineShowIndex');
//私董会列表页
Route::get('entmysector/mysectorindex','EnterpriseUcenter@mySectorIndex');
//发布私董会页面
Route::get('entmysector/supplysector','EnterpriseUcenter@supplySector');
//保存私董会
Route::post('consultCharge', 'MyEnterpriseController@consultCharge');
//申请视频咨询指定专家
Route::get('uct_video/videoSelect', 'MyEnterpriseController@videoSelect');
//视频咨询
Route::get('entmysector/detail/{consultId}', 'EnterpriseUcenter@sectorDetail');
/**************个人中心  我是专家 **************/
//专家个人中心认证首页
Route::get('expindex/index','ExpertUcenter@Index');
//专家提交认证方法
Route::post('submitExpertVerify','ExpertUcenter@submitExpertVerify');
