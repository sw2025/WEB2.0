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
//公共获取用户余额
Route::post('returnMoney','PublicController@returnMoney');
//首页专家数据
Route::post('returnData','IndexController@returnData');
//专家列表
Route::post('collectExpert','ExpertController@collectExpert');
//首页服务介绍
Route::get('service','PublicController@service');
//首页关于我们
Route::get('us','PublicController@us');
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

//找回密码验证
Route::post('forgetHandle','LoginController@forgetHandle');

//退出
Route::post('quit','LoginController@quit');
/*//验证手机号是否注册
Route::post('verifyPhone','LoginController@verifyPhone');*/
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
//查询分配专家
Route::post('matchingexpert','PublicController@matchingExpert');

/**************************************收藏留言相关路由*********************************************/
//供求收藏
Route::post('dealcollect','SupplyController@dealCollect');
//供求留言
Route::post('replymessage','SupplyController@replyMessage');
//专家收藏
Route::post('dealextcollect','ExpertController@dealCollect');
//专家留言
Route::post('replyextmessage','ExpertController@replyMessage');

/**************************************个人中心公共的路由***********************************************/
Route::group(['middleware' => ['auth']], function () {
//修改手机号获取验证码
    Route::post('getcodes', 'CenterController@getcodes');
//修改手机号获取验证码
    Route::post('returnCode', 'CenterController@returnCode');
//更换手机号
    Route::post('changeNewPhone', 'CenterController@changeNewPhone');
//更换密码处理
    Route::post('updatePwd', 'CenterController@updatePwd');
//检查原密码
    Route::post('inspectPwd', 'CenterController@inspectPwd');
//公共上传图片
    Route::any('upload', 'PublicController@upload');
//办事上传资料
    Route::any('eventupload', 'PublicController@eventUpload');
//办事上传资料
    Route::any('download', 'PublicController@download');
//办事上传资料
    Route::any('deletedownload', 'PublicController@deleteDownload');
//基本资料修改
    Route::post('changeBasics', 'CenterController@changeBasics');
//添加银行卡处理
    Route::post('cardHandle', 'CenterController@cardHandle');
//更换银行卡
    Route::post('updateCard', 'CenterController@updateCard');
//获取银行卡名称
    Route::post('getBankName', 'PublicController@getBankName');
//验证银行卡处理
    Route::post('verifyCard', 'CenterController@verifyCard');
//提现
    Route::post('applicationCashs', 'CenterController@applicationCashs');
//获取充值记录
    Route::post('getRecord', 'CenterController@getRecord');
//消息标记已读
    Route::post('uct_flagread', 'CenterController@flagRead');
//新增需求
    Route::post('uct_myneed/addNeed', 'CenterController@addNeed');
//解决需求
    Route::post('uct_myneed/solveNeed', 'CenterController@solveNeed');
//验证发布需求身份
    Route::post('myneed/verifyputneed', 'CenterController@verifyPutNeed');
//判断系统消息是否已读
    Route::post('getMessage', 'PublicController@getMessage');

    /***************************************个人中心我是企业路由(公共部分)****************************************************************/
//基本资料
    Route::get('uct_basic', 'CenterController@index');
//修改手机号
    Route::get('uct_basic/changeTel', 'CenterController@changeTel');
//修改手机号2
    Route::get('uct_basic/changeTel2', 'CenterController@changeTel2');
//更换密码
    Route::get('uct_basic/changePwd', 'CenterController@changePwd');
//充值提现
    Route::get('uct_recharge', 'CenterController@recharge');
//充值
    Route::get('uct_recharge/rechargeMoney', 'CenterController@rechargeMoney');
//提现
    Route::get('uct_recharge/cash', 'CenterController@cash');
//提现添加银行卡
    Route::get('uct_recharge/card', 'CenterController@card');
//验证银行卡
    Route::get('uct_recharge/card2', 'CenterController@card2');
//我的信息
    Route::get('uct_myinfo', 'CenterController@myinfo');
//我的需求
    Route::get('uct_myneed', 'CenterController@myNeed');
//需求详情
    Route::get('uct_myneed/needDetail/{needid}', 'CenterController@needDetail');
//发布需求
    Route::get('uct_myneed/supplyNeed/{needid?}', 'CenterController@supplyNeed');
//审核需求
    Route::get('uct_myneed/examineNeed/{needid?}', 'CenterController@examineNeed');
//企业缴费
    Route::post('member/pay/{needid}', 'MyEnterpriseController@memberPay');
    /***************************************个人中心我是专家路由(公共部分)****************************************************************/
//基本资料
    Route::get('basic', 'ExpertUcenterController@index');
//修改手机号
    Route::get('basic/changeTel', 'ExpertUcenterController@changeTel');
//修改手机号2
    Route::get('basic/changeTel2', 'ExpertUcenterController@changeTel2');
//更换密码
    Route::get('basic/changePwd', 'ExpertUcenterController@changePwd');
//充值提现
    Route::get('recharge', 'ExpertUcenterController@recharge');
//充值
    Route::get('recharge/rechargeMoney', 'ExpertUcenterController@rechargeMoney');
//提现
    Route::get('recharge/cash', 'ExpertUcenterController@cash');
//提现添加银行卡
    Route::get('recharge/card', 'ExpertUcenterController@card');
//验证银行卡
    Route::get('recharge/card2', 'ExpertUcenterController@card2');
//我的信息
    Route::get('myinfo', 'ExpertUcenterController@myinfo');
//我的需求
    Route::get('myneed', 'ExpertUcenterController@myNeed');
//需求详情
    Route::get('myneed/needDetail/{needid}', 'ExpertUcenterController@needDetail');
//发布需求
    Route::get('myneed/supplyNeed/{needid?}', 'ExpertUcenterController@supplyNeed');
//审核需求
    Route::get('myneed/examineNeed/{needid?}', 'ExpertUcenterController@examineNeed');
//我的办事详情
    Route::get('mywork/workDetail/{eventid}', 'ExpertUcenterController@workDetail');

    /************************************我是企业*********************************************************/
//专家资源
    Route::get('uct_resource', 'MyEnterpriseController@resource');
//会员认证1
    Route::get('uct_member', 'MyEnterpriseController@uct_member');
//处理会员认证
    Route::post('uct_member/entverify', 'MyEnterpriseController@entVerify');
//会员认证2
    Route::get('uct_member/member2/{entid}', 'MyEnterpriseController@member2');
//会员认证3
    Route::get('uct_member/member3/{entid}', 'MyEnterpriseController@member3');
//会员认证4
    Route::get('uct_member/member4/{entid}', 'MyEnterpriseController@member4');
    /*//办事服务
    Route::get('uct_works','MyEnterpriseController@works');*/

//办事服务
    Route::get('uct_works', 'MyEnterpriseController@manage');
//办事详情
    Route::get('uct_works/detail/{eventId}', 'MyEnterpriseController@workDetail');
//处理上传的资料
    Route::post('uct_works/upload/{proid}', 'MyEnterpriseController@eventUpload');
//终止办事
    Route::post('stopevent', 'MyEnterpriseController@stopEvent');
//确认资料
    Route::post('truedocument', 'MyEnterpriseController@trueDocument');
//确认资料
    Route::post('uct_works/sendremark', 'MyEnterpriseController@sendRemark');
//申请办事服务1
    Route::get('uct_works/applyWork', 'MyEnterpriseController@applyWork');
//保存申请的办事服务
    Route::post('saveEvent', 'MyEnterpriseController@saveEvent');
//申请办事服务,指定专家
    Route::get('uct_works/reselect', 'MyEnterpriseController@reselect');
//申请办事服务,反选专家处理
    Route::post('selectExpert', 'MyEnterpriseController@selectExpert');
//办事完成，给专家星级评论
    Route::post('toExpertMsg', 'MyEnterpriseController@toExpertMsg');
//办事完成，给专家评论
    Route::post('toExpertContent', 'MyEnterpriseController@toExpertContent');
//视频咨询
    Route::get('uct_video', 'MyEnterpriseController@manageVideo');
//视频咨询
    Route::get('uct_video/detail/{consultId}', 'MyEnterpriseController@videoDetail');
//申请视频咨询
    Route::get('uct_video/applyVideo', 'MyEnterpriseController@applyVideo');
//保存视频咨询
    Route::post('saveVideo', 'MyEnterpriseController@saveVideo');
//申请视频咨询指定专家
    Route::get('uct_video/videoSelect', 'MyEnterpriseController@videoSelect');
//视频咨询处理响应的专家
    Route::post('handleSelect', 'MyEnterpriseController@handleSelect');
//咨询结束
    Route::post('finishConsult', 'MyEnterpriseController@finishConsult');
//咨询完成，给专家星级评论
    Route::post('toVideoExpertMsg', 'MyEnterpriseController@toVideoExpertMsg');
//咨询完成，给专家评论
    Route::post('toVideoExpertContent', 'MyEnterpriseController@toVideoExpertContent');

//添加过程7
    Route::post('addeventtask', 'MyEnterpriseController@addEventTask');
//添加日程
    Route::post('submittask', 'MyEnterpriseController@submitTask');
//申请视频咨询2
    Route::get('uct_video/video2', 'MyEnterpriseController@video2');
//申请视频咨询3
    Route::get('uct_video/video3', 'MyEnterpriseController@video3');
//申请视频咨询4
    Route::get('uct_video/video4', 'MyEnterpriseController@video4');

    Route::get('uct_resource/resDetail/{expertid}', 'MyEnterpriseController@resDetail');

//判断企业是否是会员
    Route::post("IsMember", 'PublicController@IsMember');
    /************************************我是专家*********************************************************/
//专家认证
    Route::get('uct_expert', 'MyExpertController@expert');
//专家审核
    Route::get('uct_expert2', 'MyExpertController@expert2');
//审核成功
    Route::get('uct_expert3', 'MyExpertController@expert3');
//专家资料提交
    Route::post('uct_expertData', 'MyExpertController@expertData');
//我的办事
    Route::get('uct_mywork', 'MyExpertController@mywork');
//我的办事详情
    Route::get('uct_mywork/workDetail/{eventid}', 'MyExpertController@workDetail');
//响应办事
    Route::post('uct_mywork/responseevent', 'MyExpertController@responseEvent');
//我的咨询
    Route::get('uct_myask', 'MyExpertController@myask');
//我的咨询详情
    Route::get('uct_myask/askDetail/{consultid}', 'MyExpertController@askDetail');
//响应咨询
    Route::post('uct_myask/responseconsult', 'MyExpertController@responseConsult');
//进入咨询会议
    Route::get('uct_myask/myaskinvt', 'MyExpertController@myaskinvt');
//收费标准
    Route::any('uct_standard', 'MyExpertController@standard');
    /***********************************视频路由*******************************************/
});
//创建群组
Route::get('creatGroup','PublicController@createGroups');
//获取accid和token
Route::post('getAccid','PublicController@getAccid');
//获取群ID
Route::post('getTeamId','PublicController@getTeamId');
//获取个人中心头像
Route::post('getAvatar','PublicController@getAvatar');