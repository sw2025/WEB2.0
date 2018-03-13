@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
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
           <ul class="sw-white-style">
            <li class="sw-white-item">
                <div class="img-wrapper">
                    <img src="{{env('ImagePath').$v->showimage}}" class="sw-expert-img">
                        @if($v->configid == 3|| $v->configid == 5)
                            @if($v->meettype == 1)
                                <a href="javascript:;" class="sw-connect-btn">联系专家</a>
                             @else
                            <a href="javascript:;" index="{{$expertinfo[$v->expertid]->phone}}" class="sw-connect-btn contact">联系专家</a>
                            @endif
                        @endif
                </div>
            <span onclick="javascript:window.location.href= '{{url('keepmeet',$v->meetid)}}'" style="cursor:pointer;">
                <div class="content-wrapper">
                    <strong class="sw-meet-name">{{$v->expertname}}</strong>
                    <span style="color: red">（{{$v->meettypename}}）</span>
                    <div class="sw-meet-label">
                        <a href="javacript:;">天使投资</a>
                        <a href="javacript:;">A轮</a>
                    </div>
                    <h3>问题描述：</h3>
                    <p class="sw-meet-desc">
                        {{$v->contents}}
                    </p>
                    <h3>备注：</h3>
                    <p class="sw-meet-desc">
                        {{unserialize($v->basicdata)['oneword']}}
                    </p>
                </div>
            </span>
                <div class="sw-meet-time"><span></span>{{$v->puttime}}</div>
                <span class="sw-meet-state">  <a href="{{url('keepmeet',$v->meetid)}}" style="color:#e25633;">{{$v->configname}}</a></span>
            </li>
        </ul>
        @endforeach

    </div>
</div>
    <script>
        $('.contact').on('click',function () {
            var e = $(this).attr('index');
            $('.contact').html(e);
        })
    </script>
@endsection