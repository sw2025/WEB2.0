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
                        <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">6</span>完成
                    </div>
                    <div class="publish-need uct-works default-result">
                        <div class="expert-certy-state">
                            <span class="uct-works-icon icon1"></span>
                                <span class="publish-need-blue">
                                    <em>专家响应</em>EXPERTS RESPONSE
                                </span>
                        </div>
                        <div class="system-invite light-color">已经响应<span class="invite-count">30人</span></div>
                        <div class="mywork-det-txt uct-works-known">
                            <span class="mywork-det-tit"><em class="light-color">分类：</em>销售类</span>
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">水电费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法国会尽快法国红酒对方过后风格好久法国红酒法规和你们更好更好费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法法规进口法国红酒对方过后更好更换即可对方回家法法规</p>
                            </div>
                        </div>
                        <div class="uct-works-exps">
                            <ul class="uct-works-exps-list">
                                <li class="current"><a href="javascript:;"><span></span>专家1</a></li>
                                <li><a href="javascript:;"><span></span>专家2</a></li>
                                <li><a href="javascript:;"><span></span>专家3</a></li>
                                <li><a href="javascript:;"><span></span>专家4</a></li>
                            </ul>
                            <button type="button" class="test-btn">确认</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(function(){
        $('.uct-works-exps-list li').click(function(event) {
            $(this).toggleClass('current');
        });
    })

</script>
@endsection