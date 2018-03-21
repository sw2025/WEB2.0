@extends("layouts.master")
@section("content")

<link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
<style>
    .iscomplete{
        color: #000;
        font-size: 15px;
        line-height: 20px;
        padding: 1px 10px;
        background: #e66b4d;
        border: 1px solid #e66b4d;
        border-radius: 5px;
        color: #fff;
        margin: 10px 10px;
    }
</style>
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
            <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">我的VC直评 <i class="iconfont" style="font-size: 23px;">&#xe602;</i> <a href="{{url('/showIndex')}}" id="putsector">发布VC</a></h1>
            @foreach($data as $k => $v)
            <li class="sw-article">
                <div class="sw-article-tit"><span>项目名称：</span><a href="@if($v->configid==1 || $v->configid==2){{url('/keepshow',$v->showid)}}@elseif($v->configid == 4 || $v->configid==5){{url('/entmyshow/myshowdetail',$v->showid)}} @else javascript:;@endif">{{$v->title}}</a></div>
                <div class="sw-article-desc">
                    <b>项目描述：</b>
                    <p class="sw-article-para">{{mb_substr($v->brief,0,500)}}</p>
                </div>
                <div class="sw-article-person">
                    <span class="sw-article-cap">评议人：</span>
                    @foreach($expertinfo[$k] as $vv)
                        <img src="{{env('ImagePath').$vv->showimage}}"  @if($vv->state==2) style="border: 3px solid #f00;" title="{{$vv->expertname}}已评议" @elseif($vv->state==4) style="border: 3px solid #e25633;" title="{{$vv->expertname}}已完成"  @else style="border: 3px solid #ccc;" title="{{$vv->expertname}}" @endif  class="sw-article-img">
                    @endforeach
                    @if($v->configid==4)
                        <div><button class="iscomplete" onclick='window.location="{{url('/entmyshow/myshowdetail',$v->showid)}}"'>查看评议</button><button class="iscomplete" id="iscomplete">完成评议</button></div>
                    @elseif($v->configid==5)
                        <div><button class="iscomplete" onclick='window.location="{{url('/entmyshow/myshowdetail',$v->showid)}}"'>查看评议</button></div>
                    @endif
                </div>
                <span class="sw-article-time">{{$v->showtime}}</span>
                <span class="sw-article-state">{{$v->configname}}</span>
            </li>
            @endforeach

        </ul>
        <div style="width: 100%;text-align: center;">
            {!! $data->render() !!}


        </div>
        @if(!empty($data->lastpage()))
            <div style="width: 100%;text-align: center;margin: 10px 0px;">
                <span class="page-sum">共<strong class="allPage"> {{$data->lastpage()}}</strong> 页</span>
            </div>
        @endif



    </div>

</div>
<script>
    $('#iscomplete').on('click',function () {
        layer.msg('请耐心等待升维网官方做核查');
    });
</script>
@endsection