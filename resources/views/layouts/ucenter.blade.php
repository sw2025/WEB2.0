<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Keywords" content="2025,升维网,升维,对接资源,转型升级,投融资,企业服务,管理咨询">
    <meta name="description" content="升维网是一个为广大中小型企业与外部专家资源对接提供服务的大型平台。这里汇聚了国际国内大量优秀的专家和资源，通过升维网平台，企业可以向行业专家咨询在经营过程中遇到的相关问题，专家为企业提供最专业的指导服务。"/>
    <meta name="author" content="www.sw2025.com">
    <title>升维网-企业对接高端资源的平台</title>
    <link rel="stylesheet" type="text/css" href="{{asset('iconfont/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/global.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/list.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/workmanage.css')}}" />
    <!-- js / start -->
    <script src="{{asset('im/3rd/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/public.js')}}"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('js/utils/html5shiv.js?1401441990')}}"></script>
    <script type="text/javascript" src="{{asset('js/utils/respond.min.js?1401441990')}}"></script>
    <![endif]-->
</head>
<body>
<!-- 公共header / start -->
<div class="header">
    <div class="container clearfix">
        <div class="navbar-header clearfix">
            <a href="{{asset('/')}}" class="navbar-brand navbar-link">
                <img src="{{asset('img/logo.png')}}" alt="首页">
            </a>
            <button class="navbar-toggle"><i class="iconfont icon-daohang"></i></button>
        </div>
        <div class="bars">
            <!-- 未登录 -->
                <span class="before-login" style="display:none;">
                    <a href="javascript:;" class="register header-link"><i class="iconfont icon-bianji"></i>注册</a>
                    <a href="javascript:;" class="login header-link"><i class="iconfont icon-suo"></i>登录</a>
                </span>
            <!-- 登录后 -->
                <span class="after-login" style="display:block;">
                    <a href="javascript:;" class="quit header-link">退出</a>
                    <a href="javascript:;" id="toCenter" class="log-username header-link"><i class="iconfont icon-touxiang"></i></a>
                </span>
            <div class="searchbar">
                <a href="javascript:;" class="search-cli"><i class="iconfont icon-sousuo"></i></a>
                <div class="search-sear">
                    <form name="">
                        <div class="select-box">
                            <div class="select-showbox"><span id="select-type"></span><i class="iconfont icon-xiangxiajiantou"></i></div>
                            <ul class="select-option">
                                <li>搜专家</li>
                                <li>搜需求</li>
                            </ul>
                        </div>
                        <input class="search-text" name="keyboard" placeholder="请输入关键字">
                        <span class="search-bar"><button type="button" class="search-btn"><i class="iconfont icon-sousuo"></i></button></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="navbar-nav clearfix">
            <ul class="nav">
                <li id="index"><a href="{{asset('/')}}">首页</a></li>
                <li id="service" ><a href="{{asset('service')}}">服务介绍</a></li>
                <li id="expert" ><a href="{{asset('expert')}}">专家资源</a></li>
                <li id="supply" ><a href="{{asset('supply')}}">需求信息</a></li>
                <li id="us" ><a href="{{asset('us')}}">关于我们</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 公共header / end -->
