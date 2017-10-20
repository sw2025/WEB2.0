@extends("layouts.ucenter")
@section("content")
    <style>
        .changeWeixin img{margin:0 auto;}
    </style>
    <div class="main">
        <h3 class="main-top">开通会员</h3>
            <!-- 充值 / start -->
        <div class="ucenter-con">
            <div class="main-right">
                <div class="recharge-sum open-member-add">
                    @foreach($memberrights as $k => $memberright)
                        <span class="recharge-opt member  @if($memberright->memberid==2) focus @endif"  memberId="{{$memberright->memberid}}" >
                            <input class="rad-inp"  checked="true" type="radio" id="rad{{$k}}" name="money">
                            <label for="rad{{$k}}" class="recharge-radio"><span></span>{{$memberright->typename}}</label>
                            <span class="caption-tip">￥{{$memberright->cost}}</span>
                            <span class="hui-time">优惠次数 {{$memberright->eventcounts}}次</span>
                            <span class="hui-count">优惠时间 {{$memberright->consultcounts}}分钟</span>
                        </span>
                    @endforeach
                </div>
                <div class="recharge-way about-border">
                    <span class="recharge-opt channel focus" value="wx_pub_qr">
                        <input class="rad-inp" checked="true" type="radio" id="way1" name="ways">
                        <label for="way1" class="recharge-radio"><span></span><img class="way-img" src="{{asset('img/weixin.png')}}"><em class="way-cap">微信支付</em></label>
                    </span>
                    <span class="recharge-opt channel" value="alipay_pc_direct">
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
    <div class="layer-pop" style="position:fixed;background: rgba(0,0,0,0.3);top: 0;left: 0;width: 100%;height: 100%;z-index: 1000;display: none;">
        <div class="popWx" style="position: absolute;top: 10%;width: 285px;border: 2px solid #ccc;left: 50%;top: 50%;margin: -160px 0 0 -145px;background: #fff;text-align: center;border-radius: 3px;font-size: 14px;padding: 30px 0 27px;">
            <div class="changeWeixin">
                <div class="popWeixin" id="code">
                </div>
            </div>
            <span class="weixinLittle"></span>
            <div class="weixinTips" style="display: none"><strong>扫瞄二维码完成支付</strong><br>支付完成后请关闭二维码</div>
            <a href="javascript:;" class="closePop" title="关闭" style="position: absolute;top: 0;right: 0;"><i class="iconfont icon-chahao"></i></a>
        </div>
    </div>
    <script type="text/javascript" src="{{url('/js/jquery.qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/pingpp.js')}}"></script>
    <script>
        $('.closePop').click(function () {
            $(this).closest('.layer-pop').hide();
        })
        $(".recharge-submit").on("click",function(){
            var memberId;
            var channel;
            var payType="member"
            var urlType="https://www.sw2025.com/uct_recharge";
            $(".member").each(function(){
                if($(this).hasClass('focus')){
                    memberId=$(this).attr("memberId");
                }
            })
            $(".channel").each(function(){
                if($(this).hasClass('focus')){
                    channel=$(this).attr("value");
                }
            })
            $.ajax({
              url:"{{url('charge')}}",
              data:{"payType":payType,"memberId":memberId,"channel":channel,"urlType":urlType},
              dateType:"json",
              type:"POST",
              success:function(res){
                  var charge =JSON.parse(res);
                  console.log(charge);
                  $('#code').empty();
                  if(charge.credential.wx_pub_qr){
                      var qrcode = new QRCode('code', {
                          text: charge.credential.wx_pub_qr,
                          width: 200,
                          height: 200,
                          colorDark : '#000000',
                          colorLight : '#ffffff',
                          correctLevel : QRCode.CorrectLevel.H
                      });
                      console.log(qrcode);
                      if(channel=="wx_pub_qr"){
                          $('.poplayer').show();
                          $('.layer-pop').show();
                          $(".weixinTips").show();
                      }
                      return;
                  }
                  pingpp.createPayment(charge, function(result, err){
                      // console.log(result);
                      // console.log(err.msg);
                      // console.log(err.extra);
                      if (result == "success") {
                          // 只有微信公众账号 wx_pub 支付成功的结果会在这里返回，其他的支付结果都会跳转到 extra 中对应的 URL。
                      } else if (result == "fail") {
                          // charge 不正确或者微信公众账号支付失败时会在此处返回
                      } else if (result == "cancel") {
                          // 微信公众账号支付取消支付
                      }
                  });
              }
          })

        })
    </script>
@endsection