@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
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
        @include('layouts.expucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-mains-list">
            <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">我的评议 <i class="iconfont" style="font-size: 23px;">&#xe602;</i></h1>
            @foreach($datas as $v)
            <li class="sw-article">
                <div class="sw-article-tit"><a href="javascript:;">{{$v->title}}</a></div>
                <div class="sw-article-desc">
                    <p class="sw-article-para">{{$v->brief}}</p>
                </div>
                <div class="zhan-wei">
                    @if($v->state==0 || $v->state==1)
                        <a href="javascript:;" class="sw-to-review" index="{{$v->showid}}">去评议</a>
                    @else
                        <a href="javascript:;" class="sw-to-review" index="{{$v->showid}}">查看评议</a>
                    @endif
                </div>
                <span class="sw-article-time"><b class="sw-time-explain" style="display: none">提交时间：</b>{{$v->showtime}}</span>
                <span class="sw-article-state">
                    @if($v->state==0 || $v->state==1)
                        待评议
                    @elseif($v->state==2)
                        已评议
                    @elseif($v->state==3)
                        已完成
                    @endif
                </span>
            </li>
           @endforeach
        </ul>
        <div style="width: 100%;text-align: center;">
            {!! $datas->render() !!}


        </div>
        @if(!empty($datas))
            <div style="width: 100%;text-align: center;margin: 10px 0px;">
                <span class="page-sum">共<strong class="allPage"> {{$datas->lastpage()}}</strong> 页</span>
            </div>
        @endif
    </div>
</div>
    <script>
        $('.sw-to-review').on('click',function () {
            window.location = "{{url('expmyshow/showdetail')}}/"+$(this).attr('index');
        });
    </script>
@endsection