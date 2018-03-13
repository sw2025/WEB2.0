@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/reviewDetail.css')}}">

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
    <!-- 评议详情 -->

    <!-- 个人中心右侧 -->
    <div class="sw-mains">
        <div class="sw-review-detail">
            <div class="sw-result-tit">
                投资人<span>评议结果：</span>
            </div>
            <div class="sw-result-content">
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">项目标题：</b>
                    <p class="sw-detail-desc">{{$data->title}}</p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">项目描述：</b>
                    <p class="sw-detail-desc">{{mb_substr($data->brief,0,300).'...'}}</p>
                </div>

                <div class="sw-detail-txt">
                    <b class="sw-prodesc-cap" style="font-size: 16px;">评议结果：</b>
                    @foreach($mess as $v)
                        <p style="margin-top: 10px;"><b>{{$v->expertname}}:</b></p>
                        <p class="sw-detail-desc">{{$v->content}}</p>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部 -->
@endsection