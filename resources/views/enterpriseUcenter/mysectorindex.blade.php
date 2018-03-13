@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>

    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">

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
            @foreach($data as $k => $v)
            <li class="sw-article">
                <div class="sw-article-tit"><a href="@if($v->configid ==5 || $v->configid==6) {{url('/entmysector/detail',$v->consultid)}}@else javascript:; @endif">{{$v->domain1}}</a></div>
                <div class="sw-article-desc">
                    <p class="sw-article-para">{{$v->brief}}</p>
                </div>
                <div class="sw-article-person">
                    <span class="sw-article-cap">参会人：</span>
                    @if(!empty($expertinfo))
                        @foreach($expertinfo[$k] as $vv)
                            <img src="{{env('ImagePath').$vv->showimage}}" @if($vv->state==2) style="border: 3px solid #f00;" title="{{$vv->expertname}}已响应" @elseif($vv->state==3) style="border: 3px solid #36b942;" title="{{$vv->expertname}}已被选择" @elseif($vv->state==4) style="border: 3px solid #e25633;" title="{{$vv->expertname}}已完成" @elseif($vv->state==5) style="border: 3px solid #000;" title="{{$vv->expertname}}已拒绝或失效" @else style="border: 3px solid #ccc;" title="{{$vv->expertname}}" @endif class="sw-article-img"  >
                        @endforeach
                    @endif
                </div>
                <span class="sw-article-time"><b class="sw-time-explain">提交时间：</b>{{$v->consulttime}}</span>
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