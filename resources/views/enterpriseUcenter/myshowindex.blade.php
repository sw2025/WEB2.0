@extends("layouts.master")
@section("content")

<link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">

<!-- banner -->
{{--<div class="junior-banner">
    <div class="swcontainer">
        <div class="jun-banner-cap">
            <a href="#" class="jun-banner-btn">创业孵化</a>
            <span class="jun-banner-intro">在线提交创业项目</span>
            <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
        </div>
    </div>
</div>--}}
<!-- 主体 -->
<div class="swcontainer sw-ucenter">
    <!-- 个人中心左侧 -->
    @include('layouts.entucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-mains-list">
            @foreach($data as $k => $v)
            <li class="sw-article">
                <div class="sw-article-tit"><span>项目名称：</span><a href="javascript:;">{{$v->title}}</a></div>
                <div class="sw-article-desc">
                    <b>项目描述：</b>
                    <p class="sw-article-para">{{mb_substr($v->brief,0,500)}}</p>
                </div>
                <div class="sw-article-person">
                    <span class="sw-article-cap">评议人：</span>
                    @foreach($expertinfo[$k] as $experts)
                        <img src="{{env('ImagePath').$experts->showimage}}" title="{{$experts->expertname}}" class="sw-article-img">
                    @endforeach
                </div>
                <span class="sw-article-time">{{$v->showtime}}</span>
                <span class="sw-article-state">{{$v->configname}}</span>
            </li>
            @endforeach

        </ul>
        <div style="width: 100%;text-align: center;">
            {!! $data->render() !!}


        </div>
        <div style="width: 100%;text-align: center;margin: 10px 0px;">
            <span class="page-sum">共<strong class="allPage"> {{$data->lastpage()}}</strong> 页</span>
        </div>


    </div>

</div>

@endsection