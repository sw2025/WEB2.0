<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 百度统计代码 -->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?6f6e01e4a95947e6714c0d5ce631597b";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="Keywords" content="2025,升维网,升维,对接资源,转型升级,投融资,企业服务,管理咨询">
    <meta name="description" content="升维网是一个为广大中小型企业与外部专家资源对接提供服务的大型平台。这里汇聚了国际国内大量优秀的专家和资源，通过升维网平台，企业可以向行业专家咨询在经营过程中遇到的相关问题，专家为企业提供最专业的指导服务。"/>
    <meta name="author" content="www.sw2025.com">
    <title>升维网-企业对接高端资源的平台</title>
    <link rel="stylesheet" type="text/css" href="{{asset('iconfont/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/global.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />
    <!-- js / start -->
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/public.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.qqFace.js')}}"></script>
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
                <li id="expert" ><a href="{{asset('expert')}}?role=专家&ordertime=desc">专家资源</a></li>
                <li id="supply" ><a href="{{asset('supply')}}">商情信息</a></li>
                <li id="us" ><a href="{{asset('us')}}">关于我们</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 公共header / end -->
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
<!-- 企业办事服务 / end -->
<!-- 修改意见/start -->
<div class="cover">
    <div class="cover-pop">
        <textarea name="" id="" cols="30" rows="10" class="opinion-txt"></textarea>
        <button type="button" class="test-btn cover-confirm">确定</button>
        <button type="button" class="test-btn cover-cancel">取消</button>
    </div>
</div>
<!-- 修改意见/end -->
        <div class="footer">
            <div class="container clearfix">
                <!-- <div class="row"> -->
                <div class="col-md-6 two-pic">
                    <!-- <div class="container-fluid"> -->
                    <div class="weixin"><span class="two-code"><img src="{{asset('img/weixin.jpg')}}" style="width: 140px;height: 150px;"/></span>关注升维公众号</div>
                    <div class="app"><span class="two-code"><img src="{{asset('img/android.png')}}"  style="width: 140px;height: 150px;"/></span>升维APP(安卓)</div>
                    <div class="aapp"><span class="two-code"><img src="{{asset('img/ios.png')}}"  style="width: 140px;height: 150px;"/></span>升维APP（IOS）</div>
                    <!-- </div> -->
                </div>
                <div class="col-md-6 contacts">
                    <p class="footer-title">联系升维<span id="help" style="margin-left: 15px;font-size: 12px">使用帮助</span></p>
                    <p class="contact-pub contact-telephone"><i class="iconfont icon-dianhua"></i>Tel：010-64430881/68985908</p>
                    <p class="contact-pub contact-email"><i class="iconfont icon-youxiang"></i>E-Mail：shengwei2025@163.com</p>
                    <p class="contact-pub contact-addr"><i class="iconfont icon-dizhi"></i>Add：北京市朝阳区安贞里街道浙江大厦</p>
                    <p class="copyright">京ICP备17053834号<span></span>copyright &copy; 2017 swchina.com</p>
                </div>
                <!-- </div> -->
            </div>
        </div>
<script type="text/javascript">
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
        $("#"+string).addClass('current');
        if($.cookie('userId')){
            var name=$.cookie("name");
            $(".before-login").hide();
            $(".after-login").show();
            $(".after-login").children(":last").text(name);
        }else{
            $(".before-login").show();
            $(".after-login").hide();
        }
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
    $("#help").on("click",function(){
        window.location.href="{{asset('help')}}";
    })
</script>
</body>
</html>

<script src="{{asset('js/notification.js')}}"></script>
<script>createNotification('type')</script>