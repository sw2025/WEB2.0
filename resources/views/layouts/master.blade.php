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
                <a href="{{url('/login')}}">登录</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{url('/register')}}">注册</a>
                <!-- 登录后 -->
                <!-- <a href="#">个人中心</a> -->
            </div>
            <ul class="sw-nav">
                <li><a href="#">创业孵化</a></li>
                <li><a href="#">成长加速</a></li>
                <li><a href="#">企业转型升级</a></li>
            </ul>
        </div>
        <span class="sw-toggle-nav"><i class="iconfont icon-daohang"></i></span>
    </div>
</div>
<!-- 公共header / end -->
@yield("content")
        <!-- 公共footer / end -->
<div class="sw-footer">
    <div class="swcontainer clearfix">
        <div class="swcol-md-6 swcol-xs-12">
            <div class="sw-footer-l">
                <span>客服电话：</span>
                <strong>010-64430881&nbsp;/&nbsp;68985908</strong>
                <p>E-Mail：sunwy@swchina.com</p>
                <p>北京市朝阳区安贞里街道浙江大厦</p>
            </div>
        </div>
        <div class="swcol-md-6 swcol-xs-12">
            <div class="sw-footer-r clearfix">
                <div class="swcol-md-6 sw-wx">
                    升维公众号
                    <img src="{{asset('img/erweima1.jpg')}}" alt="升维公众号">
                </div>
                <div class="swcol-md-6 sw-app">
                    <p class="sw-app-caption">客户端</p>
                    <img src="{{asset('img/erweima2.jpg')}}" alt="客户端">
                    <div class="app-caption">
                        <span><i class="iconfont icon-changyonglogo35"></i>IOS</span>
                        <span><i class="iconfont icon-changyonglogo37"></i>Android</span>
                    </div>
                </div>
            </div>
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
    })();
</script>


