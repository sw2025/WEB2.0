@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/reviewDetail.css')}}">

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
    <!-- 个人中心右侧 -->
    <div class="sw-mains">
        <div class="sw-review-detail">
            <div class="sw-result-tit">
                约见对方: <span>{{$data->enterprisename}}</span>
            </div>
            <div class="sw-result-content">
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">约见方式：</b>
                    <p class="sw-detail-desc">@if($data->meettype)线上约见 @else 线下约见@endif</p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">约见开始时间：</b>
                    <p class="sw-detail-desc">{{$data->timelot}}</p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">约见时长：</b>
                    <p class="sw-detail-desc">{{$data->timelot}}小时</p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">约见描述：</b>
                    <p class="sw-detail-desc">{{$data->contents}}</p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">备注：</b>
                    <p class="sw-detail-desc">{{unserialize($data->basicdata)['oneword']}}</p>
                </div>


            </div>
        </div>
        @if($data->configid==2)
        <div style="text-align: center;margin: 20px;">
            <a href="javascript:;" class="sw-to-review" index="{{$data->meetid}}">同意约见</a>
            <a href="javascript:;" class="sw-no-time refalse" index="{{$data->meetid}}">没有时间</a>
        </div>
        @endif

    </div>
</div>
<!-- 底部 -->
    <script>
        layer.config({
            extend: '/extend/layer.ext.js'
        });
        $('.sw-to-review').on('click',function () {
            var meetid = $(this).attr('index');
            $.post('{{url('/dealmeet')}}',{'meetid':meetid,'meetdeal':1},function (data) {
                layer.msg(data.msg,{'icon':data.icon},function () {
                    window.history.go(-1);
                });
            });
        });
        $('.refalse').on('click',function () {
            var remark;
            var meetid = $(this).attr('index');
            layer.prompt({title: '请输入原因', formType: 2}, function(pass, index){
                remark=pass;
                $.post('{{url('/dealmeet')}}',{'meetid':meetid,'remark':remark,'meetdeal':0},function (data) {
                    layer.msg(data.msg,{'icon':data.icon},function () {
                        window.history.go(-1);
                    });
                });
            });

        });
    </script>
@endsection