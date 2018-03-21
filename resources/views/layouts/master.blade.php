<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="Keywords" content="2025,升维网,升维,对接资源,转型升级,投融资,企业服务,管理咨询">
    <meta name="description" content="升维网是一个为广大中小型企业与外部专家资源对接提供服务的大型平台。这里汇聚了国际国内大量优秀的专家和资源，通过升维网平台，企业可以向行业专家咨询在经营过程中遇到的相关问题，专家为企业提供最专业的指导服务。"/>
    <meta name="author" content="www.swchina.com">
    <title>升维网-企业对接高端资源的平台</title>
    <!--样式初始化-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/reset.css')}}">
    <!--基础布局-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/layout.css')}}">
    <!-- 字体图标 -->
    <link type="text/css" rel="stylesheet" href="{{asset('iconfont/iconfont.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/header.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/swindex.css')}}">

    <script type="text/javascript" src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/public.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/jquery/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('js/jquery/jquery.fileupload.js')}}"></script>
</head>
<body>
<div class="sw-header">
    <div class="swcontainer">
        <a href="{{url('/')}}" class="sw-logo">
            <img src="{{asset('img/swlogo.png')}}" alt="升维网">
        </a>
        <div class="sw-menu">
            <div class="sw-user">
                <!-- 登录前 -->
                @if(empty(session('userId')))
                    <span class="sw-mt">
                        <a href="javascript:;" class="switchtype">登录</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;" class="switchtype">注册</a>
                    </span>
                        <!-- 登录后 -->
                @else
                <a href="{{url('myinfo')}}" class="sw-info sw-read"><i class="iconfont icon-email"></i><span class="info-exist" @if($systemMessage>0)style="display: block" @else style="display: none" @endif ></span></a>
                <a href="#" class="sw-logined"><img src="{{asset('img/avatar.jpg')}}"><span>{{session('phone')}}</span></a>
                <div class="sw-entry">
                    <a href="{{url('expindex/index')}}">专家入口</a>
                    <a href="{{url('entindex/index')}}">企业入口</a>
                    <a href="#" class="quit">退出</a>
                </div>
                @endif
            </div>
            <ul class="sw-nav">

                <li><a href="{{url('/')}}">首页</a></li>
                <li><a href="{{url('showIndex')}}">找投资</a></li>
                <li><a href="{{url('/daVIndex')}}">企业加速</a></li>
                <li><a href="{{url('/submitIndex')}}">企业转型升级</a></li>

           </ul>
        </div>
        <span class="sw-toggle-nav"><i class="iconfont icon-daohang"></i></span>
    </div>
</div>
<!-- 公共header / end -->
@yield("content")
        <!-- 公共footer / end -->
<!-- 底部 -->
<div class="sw-footer">
    <div class="swcontainer clearfix">
        <div class="swcol-md-6 swcol-xs-12">
            <div class="sw-footer-l">
                <span>客服电话：</span>
                <strong>010-64430881&nbsp;/&nbsp;68985908</strong>
                <p>E-Mail：shengwei2025@163.com</p>
                <p>北京市朝阳区安贞里街道浙江大厦</p>
                <p     style=" border-top: 1px solid #85827d;margin: 5px;"></p>

                <p><a href="{{url('us')}}" style="color: #fff;padding-bottom: 20px;">关于我们</a></p>
                <p><a href="{{url('service')}}" style="color: #fff;">服务内容</a></p>
            </div>
        </div>
        <div class="swcol-md-6 swcol-xs-12">
            <div class="sw-footer-r clearfix">
                <div class="swcol-md-6 sw-wx">
                    升维公众号
                    <img src="{{asset('img/erweima1.jpg')}} " alt="升维公众号">
                </div>
                <div class="swcol-md-6 sw-app">
                    <p class="sw-app-caption">客户端</p>
                    <img src="{{asset('img/erweima2.jpg')}} " alt="客户端">
                    <div class="app-caption">
                        <span><i class="iconfont icon-changyonglogo35"></i>IOS</span>
                        <span><i class="iconfont icon-changyonglogo37"></i>Android</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sw-copy">
            <p>京ICP备17053834号copyright&nbsp;&nbsp;&copy;&nbsp;&nbsp;2017&nbsp;swchina.com</p>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{asset('js/header.js')}}"></script>
<!-- 百度统计代码 -->
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?6f6e01e4a95947e6714c0d5ce631597b";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);

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
        $("#"+string).addClass('on');

        $('.switchtype').on('click',function () {
            var isreturnurl = window.location.search.indexOf('returnurl');
            var istype = window.location.search.indexOf('type');
            if(isreturnurl==-1 && istype == -1){
                if($.trim($(this).text())=='登录'){
                    window.location.href="{{url('/login')}}?returnurl="+window.location.href;
                }else {
                    window.location.href="{{url('/register')}}?returnurl="+window.location.href;
                }
            } else {
                if($.trim($(this).text())=='登录'){
                    window.location.href="{{url('/login')}}"+window.location.search;
                }else {
                    window.location.href="{{url('/register')}}"+window.location.search;
                }
            }


        });
    })();

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
                    $.cookie("enterAvatar",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("expertAvatar",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("phone",'',{path:'/',domain:'sw2025.com'});
                    $.cookie("userId",'',{path:'/',domain:'swchina.com'});
                    $.cookie("name",'',{path:'/',domain:'swchina.com'});
                    $.cookie("avatar",'',{path:'/',domain:'swchina.com'});
                    $.cookie("enterAvatar",'',{path:'/',domain:'swchina.com'});
                    $.cookie("expertAvatar",'',{path:'/',domain:'swchina.com'});
                    $.cookie("phone",'',{path:'/',domain:'swchina.com'});
                    window.location.href="{{asset('/')}}"
                }else{
                    window.location.href="{{asset('/')}}"
                }
            }
        })
    })


</script>


