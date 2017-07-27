@extends("layouts.ucenter")
@section("content")
<script type="text/javascript" src="{{asset('js/laydate/laydate.js')}}"></script>
<div class="main">
            <!-- 企业办事服务 / start -->
            <h3 class="main-top">企业办事服务</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step works-step">
                        <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">6</span>完成
                    </div>
                    <div class="publish-need uct-works">
                        <div class="expert-certy-state">
                            <span class="uct-works-icon"><i class="iconfont icon-shenqing"></i></span>
                                <span class="expert-certy-blue">
                                    <em>办事申请</em>IS APPLYING
                                </span>
                        </div>
                        <div class="publish-need-sel">
                            <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def">demo1</a>
                            <ul class="publish-need-list" style="display: none;">
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list" style="display: none;">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list" style="display: none;">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list" style="display: none;">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list" style="display: none;">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <textarea name="" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述"></textarea>
                        <div class="calendar">
                            <div class="calendar-start clearfix">
                                <span>开始时间</span><span class="calendar-date laydate-icon" id="start"></span>
                            </div>
                            <div class="calendar-end clearfix">
                                <span>结束时间</span><span class="calendar-date laydate-icon" id="end"></span>
                            </div>
                        </div>
                        <div class="uct-works-exp">
                            <span>专家</span>
                            <a href="javascript:;" class="system-btn active uct-works-btn">系统分配</a>
                            <a href="javascript:;" class="uct-works-btn">指定专家</a>
                        </div>
                        <div class="uct-works-tips">
                            <b>提示</b><br />
                            线下谈判价钱
                            <p class="uct-works-tips-para light-color">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
                        </div>
                        <div class="uct-works-con">
                            <button class="test-btn submit-audit" type="button">提交审核</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $('.publ-need-sel-def').click(function() {
            $(this).next('ul').stop().slideToggle();
        });
        $('.publish-need-list li').hover(function() {
            $(this).children('ul').stop().show();
        }, function() {
            $(this).children('ul').stop().hide();
        });

        $('.publ-sub-list li').click(function() {
            var publishHtml = $(this).html();
            $('.publ-need-sel-def').html(publishHtml);
            $('.publish-need-list').hide();
        });

        $('.uct-works-exp a').click(function(event) {
            $(this).addClass('active').siblings().removeClass('active');
        });
    })
    // =========日期插件使用方法======>start
    !function(){
        laydate.skin('danlan');//切换皮肤，请查看skins下面皮肤库
    }();
    //日期范围限制
    var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: '2016-01-01', //设定最小日期为当前日期
        max: '2066-12-31 23:59:59', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: '2016-01-01',
        max: '2066-12-31 23:59:59',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，充值开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
    // ========日期插件使用方法======>end
</script>
@endsection