@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 会员认证1 / start -->
            <h3 class="main-top">会员认证</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">3</span>缴费<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">4</span>认证成功
                    </div>
                    <div class="expert-certy member-certy">
                        <div class="expert-certy-state">
                            <i class="iconfont icon-huiyuanquanyi"></i>
                                <span class="expert-certy-blue">
                                    <em>了解会员权益</em>FOR MEMBERSHIP RIGHTS
                                </span>
                        </div>
                        <div class="member-box">
                            <div class="member-box-type member-type-differ clearfix">
                                <b class="member-type-cap">会员类别</b>
                                <label class="member-type-lab member-types focus" for="leib1" data-type="1">
                                    <input id="leib1" checked="checked" name="type" type="radio" />
                                    <span class="define-rad"></span><span class="member-opt">普通</span>
                                </label>
                                <label class="member-type-lab member-types" for="leib2" data-type="2">
                                    <input id="leib2" name="type" type="radio" />
                                    <span class="define-rad"></span><span class="member-opt">VIP</span>
                                </label>
                            </div>
                            <div class="member-box-type member-times-limit clearfix">
                                <b class="member-type-cap">时间期限</b>
                                <label class="member-type-lab member-times focus" for="limit1" data-type="3">
                                    <input id="limit1" checked="checked" name="time" type="radio" />
                                    <span class="define-rad"></span><span class="member-opt">一年</span>
                                </label>
                                <label class="member-type-lab member-times" for="limit2" data-type="4">
                                    <input id="limit2" name="time" type="radio" />
                                    <span class="define-rad"></span><span class="member-opt">两年</span>
                                </label>
                            </div>
                            <div class="member-box-type clearfix">
                                <b class="member-type-cap">支付费用</b>
                                <strong class="member-fees">￥<span class="pay-money-num">1000</span></strong>
                            </div>
                            <div class="member-box-type member-payways clearfix">
                                <b class="member-type-cap">支付方式</b>
                                <label class="member-type-lab focus" for="way1">
                                    <input id="way1" checked="checked" name="ways" type="radio" />
                                    <span class="define-rad"></span>
                                    <img class="member-payways-img" src="img/weixin.png" />
                                    <span class="payways-cap">微信支付</span>
                                </label>
                                <label class="member-type-lab" for="way2">
                                    <input id="way2" name="ways" type="radio" />
                                    <span class="define-rad"></span>
                                    <img class="member-payways-img" src="img/zhifubao.png" />
                                    <span class="payways-cap">支付宝支付</span>
                                </label>
                            </div>
                        </div>
                        <div class="bottom-btn"><button class="test-btn fees-btn" type="button">缴费</button></div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(function(){
        $('.member-type-lab').click(function(event) {
            $(this).addClass('focus').siblings().removeClass('focus');
            $(this).children('input').prop('checked', true).siblings().children('input').prop('checked', false);
        });

        $('.member-types').click(function(event) {
            var $focus = $('.member-times-limit .focus');
            if($(this).data('type') == "1"){
                if($focus.data('type') == "3"){
                    $('.pay-money-num').html('1000');
                }else if($focus.data('type') == "4"){
                    $('.pay-money-num').html('2000');
                }
            }else{
                if($focus.data('type') == "3"){
                    $('.pay-money-num').html('3000');
                }else if($focus.data('type') == "4"){
                    $('.pay-money-num').html('6000');
                }
            }
        });

        $('.member-times').click(function(event) {
            var $focus = $('.member-type-differ .focus');
            if($(this).data('type') == "3"){
                if($focus.data('type') == "1"){
                    $('.pay-money-num').html('1000');
                }else if($focus.data('type') == "2"){
                    $('.pay-money-num').html('3000');
                }
            }else{
                if($focus.data('type') == "1"){
                    $('.pay-money-num').html('2000');
                }else if($focus.data('type') == "2"){
                    $('.pay-money-num').html('6000');
                }
            }
        });
    })
</script>
@endsection