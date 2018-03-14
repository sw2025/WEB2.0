@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/selectExpert.css')}}">
    <script type="text/javascript" src="{{asset('js/select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/myexpert.js')}}"></script>

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
            background: #e25633;
            color: #fff;
        }
    </style>

    <div class="swcontainer sw-ucenter">

    <div class="container section" style="padding-top: 0px;margin-top: 0px;" >
        <div class="row clearfix">
            <div class="main-content col-md-8">
                <div class="details-top clearfix">
                    <div class="details-bg">
                        <span class="blue-circle"><i class="iconfont icon-jianjie1"></i></span>
                        <span class="details-ch-tit">专家信息</span>
                    </div>
                    <span class="details-en-tit">THE EXPERT INFORMATION</span>
                </div>
                <div class="exp-details-con">
                    <div class="exp-det-con-top">
                        <button id="selectexpert" style="font-size: 15px;" name="{{$datas->expertname or ''}}"  key="{{$datas->expertid or ''}}"  img="{{$datas->showimage or ''}}" fee="{{$datas->fee or ''}}" linefee="{{$datas->linefee or ''}}">发起约见</button>

                        <img src="@if(empty($datas->showimage)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$datas->showimage}}@endif" class="exp-details-img" />
                        <div class="exp-details-brief">
                            <span class="exp-details-name"><i class="iconfont icon-iconfonticon"></i>{{$datas->expertname}}</span>
                            <br/>
{{--
                            <a href="javascript:;" index="{{$datas->expertid}}" class="collect-state @if(in_array($datas->expertid,$collectids)) done @endif">@if(in_array($datas->expertid,$collectids))已收藏 @else 收藏 @endif</a>
--}}
                           {{-- <span class="exp-details-categary">分<b class="wem2"></b>类：<em>{{$datas->category}}</em></span>
--}}
                            @if($datas->islinemeet==1)
                                <span class="exp-list-video"><i class="iconfont icon-shipin"></i>线下约谈:￥{{$datas->linefee}}/小时
                             @else
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>线下约谈:未开启
                             @endif

                            @if($datas->isonlinemeet==1)
                                  <i class="iconfont icon-shipin"></i>线上约谈:￥{{$datas->fee}}/分钟</span>
                             @else
                                  <i class="iconfont icon-shipin"></i>线上约谈:未开启</span>
                            @endif
                            <span class="exp-details-time">入驻时间：<em>{{$datas->created_at}}</em></span>

                            <span class="exp-details-best">擅长领域：<em>{{$domainselect[$datas->domain1]}}</em></span>
                            <div class="exp-details-lab">
                                @foreach(explode(',',$datas->domain2) as $do2)
                                    <span class="exp-lab-a">&nbsp;{{$do2}}&nbsp;</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="details-abs">
                        <div class="details-abs-tit">
                            <div class="details-graph"><span class="square"></span></div>
                            <span class="details-tit-cap">专家介绍</span>
                        </div>
                        <textarea id="textarea" style="overflow-y: auto;" class="details-abs-desc" readonly>{{$datas->brief}}</textarea><a name="reply"></a>
                    </div>
                </div>
                <div class="details-top clearfix">
                    <div class="details-bg">
                        <span class="blue-circle"><i class="iconfont icon-liuyan"></i></span>
                        <span class="details-ch-tit">@if(!$isexpert)发布留言@else 我的办事 @endif</span>
                    </div>
                    <span class="details-en-tit">APPLY EVENT</span>
                </div>
                <div class="details-message">
                    <!-- 新增代码/start -->

                        <form action="">
                            <div class="message-write">
                                <textarea name="content" id="{{$datas->expertid}}" cols="30" rows="10" class="message-txt" placeholder="请输入给投资人的留言信息（10-500字）"></textarea>
                                <div class="message-btn"><button class="submit" type="button">留言</button></div>
                            </div>
                        </form>
                        <div class="message-list">
                            <div class="details-abs-tit">
                                <div class="details-graph forth"><span class="square"></span></div>
                                <span class="details-tit-cap forth-cap">留言信息</span>
                            </div>
                            <div class="all-replys">
                            @foreach($message as $v)
                                    @if(!$v->parentid)
                                        <div class="mes-list-box clearfix">
                                            <div class="floor-host">
                                                <img src="@if(empty($v->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->avatar}}@endif" class="floor-host-ava" />
                                                <div class="floor-host-desc">
                                                    <a href="javascript:;" class="floor-host-name">{{$v->nickname or substr_replace($v->phone,'****',3,4)}} [{{$v->enterprisename or $v->expertname}}]</a><span class="floor-host-time">{{$v->messagetime}}</span>
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
                                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->enterprisename or $reply->expertname}}]</a>
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
                                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->enterprisename or $reply->expertname}}]</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">{{$reply->nickname2 or substr_replace($reply->phone2,'****',3,4)}}</a>
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
                                                    <textarea class="reply-enter"  id="{{$v->expertid}}"></textarea>
                                                    <div class="publish-box"><button class="submit" messageid="{{$v->id}}" type="button">发表</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>


    </div>
    <script src="{{url('js/expert.js')}}" type="text/javascript"></script>
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

        $('.submit').on('click',function () {
            var that = $(this);
            var textarea = $(this).parent().siblings('textarea');
            var expertId = textarea.attr('id');
            var describe = textarea.val();
            var messageid = $(this).attr('messageid');

            if(messageid==undefined){
                messageid = 0;
            }
            $(this).attr('disabled',"true");
            if(10 > describe.length || describe.length>500){
                layer.msg('请输入留言内容且文字范围限制在10-500字');
                that.attr('disabled',false);
                return false;
            }
            $.ajax({
                url:"{{asset('message')}}",
                data:{"describe":describe,"expertId":expertId,"state":0,'messageid':messageid},
                dateType:"json",
                type:"POST",
                success:function(res){

                    if(res.state==1){
                        layer.msg('发布成功',{'icon':1,'time':1000},function () {
                            window.location =  window.location.href;
                        });
                    } else {
                        layer.msg('发布错误',{'icon':3,'time':1000},function () {
                            window.location = window.location.href;
                        });
                    }
                }

            })
        });

    /**
     * Created by admin on 2017/9/24.
     */
    $('#selectexpert').on('click',function () {
        var name=$(this).attr("name");
        var linefee=$(this).attr("linefee");
        var fee=$(this).attr("fee");
        var key=$(this).attr("id");
        var img=$(this).attr("img");
        var value=key+'@'+img+'@'+name+'@'+linefee+'@'+fee;
        var date = new Date();
        date.setTime(date.getTime() + (120 * 60 * 1000));
        if($.cookie("reselect")){
            reselect=$.cookie('reselect').split(",");
        }else{
            reselect=[];
            $.cookie("reselect",reselect,{expires:date,path:'/',domain:'sw2025.com'});
            $.cookie("reselect",reselect,{expires:date,path:'/',domain:'swchina.com'});
        }
        reselect.push(value);
        $.cookie("reselect",reselect.join(','),{expires:date,path:'/',domain:'sw2025.com'});
        $.cookie("reselect",reselect.join(','),{expires:date,path:'/',domain:'swchina.com'});

        window.location.href="{{url('meetIndex')}}";
    });

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