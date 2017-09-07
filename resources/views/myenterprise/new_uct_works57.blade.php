@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/works.css')}}" />
                <!-- 企业办事服务 / start -->
                <div class="ucenter-con">
                    <div class="main-right v-step-box">
                        <div class="card-step works-step">
                            <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                            <span class="gray-circle">6</span>完成
                        </div>
                        <div class="uct-video-manage">
                            <div class="video-manage-top">
                                <div class="vid-man-top-lt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <p class="vid-man-top-cat"><span class="light-color">分类：</span>销售类</p>
                                        <span class="mywork-det-tit"><em class="light-color">金额：</em>￥3000</span>
                                        <span class="light-color">描述：</span>
                                        <div class="vid-man-top-desc">水电费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法国会尽快法国红酒对方过后风格好久</div>
                                    </div>
                                </div>
                                <div class="vid-man-top-rt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <div class="persons-lt">
                                            <div class="emcee">
                                                <span class="light-color emcee-cap">企业：</span>
                                                <span class="emceer-pers" title="企业名字"><img src="img/avatar1.jpg" />企业名字</span>
                                            </div>
                                            <div class="emcee-bottom">
                                                <span class="light-color emcee-cap emcee-bot-cap">专家：</span>
                                                <div class="emcee-members">
                                                    <span class="emceer-pers" title="专家名字"><img src="img/avatar1.jpg" />专家名字</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="camera-comunicate">
                                            <span class="camera"><img src="{{asset('img/camera.png')}}" /></span>
                                            <a href="javascript:;" class="video-comu">视频沟通</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="works-manage">
                                <div class="works-last works-manage-step">
                                    <h2 class="handle-affair-tit">日程管理</h2>
                                    <a href="javascript:;" class="datum-btn datum-add" style="display:block"><i class="iconfont icon-bianji"></i>新增日程</a>
                                    <ul class="add-works-task">
                                        <li>
                                            <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                            <span class="task-state task-ing">进行中</span>
                                            <div class="task-dispose">
                                                <span class="task-icon-finish task-icon" title="完成"></span>
                                                <span class="task-icon-delete task-icon" title="删除"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                            <span class="task-state task-finished">已完成</span>
                                            <div class="task-dispose">
                                                <span class="task-icon-finish task-icon" title="完成"></span>
                                                <span class="task-icon-delete task-icon" title="删除"></span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="v-manage-link-rate">
                                        <span class="vprogress vprog1 vping" title="企业提交基本资料"></span>
                                        <span class="vprogress vprog2 vping" title="专家提交资料目录"></span>
                                        <span class="vprogress vprog3 vping" title="企业提交办事资料"></span>
                                        <span class="vprogress vprog4 vping" title="专家提交办事初步方案"></span>
                                        <span class="vprogress vprog5 vping" title="企业提交合作框架"></span>
                                        <span class="vprogress vprog6 vping" title="专家提交办事实施方案"></span>
                                        <span class="vprogress vprog7" title="日程管理"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="works-f-s">
                            <button class="stop red-finish" type="button">完成</button>
                            <button class="stop" type="button">终止合作</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 企业办事服务 / end -->
    <!-- 修改意见/start -->
    <div class="cover">
        <div class="cover-pop">
            <textarea name="" id="" cols="30" rows="10" class="opinion-txt"></textarea>
            <button type="button" class="test-btn cover-confirm">确定</button>
            <button type="button" class="test-btn cover-cancel">取消</button>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $("#Pagination").pagination("15");
            // 新增任务
            $('.datum-add').click(function() {
                var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button">确定</button></li>'
                $('.add-works-task').append(tag);
            });

            // 鼠标滑过li
            $('.add-works-task').on('mouseover mouseout', 'li', function() {
                $(this).children('.task-dispose').stop().fadeToggle(200);
            });
            // 点击完成
            $('.add-works-task').on('click', '.task-icon-finish', function() {
                var $state = $(this).closest('li').find('.task-state');
                if(!$state.hasClass('task-finished')){
                    layer.confirm('确定该日程已完成吗？', {
                        title:false,
                        btn: ['确认','取消'] //按钮
                    }, function(index){
                        layer.close(index);
                        $state.html('已完成').addClass('task-finished');
                    })
                }
            });
            // 点击删除
            $('.add-works-task').on('click', '.task-icon-delete', function() {
                var $li = $(this).closest('li');
                layer.confirm('确定删除该日程吗？', {
                    title:false,
                    btn: ['确认','取消'] //按钮
                }, function(index){
                    layer.close(index);
                    $li.remove();
                })
            })

        })
    </script>
    <!-- 修改意见/end -->
    <!-- 修改意见/end -->
    @endsection
