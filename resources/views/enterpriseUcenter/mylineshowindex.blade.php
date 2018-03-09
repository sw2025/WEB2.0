@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>



    <!-- banner -->
    <div class="junior-banner">
        <div class="swcontainer">
            <div class="jun-banner-cap">
                <a href="#" class="jun-banner-btn">创业孵化</a>
                <span class="jun-banner-intro">在线提交创业项目</span>
                <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
            </div>
        </div>
    </div>
    <!-- 主体 -->
    <div class="swcontainer sw-ucenter">
        <!-- 个人中心左侧 -->
        @include('layouts.entucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-mains-list">
            <li class="sw-article">
                <div class="sw-article-tit"><a href="javascript:;">XX路演</a></div>
                <div class="sw-article-desc">
                    <p class="sw-article-para">[ 妙传 ]是服务于中小企业、社区周边商户及个人卖家的新型广告信息发布平台。旨在通过改变宣传的
                        传统途径，提升、改善信息传播的效果和效率。[ 妙传 ]是服务于中小企业、社区周边商户及个人卖家
                        的新型广告信息发布平台。旨在通过改变宣传的</p>
                </div>
                <div class="zhan-wei"></div>
                <span class="sw-article-time"><b class="sw-time-explain">提交时间：</b>2018-03-12</span>
                <span class="sw-article-state">已提交</span>
            </li>
        </ul>
    </div>
</div>
<!-- 底部 -->
@endsection