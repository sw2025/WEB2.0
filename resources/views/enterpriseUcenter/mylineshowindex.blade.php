@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
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
                @foreach($data as $v)
                <ul class="sw-mains-list">
                    <li class="sw-article">
                        <div class="sw-article-tit"><a href="{{url('keeplineshow',$v->lineshowid)}}">{{$v->title}}</a></div>
                        <div class="sw-article-desc">
                            <p class="sw-article-para">{{$v->describe}}</p>
                            <p class="sw-article-para">{{$v->remarks}}</p>
                            <a href="javascript:;" class="sw-connect-btn">项目资料</a>
                        </div>
                        <div class="zhan-wei"></div>
                        <span class="sw-article-time"><b class="sw-time-explain">提交时间：</b>{{$v->puttime}}</span>
                        <span class="sw-article-state">已提交</span>
                    </li>
                </ul>
                @endforeach
            </div>
</div>
<!-- 底部 -->
@endsection