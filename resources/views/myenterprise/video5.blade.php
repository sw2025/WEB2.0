@extends("layouts.ucenter")
@section("content")
    <style>
        .changeWeixin img{margin:0 auto;}
    </style>
    <div class="bg_v2">
        <div class="card-step works-step">
            <span class="green-circle">1</span>咨询申请<span class="card-step-cap">&gt;</span>
            <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
            <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
            <span class="green-circle">4</span>咨询管理<span class="card-step-cap">&gt;</span>
            <span class="green-circle">5</span>完成
        </div>
        <div class="invite-experts">
            <div class="invite-expert-tit">
                <i class="iconfont icon-shenhejujue"></i><span>已响应<b class="invite-counts">{{$selected}}</b>人</span>
            </div>

            <table class="invite-table">
                <input type="hidden" id="consult" name="consult" value="{{$consultId}}">
                @foreach($datas as $data)
                    <tr>
                        <td>咨询分类</td>
                        <td>{{$data->domain1.'/'.$data->domain2}}</td>
                    </tr>
                    <tr>
                        <td>咨询模式</td>
                        <td id="videoType">@if($data->videotype=="0")单人@else多人@endif</td>
                    </tr>
                    <tr>
                        <td>开始时间</td>
                        <td>{{$data->starttime}}</td>
                    </tr>
                    <tr>
                        <td>结束时间</td>
                        <td>{{$data->endtime}}</td>
                    </tr>

                    <tr>
                        <td>咨询描述</td>
                        <td>{{$data->brief}}</td>
                    </tr>
                    <tr>
                        <td>专家头像</td>
                        <td>
                            <ul class="selected-experts">
                                @foreach($selExperts as $selExpert)
                                    <li id="{{$selExpert->expertid}}" style="width:80px;float: left;padding-left: 30px"><a href="javascript:;" class="expert-wrapper"><img src="{{env('ImagePath').$selExpert->showimage}}" alt="" style="border: 1px solid #ccc;border-radius: 10px;"><span class="expert-name">{{$selExpert->expertname}}</span></a></li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="center-btn">
            <button type="button" class="test-btn">选择专家</button>
        </div>
    </div>
    <div class="pop-pay">
        <div class="payoff">
            <span class="pay-close" title="关闭"><i class="iconfont icon-chahao"></i></span>
            <div class="single">
                <div class="single-two">
                <span class="single-opt pay-opt" id="singlePay">
                    <input class="rad-inp" type="radio" style="width: 12%;">
                    <div class="opt-label normal "></div>
                </span>
                </div>
                <div class="cub" style="display:block"></div>
            </div>
            <div class="paytype payoff-way">
                    <span class="pay-opt focus been">
                        <input class="rad-inp" type="radio"  value="wx_pub_qr">
                        <div class="opt-label"><span></span><img class="way-img" src="{{asset('img/lweixin.png')}}"><em class="way-cap">微信支付</em></div>
                    </span>
                    <span class="pay-opt">
                        <input class="rad-inp" type="radio"  value="alipay_pc_direct">
                        <div class="opt-label"><span></span><img class="way-img" src="{{asset('img/lzhifubao.png')}}"><em class="way-cap">支付宝支付</em></div>
                    </span>
            </div>
            <div style="text-align: center;padding: 0 0 20px;"><button type="button" class="pop-btn vip" id="vip">付费</button></div>
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
    <script type="text/javascript">
        $(function(){
            $('.closePop').click(function () {
                $(this).closest('.layer-pop').hide();
                $('.pop-pay').hide();
                $(".test-btn").attr('disabled',false);
                $(".test-btn").html('选择专家');
            })
            var expertIds=new Array();
            if($.cookie("selected")){
                var selected=$.cookie("selected").split(',');
                for(var i=0;i<selected.length;i++){
                    var selectExpertId=selected[i].split('/');
                    $("#"+selectExpertId[0]).addClass('current');
                }
                expertIds=$.cookie("selected").split(',');
            }
            $('.closePop').click(function () {
                $(this).closest('.layer-pop').hide();
                $('.pop-pay').hide();
            })
            $('.selected-experts li').click(function(event) {
                var expertId=$(this).attr("id");
                var state=$(this).attr("state");
                var fee=$(this).attr("fee");
                if(state==1){
                    expertId=expertId+"/"+fee;
                }else{
                    fee="0";
                    expertId=expertId+"/"+fee;
                }
                var videoType=$("#videoType").text();
                if(videoType=="单人"){
                    videoTypePeople=1
                }else{
                    videoTypePeople=2;
                }
                if(expertIds.length!=videoTypePeople){
                    if(!$(this).hasClass("current")){
                        expertIds.push(expertId);
                    }else{
                        deleteArray(expertIds,expertId);
                    }
                }else{
                    if($.inArray(expertId,expertIds)>=0){
                        deleteArray(expertIds,expertId);
                    }else{
                        layer.confirm('您已经选定'+videoTypePeople+'位专家', {
                            btn: ['确定'] //按钮
                        });
                        return false;
                    }
                }
                $(this).toggleClass('current');
            });
            //删除已经选定的的专家
            var deleteArray=function (arr, val) {
                for(var i=0; i<arr.length; i++) {
                    if(arr[i] == val) {
                        arr.splice(i, 1);
                        break;
                    }
                }
            }
            //处理反选的专家
            $(".test-btn").on("click",function(){
                $(this).attr('disabled',true);
                $(this).html('正在处理');
                var consultId=$("#consult").val();
                var totalCount=0;
                var _that=this;
                var date = new Date();
                date.setTime(date.getTime() + (120 * 60 * 1000));
                $.cookie("selected",expertIds,{expires:date,path:'/',domain:'sw2025.com'});
                if(expertIds.length!=0){
                    $.ajax({
                        url:"{{asset('handleSelect')}}",
                        data:{"userId":$.cookie('userId'),"expertIds":expertIds,"consultId":consultId},
                        dateType:"json",
                        type:"POST",
                        success:function(res){
                            switch(res['code']){
                                case "noMoney":
                                    var str;
                                    str="专家费用：￥<b class='money'>"+res['money']+"</b>/元"
                                    pop(str);
                                break;
                                case "success":
                                    var date = new Date();
                                    date.setTime(date.getTime() + (120 * 60 * 1000));
                                    $.cookie("selected","",{expires:date,path:'/',domain:'sw2025.com'});
                                    window.location.reload();
                                break;
                                case "error":
                                    layer.msg("网络异常");
                                    $(_that).attr('disabled',false);
                                    $(_that).html('选择专家');
                                break;
                            }
                        }
                    })
                }else{
                    layer.confirm('请您至少选定1位专家', {
                        btn: ['确定'] //按钮
                    });
                    $(_that).attr('disabled',false);
                    $(_that).html('选择专家');
                    return false;
                }
            })
            $("#vip").on("click",function(){
                var payType="payExpertMoney";
                var channel;
                var amount;
                var urlType=window.location.href;
                amounts=$(".money").text();
                amount=amounts*100;
                $(".payoff-way").children().each(function(){
                    if($(this).hasClass('been')){
                        channel=$(this).children(":first").attr("value");
                    }
                });
                var consultId=$("#consult").val();
                $.ajax({
                    url:"{{url('charge')}}",
                    data:{"payType":payType,"channel":channel,"amount":amount,"type":"consult","consultid":consultId,"expert":expertIds,"urlType":urlType,"chargeFrom":"PC"},
                    dateType:"json",
                    type:"POST",
                    success:function(res){
                        var charge =JSON.parse(res);
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
        })
    </script>
@endsection
