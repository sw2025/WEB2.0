@extends("layouts.master")
@section("content")
<script type="text/javascript" src="{{asset('js/reply.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/details.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />
<style>
    textarea{
        border:none;
    }

    .textareaspan{
        width:99%;
        font-size: 14px;
    }
    #selectexpert{
        float: right;
        border: 1px solid #000;
        padding: 4px;
        background: #fff;
        border-radius: 5px;
    }
    #selectexpert:hover{
        background: #3daff3;
        color: #fff;
    }
</style>
<div class="container section">
    <div class="row clearfix">
        <div class="main-content col-md-8">
            <div class="details-top clearfix">
                <div class="details-bg">
                    <span class="blue-circle"><i class="iconfont icon-jianjie1"></i></span>
                    <span class="details-ch-tit">企业信息</span>
                </div>
                <span class="details-en-tit">THE EXPERT INFORMATION</span>
            </div>
            <div class="exp-details-con">
                <div class="exp-det-con-top">
                    <img src="@if(empty($datas->showimage)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$datas->showimage}}@endif" class="exp-details-img" />
                    <div class="exp-details-brief">
                        <span class="exp-details-name"><i class="iconfont icon-iconfonticon"></i>{{$datas->enterprisename}}</span>
                        <a href="javascript:;" index="{{$datas->enterpriseid}}" class="collect-state @if(in_array($datas->enterpriseid,$collectids)) done @endif">@if(in_array($datas->enterpriseid,$collectids))已收藏 @else 收藏 @endif</a>
                        <span class="exp-details-video">所在行业：<em>{{$datas->industry}}</em></span>
                        <span class="exp-details-best">所在地区：<em>{{$datas->address}}</em></span>

                    </div>
                </div>
                <div class="details-abs">
                    <div class="details-abs-tit">
                        <div class="details-graph"><span class="square"></span></div>
                        <span class="details-tit-cap">企业介绍</span>
                    </div>
                    <textarea id="textarea" class="details-abs-desc" readonly>{{$datas->brief}}</textarea><a name="reply"></a>
                </div>
            </div>
            <div class="details-top clearfix">
                <div class="details-bg">
                    <span class="blue-circle"><i class="iconfont icon-liuyan"></i></span>
                    <span class="details-ch-tit">我的留言</span>
                </div>
                <span class="details-en-tit">COMMENT THREADST</span>
            </div>
            <div class="details-message">
                <!-- 新增代码/start -->

                <!-- 新增代码/end -->
                <form action="">
                    <div class="message-write">
                        <textarea name="content" id="{{$datas->enterpriseid}}" cols="30" rows="10" class="message-txt" placeholder="请输入留言"></textarea>
                        <div class="message-btn"><button class="submit" type="button">提交</button></div>
                    </div>
                </form>
                <div class="message-list">
                    <div class="details-abs-tit">
                        <div class="details-graph forth"><span class="square"></span></div>
                        <span class="details-tit-cap forth-cap">留言列表</span>
                    </div>
                    <div class="all-replys">
                        @foreach($message as $v)
                            @if(!$v->parentid)
                                <div class="mes-list-box clearfix">
                                    <div class="floor-host">
                                        <img src="@if(empty($v->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->avatar}}@endif" class="floor-host-ava" />
                                        <div class="floor-host-desc">
                                            <a href="javascript:;" class="floor-host-name">{{$v->nickname or substr_replace($v->phone,'****',3,4)}} [{{$v->expertname or $v->enterprisename}}]</a><span class="floor-host-time">{{$v->messagetime}}</span>
                                            <span class="floor-host-words">{{$v->content}}</span>
                                        </div>
                                    </div>
                                    <div class="message-reply-show">
                                        <a href="javascript:;" class="look-reply">查看回复（@if(key_exists($v->id,$msgcount)){{$msgcount[$v->id]}}@else 0 @endif）</a>
                                        <a href="javascript:;" class="message-reply">回复</a>
                                    </div>
                                    <div class="reply-list">
                                        <ul class="reply-list-ul">
                                            @foreach($message as $reply)
                                                @if(!$reply->use_userid && $reply->parentid == $v->id)
                                                    <li>
                                                        <img src="@if(empty($reply->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$reply->avatar}}@endif" class="floor-guest-ava" />
                                                        <div class="gloor-guest-cnt">
                                                            <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->expertname or $reply->enterprisename}}]</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn" userid="{{$reply->userid}}">回复</a>
                                                        </div>
                                                    </li>
                                                @elseif($reply->parentid == $v->id)

                                                    <li>
                                                        <img src="@if(empty($reply->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$reply->avatar}}@endif" class="floor-guest-ava" />
                                                        <div class="gloor-guest-cnt">
                                                            <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->expertname or $reply->enterprisename}}]</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">{{$reply->nickname2 or substr_replace($reply->phone2,'****',3,4)}}</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" userid="{{$reply->userid}}" class="reply-btn">回复</a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="reply-box">
                                            <textarea class="reply-enter" index="{{$v->enterpriseid}}" id="{{$v->id}}"  ></textarea>
                                            <div class="publish-box"><button class="publish-btn" type="button">发表</button></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 det-aside">
            <div class="aside-top">
                <span class="aside-top-icon"><i class="iconfont icon-tuijian"></i></span>
                <span class="width2"></span>
                <span class="aside-top-tit">推荐相关行业企业</span>
            </div>
            <ul class="exp-recom-list">
                @foreach($recommendNeed as $v)
                <li>
                    <a href="{{url('expert/detail',$v->enterpriseid)}}" class="exp-rec-link">
                            <span class="exp-rec-left">
                                <img class="exp-rec-img" src="{{env('ImagePath').$v->showimage}}">
                                <em class="rec-exp-name">{{$v->enterprisename}}</em>
                            </span>
                        <div class="exp-rec-right">
                            <span class="exp-rec-video"><i class="iconfont icon-shipin"></i>所在行业：<em>{{$v->industry}}</em></span>
                            <span class="exp-rec-best"><i class="iconfont icon-shanchang"></i>所在地区：<em>{{$v->address}}</em></span>

                            <p class="exp-rec-brief">
                                {{$v->brief}}
                            </p>
                        </div>
                    </a>
                    <div class="exp-rec-icon">
                        <a href="{{url('expert/detail',$v->enterpriseid)}}#reply" class="review" title="发起办事"><i class="iconfont icon-pinglun1"></i></a>
                        <a href="javascript:;" class="collect @if(in_array($v->enterpriseid,$collectids)) red @endif" index="{{$v->enterpriseid}}" title="@if(in_array($v->enterpriseid,$collectids)) 已收藏 @else 收藏 @endif"><i class="iconfont icon-likeo"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
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
        <div class="single open-member">
            <div class="single-opt pay-opt been">
                <input class="rad-inp" type="radio">
                <div class="opt-label dibs"><span></span>开通会员</div>
                <span class="open-right">会员权益</span>
            </div>
            <div class="years">
                @foreach($memberrights as $memberright)
                    <span class="pay-opt" memberId="{{$memberright->memberid}}">
                        <input class="rad-inp" type="radio" >
                        <div class="opt-label"><span></span>{{$memberright->termtime}}年&nbsp;&nbsp;￥{{$memberright->cost}}<em class="benifit">优惠次数 {{$memberright->eventcounts}} 次</em><em class="benifit">优惠时间 {{$memberright->consultcounts}} 分钟</em></div>
                    </span>
                @endforeach
            </div>

            <div class="cub"></div>
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
<script src="{{url('js/enterpriseres.js')}}" type="text/javascript"></script>
<script src="{{url('js/textareaauto.js')}}" type="text/javascript"></script>
<script>
        $(function(){
            //*********** 新增页面js/start ***********//
            $('.publ-need-sel-def').click(function (e) {
                e.stopPropagation();
                $(this).next('ul').stop().slideToggle();
            });
            $('.publish-need-list li').hover(function() {
                $(this).children('ul').stop().show();
            }, function() {
                $(this).children('ul').stop().hide();
            });

            $('.publ-sub-list li').click(function (e) {
                e.stopPropagation();
                var publishHtml = $(this).html();
                var parentname=$(this).parent().siblings().html();
                //$(this).parent().prev('a').html(parentname+'/'+publishHtml);
                $('.publ-need-sel-def').html(parentname+'/'+publishHtml);
                $('.publish-need-list').hide();
            });
            $(document).click(function(event) {
                $('.publish-need-list').hide();
            });
            //*********** 新增页面js/end ***********//

        })

        /*$('.details-message .submit').on('click',function () {
            var that = $(this);
            var textarea = $(this).parent().siblings('textarea');
            var expertIds = textarea.attr('id');
            var describe = textarea.val();
            var isAppoint = 1;
            var domain = $.trim($('#message').text());
            $(this).attr('disabled',"true");
            if($.trim($('#message').text()) == '请选择'){
                layer.msg('请选择办事问题分类',{'icon':0});
                that.attr('disabled',false);
                return false;
            }

            if(30 > describe.length || describe.length>500){
                layer.msg('请输入办事描述内容且文字范围限制在30-500字');
                that.attr('disabled',false);
                return false;
            }

            $.ajax({
                url:"{{asset('eventCharge')}}",
                data:{"domain":domain,"describe":describe,"isAppoint":isAppoint,"expertIds":expertIds,"state":0},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var date = new Date();
                    date.setTime(date.getTime() + (120 * 60 * 1000));
                    if(res['icon'] == 1){
                        layer.msg(res.msg,{'icon':6},function () {
                            window.location = '{{url('uct_works')}}';
                        });

                    }else if(res['icon'] == 2){
                        layer.alert(res.msg+' 申请失败,请重新申请', {
                            btn: ['确定'] //按钮
                        },function () {
                            window.location.href=window.location.href;
                        });
                    }else if(res['icon'] == 0){
                        layer.confirm(res.msg, {
                            btn: ['确定','取消'] ,
                            skin: 'layer-ext-moon',
                            icon:0,
                        }, function(index){
                            window.location = res.url;
                            return false;
                        }, function(index){
                            $(that).attr('disabled',false);
                            $(that).html('请专家办事');
                            layer.close(index);
                        });
                    }  else if(res['icon'] == 3){
                        layer.confirm(res.msg, {
                            btn: ['确定','取消'] ,
                            skin: 'layer-ext-moon',
                            icon:0,
                        }, function(index){
                            var str;
                            if(res['code']==6){
                                str="<span></span>单次缴费：￥<b class='money'>{{env('EventMemberMoney')}}</b>/ 次 &nbsp;&nbsp;&nbsp;&nbsp;充值次数 <input type='number' class='re-counts times'  min='1' style='border: 1px solid #ccc;padding-left: 10px;box-sizing:border-box;width: 140px;'>"
                            }else{
                                str="<span></span>单次缴费：￥<b class='money'>{{env('EventMoney')}}</b>/ 次";
                            }
                            pop(str);
                            layer.close(index);
                        }, function(index){
                            $(that).attr('disabled',false);
                            $(that).html('请专家办事');
                            layer.close(index);
                        });
                    }
                }
            })
        });*/

    /**
     * Created by admin on 2017/9/24.
     */
    function selectexpertjoinevent(obj){
        if(!$.cookie('userId')){
            layer.confirm('您还未登陆是否去登陆？', {
                btn: ['去登陆','暂不需要'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href='/login';
            }, function(){
                layer.close();
            });
            return false;
        }
        if(obj != null){
            var str = '<div style="padding:10px;">系统会自动在创建办事/视频咨询的过程中将您的问题分类和需求自动填充到新建办事/视频咨询中，可进行修改后完成邀请专家。是否继续？<p style=color:red;font-size:12px;>提示：请您确保您的身份是升维网认证企业，且在后续创建办事或者咨询时会产生相关费用。请做好相关准备<p></div>';
        }else{
            var str = '<div style="padding:10px;">系统会自动选定当前专家作为您的自选专家请后续补充相关的领域和办事/视频咨询描述。<p style=color:red;font-size:12px;>提示：请您确保您的身份是升维网认证企业，且在后续创建办事或者咨询时会产生相关费用。请做好相关准备<p></div>';
        }
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['400px', '210px'],
            shadeClose: false, //开启遮罩关闭
            title:'新建[办事/视频咨询]提醒',
            content: str,
            btn: ['邀请办事','邀请视频咨询','取消'],
            yes: function(index, layero){
                $.cookie("isAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("reselect",'{{$datas->enterpriseid.$datas->showimage}}',{path:'/',domain:'sw2025.com'});
                if(obj != null){
                    var ss = $(obj).val().split(/【(.*)】/i);
                    $.cookie("domain",ss[1],{path:'/',domain:'sw2025.com'});
                    $.cookie("describe", $.trim(ss[2]),{path:'/',domain:'sw2025.com'});
                }
                window.location.href="{{url('uct_works/applyWork')}}";
            },btn2: function(index, layero){
                $.cookie("videoisAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("videoreselect",'{{$datas->enterpriseid.$datas->showimage}}',{path:'/',domain:'sw2025.com'});
                if(obj != null){
                    var ss = $(obj).val().split(/【(.*)】/i);
                    $.cookie("videodomain",ss[1],{path:'/',domain:'sw2025.com'});
                    $.cookie("videodescribe", $.trim(ss[2]),{path:'/',domain:'sw2025.com'});
                }
                window.location.href="{{url('/uct_video/applyVideo')}}";
            },btn3: function (index, layero){
                layer.close(index);
            }
        });
    }

    $(function () {
        /* $.each($("textarea"), function(i, n){
         autoTextarea($(n)[0]);
         });*/
        $('.textareaspan').each(function () {
            autoTextarea($(this)[0]);
        });

    })
    var autoTextarea = function (elem, extra, maxHeight) {
        extra = extra || 0;
        var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
                isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
                addEvent = function (type, callback) {
                    elem.addEventListener ?
                            elem.addEventListener(type, callback, false) :
                            elem.attachEvent('on' + type, callback);
                },
                getStyle = elem.currentStyle ?
                        function (name) {
                            var val = elem.currentStyle[name];
                            if (name === 'height' && val.search(/px/i) !== 1) {
                                var rect = elem.getBoundingClientRect();
                                return rect.bottom - rect.top -
                                        parseFloat(getStyle('paddingTop')) -
                                        parseFloat(getStyle('paddingBottom')) + 'px';
                            };
                            return val;
                        } : function (name) {
                    return getComputedStyle(elem, null)[name];
                },
                minHeight = parseFloat(getStyle('height'));
        elem.style.resize = 'none';//如果不希望使用者可以自由的伸展textarea的高宽可以设置其他值

        var change = function () {
            var scrollTop, height,
                    padding = 0,
                    style = elem.style;

            if (elem._length === elem.value.length) return;
            elem._length = elem.value.length;

            if (!isFirefox && !isOpera) {
                padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
            };
            scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

            elem.style.height = minHeight + 'px';
            if (elem.scrollHeight > minHeight) {
                if (maxHeight && elem.scrollHeight > maxHeight) {
                    height = maxHeight - padding;
                    style.overflowY = 'auto';
                } else {
                    height = elem.scrollHeight - padding;
                    style.overflowY = 'hidden';
                };
                style.height = height + extra + 'px';
                scrollTop += parseInt(style.height) - elem.currHeight;
                document.body.scrollTop = scrollTop;
                document.documentElement.scrollTop = scrollTop;
                elem.currHeight = parseInt(style.height);
            };
        };

        addEvent('propertychange', change);
        addEvent('input', change);
        addEvent('focus', change);
        change();
    };


        $("#vip").on("click",function(){
            var payType;
            var memberId;
            var channel;
            var amount;
            var eventCount;
            var urlType=window.location.href;
            var res=$("#singlePay").hasClass("been");
            if(res){
                payType="payMoney";
                var money=$("#singlePay").find(".money:first").text();
                if(money=="{{env('EventMoney')}}"){
                    eventCount=1;
                    amount=money;
                }else{
                    eventCount=$("#singlePay").find(".times").val();
                    if(eventCount<1){
                        alert("请填写充值次数");
                        return false;
                    }
                    amount=money*eventCount;
                }
                memberId=0;
            }else{
                payType="member";
                $(".years").children().each(function(){
                    if($(this).hasClass('juniorbe')){
                        memberId=$(this).attr("memberId");
                    }
                })
                amount=0;
                eventCount=0;
            }
            $(".payoff-way").children().each(function(){
                if($(this).hasClass('been')){
                    channel=$(this).children(":first").attr("value");
                }
            });
            $.ajax({
                url:"{{url('charge')}}",
                data:{"payType":payType,"memberId":memberId,"channel":channel,"amount":amount,"type":"event","eventCount":eventCount,"urlType":urlType},
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