<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>升维</title>
    <link rel="stylesheet" type="text/css" href="{{asset('iconfont/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/global.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />
    <!-- js / start -->
 {{--   <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>--}}
<script src="{{asset('im/3rd/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/public.js')}}"></script>
  {{--  <script type="text/javascript" src="{{asset('js/jquery.qqFace.js')}}"></script>--}}
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('js/utils/html5shiv.min.js?1401441990')}}"></script>
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
                    <a href="javascript:;" class="log-username header-link"><i class="iconfont icon-touxiang"></i>路漫漫其修远兮</a>
                </span>
            <div class="searchbar">
                <a href="javascript:;" class="search-cli"><i class="iconfont icon-sousuo"></i></a>
                <div class="search-sear">
                    <form name="">
                        <div class="select-box">
                            <div class="select-showbox"><span></span><i class="iconfont icon-xiangxiajiantou"></i></div>
                            <ul class="select-option">
                                <li>搜专家</li>
                                <li>搜供求</li>
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
                <li id="supply" ><a href="{{asset('supply')}}">供求信息</a></li>
                <li id="us" ><a href="{{asset('us')}}">关于我们</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 公共header / end -->
<!-- 基本资料 / start -->
<div class="ucenter">
    <div class="wrap clearfix">
        <!-- 侧边栏公共部分/start -->
        <div class="aside">
            <h2 class="aside-tit"><i class="iconfont icon-tongyong"></i>通用信息</h2>
            <ul class="common-info">
                <li id="uct_basic"><a href="{{asset('uct_basic')}}"><i class="iconfont icon-3jibenziliao"></i>基本资料</a></li>
                <li id="uct_recharge"><a href="{{asset('uct_recharge')}}"><i class="iconfont icon-chongzhi"></i>充值提现</a></li>
                <li id="uct_myinfo"><a href="{{asset('uct_myinfo')}}"><i class="iconfont icon-wodexinxi"></i>我的消息</a></li>
                <li id="uct_myneed"><a href="{{asset('uct_myneed')}}"><i class="iconfont icon-xuqiu"></i>我的需求</a></li>
            </ul>
            <h2 class="aside-tit"><i class="iconfont icon-gongsi"></i>我是企业</h2>
            <ul class="common-info">
                <li id="uct_member"><a href="{{asset('uct_member')}}"><i class="iconfont icon-renzheng2"></i>会员认证</a></li>
                <li id="uct_works"><a href="{{asset('uct_works')}}"><i class="iconfont icon-banshizhinan"></i>办事服务</a></li>
                <li id="uct_video"><a href="{{asset('uct_video')}}"><i class="iconfont icon-shipin"></i>视频咨询</a></li>
                <li id="uct_resource"><a href="{{asset('uct_resource')}}"><i class="iconfont icon-ziyuanku2"></i>专家资源</a></li>
            </ul>
            <h2 class="aside-tit"><i class="iconfont icon-iconfonticon"></i>我是专家</h2>
            <ul class="common-info">
                <li id="uct_expert"><a href="{{asset('uct_expert')}}"><i class="iconfont icon-renzheng1"></i>专家认证</a></li>
                <li id="uct_standard"><a href="{{asset('uct_standard')}}"><i class="iconfont icon-shoufeixitong"></i>收费标准</a></li>
                <li id="uct_mywork"><a href="{{asset('uct_mywork')}}"><i class="iconfont icon-banjieshijian"></i>我的办事</a></li>
                <li id="uct_myask"><a href="{{asset('uct_myask')}}"><i class="iconfont icon-zixun"></i>我的咨询</a></li>
            </ul>
        </div>
        <!-- 侧边栏公共部分/end -->
@yield("content")
    </div>
</div>
<!-- 基本资料 / end -->
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
<script type="text/javascript">
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
    $("#"+string).addClass('current');
    if($.cookie('name')){
        var name=$.cookie("name");
        $(".before-login").hide();
        $(".after-login").show();
        $(".after-login").children(":last").text(name);
    }else{
        $(".before-login").show();
        $(".after-login").hide();
    }
    $(".quit").on("click",function(){
        $.ajax({
            url:"{{asset("quit")}}",
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    $.cookie("userId",'',{expires:7,path:'/',domain:'sw2025.com'});
                    $.cookie("name",'',{expires:7,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('/')}}"
                }else{
                    window.location.href="{{asset('/')}}"
                }
            }
        })
    })
</script>
</body>
</html>