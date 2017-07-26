@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 企业办事服务 / start -->
            <h3 class="main-top">企业办事服务</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step works-step">
                        <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">6</span>完成
                    </div>
                    <div class="publish-need uct-works default-result">
                        <div class="expert-certy-state">
                            <i class="iconfont icon-chenggong"></i>
                                <span class="publish-need-blue">
                                    <em>正在审核</em>IS REVIEWING
                                </span>
                        </div>
                        <div class="publish-need-sel">
                            <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def verify-default">demo1</a>
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
                        <textarea readonly="readonly" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述"></textarea>
                        <div class="uct-works-exp">
                            <a href="javascript:;" class="special-btn">专家</a>
                            <a href="javascript:;" class="system-btn2 active uct-works-btn">系统分配</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(function(){

    })

</script>
@endsection