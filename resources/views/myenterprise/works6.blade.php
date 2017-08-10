@extends("layouts.works")
@section("content")
<div class="main">
    <!-- 企业办事服务 / start -->
    <h3 class="main-top">企业办事服务</h3>
    <div class="ucenter-con">
        <div class="main-right">
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
                            <div class="emcee">
                                <span class="light-color emcee-cap">主持人：</span>
                                <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                            </div>
                            <div class="emcee-bottom">
                                <span class="light-color emcee-cap emcee-bot-cap">成员：</span>
                                <div class="emcee-members">
                                    <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                    <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                    <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="works-manage">
                    <div class="works-first execute works-manage-step">
                        <h2 class="handle-affair-tit">1.企业提交基本资料</h2>
                        <p class="handle-affair-desc">资料文件可包括企业对办事的详细需求，以及企业自身的主客观条件等，专家确认后进入下一阶段。</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">
                            <ul class="opinion-list">
                                <li class="opinion-item">
                                    <p class="opinion-item-desc">
                                        正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写
                                    </p>
                                    <span class="opinion-item-time">2017-08-08 12:33</span>
                                </li>
                                <li class="opinion-item">
                                    <p class="opinion-item-desc">
                                        正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写
                                    </p>
                                    <span class="opinion-item-time">2017-08-08 12:33</span>
                                </li>
                                <li class="opinion-item">
                                    <p class="opinion-item-desc">
                                        正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写
                                    </p>
                                    <span class="opinion-item-time">2017-08-08 12:33</span>
                                </li>
                                <li class="opinion-item">
                                    <p class="opinion-item-desc">
                                        正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写
                                    </p>
                                    <span class="opinion-item-time">2017-08-08 12:33</span>
                                </li>
                                <li class="opinion-item">
                                    <p class="opinion-item-desc">
                                        正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写
                                    </p>
                                    <span class="opinion-item-time">2017-08-08 12:33</span>
                                </li>
                            </ul>
                            <div class="pages myinfo-page">
                                <div id="Pagination"></div>
                                <span class="page-sum">共<strong class="allPage">15</strong>页</span>
                            </div>
                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-second works-manage-step">
                        <h2 class="handle-affair-tit">2.专家提交资料目录</h2>
                        <p class="handle-affair-desc">专家开出办事所需资料的目录，企业确认后进入下一阶段。</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">

                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-third works-manage-step">
                        <h2 class="handle-affair-tit">3.企业提交办事资料</h2>
                        <p class="handle-affair-desc">企业根据第2步里专家要求的资料目录，提交相关资料，专家确认后进入下一阶段。</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">

                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-forth works-manage-step">
                        <h2 class="handle-affair-tit">4.专家提交办事初步方案</h2>
                        <p class="handle-affair-desc">专家提出办事初步方案，双方确认后进入下一阶段</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">

                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-fifth works-manage-step">
                        <h2 class="handle-affair-tit">5.企业提交合作框架</h2>
                        <p class="handle-affair-desc">企业提出交易框架合同，双方确认后，进入下一阶段</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">

                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-sixth works-manage-step">
                        <h2 class="handle-affair-tit">6.专家提交办事实施方案</h2>
                        <p class="handle-affair-desc">专家拿出实施方案，企业修改，专家反馈，双方确认</p>
                        <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <span>上传文件</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" />
                                </span>
                        </div>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-confirm">确认资料</a>
                            <a href="javascript:;" class="datum-btn datum-change">修改意见</a>
                            <a href="javascript:;" class="datum-btn datum-history">历史意见<span class="history-counts">99</span></a>
                        </div>
                        <!-- 历史意见/start -->
                        <div class="history-opinion">

                        </div>
                        <!-- 历史意见/end -->
                    </div>
                    <div class="works-last works-manage-step">
                        <h2 class="handle-affair-tit">7.日程管理</h2>
                        <p class="handle-affair-desc">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</p>
                        <div class="datum-manage">
                            <a href="javascript:;" class="datum-btn datum-add" style="display:block">新增日程</a>
                        </div>
                        <ul class="add-works-task">
                            <li>
                                <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                <span class="task-state task-ing">进行中</span>
                                <div class="task-dispose">
                                    <span class="task-icon-finish task-icon" title="完成"><i class="iconfont icon-xuanzhong"></i></span>
                                    <span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span>
                                </div>
                            </li>
                            <li>
                                <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                <span class="task-state task-finished">已完成</span>
                                <div class="task-dispose">
                                    <span class="task-icon-finish task-icon" title="完成"><i class="iconfont icon-xuanzhong"></i></span>
                                    <span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("15");
        // 点击历史意见
        $('.datum-history').on('click', function(event) {
            $(this).closest('.works-manage-step').children('.history-opinion').stop().slideToggle();
        });
        // 确定资料
        $('.datum-confirm').bind('click', function(event) {
            var $that = $(this);
            if($that.closest('.works-manage-step').hasClass('execute')){
                layer.confirm('资料确认无误吗？', {
                    title:false,
                    btn: ['确认','取消']
                }, function(index){
                    layer.close(index);
                    $that.unbind('click');
                    $that.siblings('.datum-change').unbind('click');
                    $that.closest('.works-manage-step').next().addClass('execute');
                })

            }
        });
        // 点击修改意见
        function stopPropagation(e) {
            if (e.stopPropagation)
                e.stopPropagation();
            else
                e.cancelBubble = true;
        }
        $('.datum-change').bind('click',function(e) {
            var $that = $(this);
            if($that.closest('.works-manage-step').hasClass('execute')){
                stopPropagation(e);
                $('.cover').fadeIn();
            }
        });
        $(document).click(function(e) {
            stopPropagation(e);
            $('.cover').fadeOut();
        });
        $('.cover-pop').click(function(e) {
            stopPropagation(e);
        });
        $('.cover-cancel').click(function(event) {
            $(this).closest('.cover').fadeOut();
        });
        // 新增任务
        $('.datum-add').click(function() {
            if($(this).closest('.works-manage-step').hasClass('execute')){
                var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span></div><button class="confirm-task-btn" type="button">确定</button></li>'
                $('.add-works-task').append(tag);
            }
        });

        // 鼠标滑过li
        $('.add-works-task').on('mouseover mouseout', 'li', function() {
            if($(this).closest('.works-manage-step').hasClass('execute')){
                $(this).children('.task-dispose').stop().fadeToggle(200);
            }
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
@endsection