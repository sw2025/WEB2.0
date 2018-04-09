@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/reviewDetail.css')}}">
    <style>
        .sw-prodesc-cap{
            font-size: 17px;
            font-weight: normal;
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
                <!-- 个人中心右侧 -->
        <div class="sw-mains">
            <div class="sw-review-detail">
                <div class="sw-result-tit">
                    <span>{{$data->title}}</span>
                </div>
                <div class="sw-result-content">
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">项目标题：</b>
                        <p class="sw-detail-desc">{{$data->title}}</p>
                    </div>
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">一句话介绍：</b>
                        <p class="sw-detail-desc">{{$data->oneword}}</p>
                    </div>
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">需求领域：</b>
                        <p class="sw-detail-desc">{{$data->domain1}}</p>
                    </div>
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">企业信息：</b>
                        <p class="sw-detail-desc"><b>企业名称： </b> {{unserialize($data->basicdata)['enterprisename'].' / '.unserialize($data->basicdata)['job']}}</p>
                        <p class="sw-detail-desc"><b>企业行业： </b> {{unserialize($data->basicdata)['industry']}}</p>
                    </div>
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">项目BP：</b>
                        <p class="sw-detail-desc"><a href="{{asset('./show/'.$data->bpurl)}}" target="_blank">{{$data->bpname}}</a></p>
                    </div>
                    <div class="sw-result-desc">
                        <b class="sw-prodesc-cap">项目描述：</b>
                        <p class="sw-detail-desc">{{$data->brief}}</p>
                    </div>

                    <div class="sw-detail-txt">
                        是否对此项目感兴趣：<input id="isyes" type="checkbox" style="width: 20px;height: 20px;" @if(!empty($message) && $message->isyes) checked @endif>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $('.isyes').on('click',function () {
            layer.msg('已设置为感兴趣');
        });
    </script>
@endsection