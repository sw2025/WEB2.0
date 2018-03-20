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
//首页关于我们
Route::get('us','PublicController@us');
//首页服务介绍
Route::get('service','PublicController@service');

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

//提交项目
Route::get('submitIndex/{showid?}','ShowController@submitIndex');
//提交项目
Route::post('submitProject','ShowController@submitProject');
//提交项目
Route::get('keepSubmit/{showid}','ShowController@keepSubmit');
//删除提交项目
Route::post('deteleSubmit','ShowController@deteleSubmit');


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
//取消线下路演
Route::post('cancelLineShow','ShowController@cancelLineShow');
//获取accid和token
Route::post('getAccid','PublicController@getAccid');
//获取群ID
Route::post('getTeamId','PublicController@getTeamId');


/**************个人中心  我是企业 **************/
//首页
Route::get('entindex/index','EnterpriseUcenter@Index');
//评议列表页
Route::get('entmyshow/myshowindex','EnterpriseUcenter@myShowIndex');
//评议详情页
Route::get('/entmyshow/myshowdetail/{showid}','EnterpriseUcenter@myShowDetail');
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
//视频咨询处理响应的专家
Route::post('handleSelect', 'MyEnterpriseController@handleSelect');
//判断正在咨询的时间
Route::post('compareConsultTime', 'MyEnterpriseController@compareConsultTime');
//判断正在咨询的时间
Route::post('compareMeetTime', 'MyEnterpriseController@compareMeetTime');
//咨询结束
Route::post('finishConsult', 'MyEnterpriseController@finishConsult');
Route::post('finishMeet', 'EnterpriseUcenter@finishMeet');
//线上约见页面
Route::get('entmymeet/intomeeting/{meetid}','EnterpriseUcenter@intoMeeting');
/**************个人中心  我是专家 **************/
//个人中心认证首页
Route::get('expindex/index','ExpertUcenter@Index');
//提交认证方法
Route::post('submitExpertVerify','ExpertUcenter@submitExpertVerify');
//我的评议列表页
Route::get('expmyshow/myShowList','ExpertUcenter@myShowList');
//我的约见列表页
Route::get('expmymeet/myMeetList','ExpertUcenter@myMeetList');
//我的私董会列表页
Route::get('expmysector/mySectorList','ExpertUcenter@mySectorList');

//我的评议详情页
Route::get('expmyshow/showdetail/{showid}','ExpertUcenter@showDetail');
//发表评议
Route::post('dealpostshow', 'ExpertUcenter@dealPostShow');
//我的约见详情页
Route::get('expmymeet/myMeetdetail/{meetid}','ExpertUcenter@myMeetDetail');
//我的约见详情页
Route::get('expmysector/intoSector/{consultid}','ExpertUcenter@intoSector');
//响应咨询
Route::post('uct_myask/responseconsult', 'ExpertUcenter@responseConsult');
//处理约见
Route::post('dealmeet', 'ExpertUcenter@dealMeet');

//线上约见页面
Route::get('expmymeet/intomeeting/{meetid}','ExpertUcenter@intoMeeting');
//我的钱包
Route::get('expmycharge/myCharge','ExpertUcenter@myCharge');
//收费设置
Route::get('expmycharge/chargeStandard','ExpertUcenter@chargeStandard');
//设置收费
Route::post('chargeStandard','ExpertUcenter@PostchargeStandard');
//充值提现
Route::get('uct_recharge', 'CenterController@recharge');
//获取充值记录
Route::post('getRecord', 'ExpertUcenter@getRecord');
//更换银行卡
Route::post('updateCard', 'ExpertUcenter@updateCard');
//专家绑定银行卡
Route::post('expertHaveCard', 'ExpertUcenter@expertHaveCard');
//提现
Route::post('applicationCashs', 'ExpertUcenter@applicationCashs');
//提现验证银行卡
Route::post('haveCard', 'ExpertUcenter@haveCard');
//专家绑定银行卡
Route::post('expertHaveCard', 'ExpertUcenterController@expertHaveCard');
//提现
Route::get('recharge/cash', 'ExpertUcenter@cash');
//提现添加银行卡
Route::get('expmycharge/card', 'ExpertUcenter@card');
//获取银行卡名称
Route::post('getBankName', 'PublicController@getBankName');
//验证银行卡
Route::get('expmycharge/card2', 'ExpertUcenterController@card2');
//添加银行卡处理
Route::post('cardHandle', 'ExpertUcenter@cardHandle');
//验证银行卡处理
Route::post('verifyCard', 'ExpertUcenter@verifyCard');
//个人设置页面
Route::get('personalSet', 'PublicController@personalSet');
//修改手机号页面
Route::get('/changeTel', 'PublicController@changeTel');
//修改手机号
Route::post('/changeNewPhone', 'PublicController@changeNewPhone');
//修改密码页面
Route::get('/changePwd', 'PublicController@changePwd');
//修改密码
Route::post('/updatePwd', 'PublicController@updatePwd');


//专家列表
Route::get('expert','ExpertController@index');
//专家详情
Route::get('expert/detail/{expertId}','ExpertController@detail');
//专家详情
Route::post('message','ExpertController@message');
//收藏
Route::post('dealextcollect','ExpertController@dealCollect');

//系统消息
Route::get('myinfo','MyinfoController@myinfo');
//消息标记已读
Route::post('uct_flagread', 'MyinfoController@flagRead');