<div class="ucenter v-work-manage">
    <div class="wrap clearfix">
        <!-- 侧边栏公共部分/start -->
        <div class="v-aside">
            <a href="{{asset('uct_member')}}" class="goto-renzh v-personal" title="去认证"><img  class="v-avatar" /><i class="iconfont icon-vip havevip" title="已认证"></i><i class="iconfont icon-vip novip" title="未认证"></i></a>
            <a href="{{asset('uct_basic')}}" class="v-personal" title="个人中心">
                <span class="v-nick"></span>
            </a>
            <!-- 我是企业时 -->
            <div class="v-money-info ">
                <a href="{{asset('uct_recharge')}}" class="v-money" title="充值提现"><i class="iconfont icon-chongzhihetixian"></i></a>
                <a href="{{asset('uct_myinfo')}}" class="v-info" title="我的消息"><i class="iconfont icon-xiaoxi"></i><span class="v-new-info-tip"></span></a>
            </div>
          {{--  <!-- 我是专家时 -->
            <div class="v-money-info iamexpert">
                <a href="{{asset('uct_recharge')}}" class="v-money" title="充值提现"><i class="iconfont icon-chongzhihetixian"></i></a>
                <a href="{{asset('uct_standard')}}" class="v-info border2" title=""><i class="iconfont icon-shenjia"></i></a>
                <a href="{{asset('uct_myinfo')}}" class="v-info" title="我的消息"><i class="iconfont icon-xiaoxi"></i><span class="v-new-info-tip"></span></a>
            </div>--}}
            <div class="v-identity">
                <div class="v-identity-sel">
                    <a href="javascript:;" class="v-identity-default"><span class="v-identity-cap">我是企业</span></a>
                    <ul class="v-identity-list">
                        <li class="active">我是企业</li>
                        <li>我是专家</li>
                    </ul>
                    <div class="v-ucenter-nav">
                        <div class="v-ucenter-nav-list v-default">
                            <a id="uct_works" href="{{asset('uct_works')}}" class="v-ucenter-nav-item ">
                                <img src="{{asset('img/vicon01.png')}}" alt="办事管理" />
                                办事管理
                            </a>
                            <a id="uct_video" href="{{asset('uct_video')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon02.png')}}" alt="视频会议" />
                                视频会议
                            </a>
                            <a id="uct_resource" href="{{asset('uct_resource')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon03.png')}}" alt="专家资源" />
                                专家资源
                            </a>
                            <a id="uct_myneed" href="{{asset('uct_myneed')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon04.png')}}" alt="需求信息" />
                                需求信息
                            </a>
                        </div>
                        <div class="v-ucenter-nav-list">
                            <a id="uct_mywork" href="{{asset('uct_mywork')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon02.png')}}" alt="我的办事" />
                                我的办事
                            </a>
                            <a id="uct_myask" href="{{asset('uct_myask')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon03.png')}}" alt="我的咨询" />
                                我的咨询
                            </a>
                            <a id="uct_myneed" href="{{asset('uct_myneed')}}" class="v-ucenter-nav-item">
                                <img src="{{asset('img/vicon04.png')}}" alt="需求信息" />
                                需求信息
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 侧边栏公共部分/end -->
        <!-- 企业办事服务 / start -->
        <div class="vmain">
            @yield("content")
        </div>
        <!-- 企业办事服务 / start -->
    </div>
</div>
<!-- 企业办事服务 / end -->
<!-- 公共footer / end -->
<div class="footer">
    <div class="container clearfix">
        <!-- <div class="row"> -->
        <div class="col-md-6 two-pic">
            <!-- <div class="container-fluid"> -->
            <div class="weixin"><span class="two-code"><img src="{{asset('img/weixin.jpg')}}" /></span>关注升维公众号</div>
            <div class="app"><span class="two-code"><img src="{{asset('img/app.jpg')}}"  /></span>下载升维APP</div>
            <!-- </div> -->
        </div>
        <div class="col-md-6 contacts">
            <p class="footer-title">联系升维</p>
            <p class="contact-pub contact-telephone"><i class="iconfont icon-dianhua"></i>Tel：010-64430881</p>
            <p class="contact-pub contact-email"><i class="iconfont icon-youxiang"></i>E-Mail：shengwei2025@163.com</p>
            <p class="contact-pub contact-addr"><i class="iconfont icon-dizhi"></i>Add：北京市朝阳区安贞里街道浙江大厦1601</p>
            <p class="copyright">京ICP备17053834号<span></span>copyright &copy; 2017 sw2025.com</p>
        </div>
        <!-- </div> -->
    </div>
