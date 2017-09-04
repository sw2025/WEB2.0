@extends("layouts.ucenter4")
@section("content")
        <div class="main">
            <h3 class="main-top">充值金额</h3>
            <!-- 充值 / start -->
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="recharge-sum">
                            <span class="recharge-opt focus">
                                <input class="rad-inp" checked="true" type="radio" id="rad1" name="money">
                                <label for="rad1" class="recharge-radio"><span></span>￥1000</label>
                            </span>
                            <span class="recharge-opt">
                                <input class="rad-inp" type="radio" id="rad2" name="money">
                                <label for="rad2" class="recharge-radio"><span></span>￥2000</label>
                            </span>
                            <span class="recharge-opt">
                                <input class="rad-inp" type="radio" id="rad3" name="money">
                                <label for="rad3" class="recharge-radio"><span></span>￥5000</label>
                            </span>
                            <span class="recharge-opt others">
                                <input class="rad-inp" type="radio" id="rad4" name="money">
                                <label for="rad4" class="recharge-radio"><span></span>其他金额</label><input type="text" placeholder="请输入金额" readonly="" class="recharge-inp-sum">
                            </span>
                    </div>
                    <div class="recharge-way">
                            <span class="recharge-opt focus">
                                <input class="rad-inp" checked="true" type="radio" id="way1" name="ways">
                                <label for="way1" class="recharge-radio"><span></span><img class="way-img" src="{{asset('img/weixin.png')}}"><em class="way-cap">微信支付</em></label>
                            </span>
                            <span class="recharge-opt">
                                <input class="rad-inp" type="radio" id="way2" name="ways">
                                <label for="way2" class="recharge-radio"><span></span><img class="way-img" src="{{asset('img/zhifubao.png')}}"><em class="way-cap">支付宝支付</em></label>
                            </span>
                    </div>
                    <div class="recharge-btn-box">
                        <button class="test-btn recharge-submit" type="button">充值</button>
                    </div>
                </div>
            </div>
        </div>
@endsection