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
                        <span class="green-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">6</span>完成
                    </div>
                    <div class="publish-need uct-works-final">
                        <div class="expert-certy-state">
                            <i class="iconfont icon-chenggong"></i>
                                <span class="expert-certy-blue">
                                    <em>完成</em>COMPLETE
                                </span>
                        </div>
                        <div class="rate">
                            <div class="rate-exp">
                                <span class="rate-exp-icon">专家1</span>
                                <div id="star1" class="rating"></div>
                                <a href="javascript:;" class="rate-btn">评价</a>
                                <div class="rate-box">
                                    <input type="text" class="rate-inp" />
                                    <button type="button" class="rate-confirm-btn">确定</button>
                                </div>
                            </div>
                            <div class="rate-exp">
                                <span class="rate-exp-icon">专家2</span>
                                <div id="star2" class="rating"></div>
                                <a href="javascript:;" class="rate-btn">评价</a>
                                <div class="rate-box">
                                    <input type="text" class="rate-inp" />
                                    <button type="button" class="rate-confirm-btn">确定</button>
                                </div>
                            </div>
                            <div class="rate-exp">
                                <span class="rate-exp-icon">专家3</span>
                                <div id="star3" class="rating"></div>
                                <a href="javascript:;" class="rate-btn">评价</a>
                                <div class="rate-box">
                                    <input type="text" class="rate-inp" />
                                    <button type="button" class="rate-confirm-btn">确定</button>
                                </div>
                            </div>
                        </div>
                        <div class="uct-works-con">
                            <button class="test-btn rate-star-btn" type="button">确认</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $('.rate-btn').click(function() {
            $(this).next('.rate-box').toggleClass('dib');
        });
        $('.rating').raty({
            starOff: 'img/staroff.png',
            starOn : 'img/staron.png',
            starHalf:'img/starhalf.png',
            half: true,
            width:211,
            click: function(score) {
                console.log('ID: ' + $(this).attr('id') + "\nscore: " + score);
            }
        });
    })
</script>
@endsection