</div>
<!-- 公共footer / end -->
<script type="text/javascript">
    if(typeof($.cookie('userId'))=="undefined"){
        window.location.href="{{url('login')}}";
    }
    $(function(){
        var str=window.location.pathname;
        var num1=str.indexOf('/');
        var find = '/';//表示要找的字符
        var flag = 2;//表示第几次出现
        var num2=0;
        for(var i=0;i<str.length;i++){
            if(str.charAt(i)==find)
                flag--;
            if(flag==0){
                num2=i;
                break;
            }
        }
        if(num2){
            var string=str.substring(num1+1,num2);
        }else{
            var string=str.substring(num1+1);
        }
        $("#"+string).addClass('active');
        //alert($.cookie('userId'));
        if($.cookie('userId')){
            var name=$.cookie("name");
            $(".before-login").hide();
            $(".after-login").show();
            $(".after-login").children(":last").text(name);
        }else{
            $(".before-login").show();
            $(".after-login").hide();
        }
        $.ajax({
            url:"{{asset('getAvatar')}}",
            data:{userId:$.cookie('userId'),type:"enterprise"},
            dateType:"json",
            type:"POST",
            success:function(res){
                $(".v-avatar").attr('src',"{{env('ImagePath')}}"+res['enterAvatar']);
                $(".v-nick").html(res['phone']);
                if(res['remark']=="success"){
                    $(".havevip").show();
                    $(".novip").hide();
                    $(".goto-renzh").attr("title","已认证");
                }else{
                    $(".havevip").hide();
                    $(".novip").show();
                }
                var date = new Date();
                date.setTime(date.getTime() + (120 * 60 * 1000));
                $.cookie("enterAvatar",res['enterAvatar'],{expires:date,path:'/',domain:'sw2025.com'});
                $.cookie("phone",res['phone'],{expires:date,path:'/',domain:'sw2025.com'});
                $.cookie("remark",res['remark'],{expires:date,path:'/',domain:'sw2025.com'});
            }
        })

        $.ajax({
         url:"{{url('getMessage')}}",
         data:{'userId':$.cookie('userId')},
         dateType:"json",
         type:"POST",
         success:function(res){
            if(res['code']=="success"){
                $(".v-new-info-tip").hide()
             }else{
                $(".v-new-info-tip").show()
            }
         }
         })
    })
    $(".quit").on("click",function(){
        $.ajax({
            url:"{{asset("quit")}}",
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    $.cookie("userId",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("name",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("enterAvatar",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("phone",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("remark",'',{path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('/')}}"
                }else{
                    window.location.href="{{asset('/')}}"
                }
            }
        })
    })
    $(".search-btn").on("click",function(){
        var type=$("#select-type").text();
        var content=$(".search-text").val();
        if(!type || !content){
            return false;
        }
        if(type=="搜专家"){
            window.location.href="/expert?searchname="+content+"&role=null&supply=null&consult=null&address=null&ordertime=desc&ordercollect=null&ordermessage=null"
        }else{
            window.location.href="/supply?searchname="+content+"&role=null&supply=null&address=null&ordertime=desc&ordercollect=null&ordermessage=null"
        }

    })
    $("#toCenter").on("click",function(){
        if($.cookie('role')=="专家"){
            window.location.href="{{asset('basic')}}"
        }else{
            window.location.href="{{asset('uct_basic')}}"
        }
    })

  /*  $('.vip').on('click',function(){
        var allowajax = true;
        var amount = $.trim($('.years input:radio:checked').val());
        var channel = $('.paytype input:radio:checked').val();
        if(channel == undefined || channel == ''  || amount == undefined|| amount == ''){
            layer.msg('请选好条件');
            return false;
        }
        if(allowajax){
            allowajax = false;
            $.ajax({
                type:'post',
                url:'{{url('initpay')}}',
                dataType:"json",
                data:{amount:amount,channel:channel,subject:'测试标题',body:'测试摘要',code:$.trim($('#code').val())},
                success:function(msg){
                    if(msg.code == 1){
                        pingpp.createPayment(msg.data.charge, function(result, err) {         //调起微信支付控件 进行支付
                            if (result=="success") {
                                // payment succeeded支付成功后的回调函数
                                //window.location.href='http://xxxx.com/demo/pingview'+"?id="+10000*Math.random();成功跳转到指定地址
                                layer.alert('支付成功');
                            } else {
                                //window.location.href='http://xxxx.com/demo/pingview'+"?id="+10000*Math.random();失败或关闭了支付控件 做对应处理
                                console.log(result+" "+err.msg+" "+err.extra);
                                layer.alert('支付失败');
                            }
                        });
                    } else {
                        layer.alert(msg.data.error_message);
                    }

                },
                error:function(){
                    layer.alert('支付异常1');
                    console.log('请求是否关注信息失败');
                },
            });
        }
       /!* $.post('{{url('initpay')}}',{'type':paytype,'amount':amount},function (data) {
            if(paytype == 'wx_pub_qr'){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '240px'], //宽高
                    content: data.charge
                });
            } else {
                pingpp.createPayment(data.charge, function(result, err){
                    console.log(result);
                    console.log(err.msg);
                    console.log(err.extra);
                    if (result == "success") {
                        // 只有微信公众账号 wx_pub 支付成功的结果会在这里返回，其他的支付结果都会跳转到 extra 中对应的 URL。
                    } else if (result == "fail") {
                        // charge 不正确或者微信公众账号支付失败时会在此处返回
                    } else if (result == "cancel") {
                        // 微信公众账号支付取消支付
                    }
                });
            }

        });*!/
    });*/


</script>
</body>
</html>