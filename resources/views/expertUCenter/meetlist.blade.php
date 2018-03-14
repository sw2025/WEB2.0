@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <style>
        .sw-article-para {
            height: 240px;
            overflow: hidden;
        }
        .meettype{
            border: 1px solid #000;
            border-radius: 5px;
            padding: 0px 3px 0px 3px;
            font-size: 17px;
            margin-top:-1px;
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
        @include('layouts.expucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-mains-list">
            <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">我的约见 <i class="iconfont" style="font-size: 23px;">&#xe602;</i></h1>
            @foreach($datas as $v)
            <li class="sw-article">
                <div class="sw-article-tit"><a href="{{url('expmymeet/myMeetdetail',$v->meetid)}}"><span class="meettype">@if($v->meettype==1)线上约见 @else线下约见 @endif</span> {{$v->enterprisename}}</a></div>
                <div class="sw-article-desc">
                    <p class="sw-article-para" style="color: #555;">{{$v->contents}}</p>
                </div>
                <div class="zhan-wei">
                    @if($v->configid == 2)
                        <a href="javascript:;" class="sw-to-review" index="{{$v->meetid}}">同意约见</a>
                        <a href="javascript:;" class="sw-no-time refalse" index="{{$v->meetid}}">没有时间</a>
                    @elseif($v->configid==3)
                        @if($v->meettype)
                            <a href="{{url('expmymeet/intomeeting',$v->meetid)}}" class="sw-no-time intomeeting">进入约见厅</a>
                        @else
                            <a href="javascript:;" class="sw-no-time">等待企业联系您</a>
                        @endif
                    @else
                        <a href="javascript:;" class="sw-no-time">已拒绝</a>
                    @endif

                </div>
                <span class="sw-article-time" style="color: #666;"><b class="sw-time-explain">约见时间：</b>{{$v->puttime}}<br /><b class="sw-time-explain">约见时长：</b>{{$v->timelot}}小时</span>
                <span class="sw-article-state">
                    @if($v->configid == 2)
                        待响应
                    @elseif($v->configid==3)
                        已响应
                    @else
                        已拒绝
                    @endif

                </span>
            </li>
            @endforeach

        </ul>
        <div style="width: 100%;text-align: center;">
            {!! $datas->render() !!}


        </div>
        @if(!empty($datas->lastpage()))
            <div style="width: 100%;text-align: center;margin: 10px 0px;">
                <span class="page-sum">共<strong class="allPage"> {{$datas->lastpage()}}</strong> 页</span>
            </div>
        @endif
    </div>
</div>
    <script>
        layer.config({
            extend: '/extend/layer.ext.js'
        });
        $('.sw-to-review').on('click',function () {
            var meetid = $(this).attr('index');
            $(this).attr('disabled',true);
            $(this).html('正在响应');
            $.post('{{url('/dealmeet')}}',{'meetid':meetid,'meetdeal':1},function (data) {
                layer.msg(data.msg,{'icon':data.icon},function () {
                    window.location.reload();
                });
            });
        });
        $('.refalse').on('click',function () {
            var remark;
            var that = $(this);
            var meetid = $(this).attr('index');
            layer.prompt({title: '请输入原因', formType: 2}, function(pass, index){
                remark=pass;
                that.attr('disabled',true);
                that.html('正在响应');
                $.post('{{url('/dealmeet')}}',{'meetid':meetid,'remark':remark,'meetdeal':0},function (data) {
                    layer.msg(data.msg,{'icon':data.icon},function () {
                        window.location.reload();
                    });
                });
            });

        });

        $('.intomeeting').on('click',function () {

        });
    </script>
@endsection