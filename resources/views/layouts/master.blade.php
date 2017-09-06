s<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>升维</title>
    <link rel="stylesheet" type="text/css" href="{{asset('iconfont/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/global.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}" />


    <!-- js / start -->
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/public.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/reg.js')}}"></script>


    <!--[if lt IE 9]-->
    <!--[if lt IE 9]-->
    <script type="text/javascript" src="{{asset('js/utils/html5shiv.min.js?1401441990')}}"></script>
    <script type="text/javascript" src="{{asset('js/utils/respond.min.js?1401441990')}}"></script>
    <!--[endif]-->
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
                <span class="before-login">
                    <a href="{{asset('register')}}" class="register header-link"><i class="iconfont icon-bianji"></i>注册</a>
                    <a href="{{asset('login')}}" class="login header-link"><i class="iconfont icon-suo"></i>登录</a>
                </span>
            <!-- 登录后 -->
                <span class="after-login">
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
@yield("content")
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
            <p class="contact-pub contact-telephone"><i class="iconfont icon-dianhua"></i>Tel：400-898-8557</p>
            <p class="contact-pub contact-email"><i class="iconfont icon-youxiang"></i>Mail：北京市海淀区中关村大街</p>
            <p class="contact-pub contact-addr"><i class="iconfont icon-dizhi"></i>Add：北京市海淀区中关村大街15-15号创业公社 · 中关村</p>
            <p class="copyright">京ICP备 XXXXXXXXX<span></span>copyright &copy; XXXX 2017</p>
        </div>
        <!-- </div> -->
    </div>
</div>
<!-- 公共footer / end -->
</body>
</html>
<script>
    $(function(){
        var pathNames=window.location.pathname;
        if(pathNames.indexOf("service")>=0){
            $("#service").addClass("active");
        }else if(pathNames.indexOf("expert")>=0){
            $("#expert").addClass("active");
        }else if(pathNames.indexOf("supply")>=0){
            $("#supply").addClass("active");
        }else if(pathNames.indexOf("us")>=0){
            $("#us").addClass("active");
        }else{
            $("#index").addClass("active");
        }
        if($.cookie('name')){
            var name=$.cookie("name");
            $(".before-login").hide();
            $(".after-login").show();
            $(".after-login").children(":last").text(name);
        }else{
            $(".before-login").show();
            $(".after-login").hide();
        }
    });
    $(".quit").on("click",function(){
        $.ajax({
            url:"{{asset("quit")}}",
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    $.cookie("userId",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("name",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("avatar",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("phone",'',{path:'/',domain:'sw2025.com'});
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
</script>