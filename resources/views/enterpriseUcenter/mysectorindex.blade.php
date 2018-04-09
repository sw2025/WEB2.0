@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>

    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <style>
        #putsector{
            margin-right: 0%;
            float: right;
            background: #61498f;
            border: 1px solid #eeeeee;
            padding: 1px 11px;
            border-radius: 5px;
            color: #fff;
            font-size: 19px;
        }
    </style>
    <!-- banner -->
    <div class="junior-banner">
        <div class="swcontainer">
            <div class="jun-banner-cap">
                <a href="#" class="jun-banner-btn">成长加速</a>
                <span class="jun-banner-intro">在线召开私董会</span>
                <p>整合全球一线大V、机构资源<br>专为待转型升级企业打造升维私董会</p>
            </div>
        </div>
    </div>
    <!-- 主体 -->
    <div class="swcontainer sw-ucenter">
        <!-- 个人中心左侧 -->
        @include('layouts.entucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <h1 style="font-size: 22px;color: #61498f;margin-bottom: 25px;">线上私董会 <i class="iconfont" style="font-size: 23px;">&#xe602;</i> <a href="{{url('/entmysector/supplysector')}}" id="putsector">发布私董会</a></h1>

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
                            <img src="{{env('ImagePath').$vv->showimage}}" @if($vv->state==2) style="border: 3px solid #f00;" title="{{$vv->expertname}}已响应" @elseif($vv->state==3) style="border: 3px solid #36b942;" title="{{$vv->expertname}}已被选择" @elseif($vv->state==4) style="border: 3px solid #61498f;" title="{{$vv->expertname}}已完成" @elseif($vv->state==5) style="border: 3px solid #000;" title="{{$vv->expertname}}已拒绝或失效" @else style="border: 3px solid #ccc;" title="{{$vv->expertname}}" @endif class="sw-article-img"  >
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
        @if(!empty($data->lastpage()))
            <div style="width: 100%;text-align: center;margin: 10px 0px;">
                <span class="page-sum">共<strong class="allPage"> {{$data->lastpage()}}</strong> 页</span>
            </div>
        @endif
    </div>
</div>
@endsection