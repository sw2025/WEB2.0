@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>
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
        @include('layouts.expucenter')
    <!-- 个人中心主体 -->
            <div class="sw-mains">
                <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">项目中心 <i class="iconfont" style="font-size: 23px;">&#xe602;</i> </h1>
                @foreach($data as $k => $v)
                <ul class="sw-mains-list">
                    <li class="sw-article">
                        <div class="sw-article-tit"><a href="{{url('keepSubmit',$v->showid)}}">{{$v->title}} </a></div>
                        <div class="sw-article-desc">
                           <p class="sw-article-para"> <b>领域轮次：</b>{{'【'.$v->domain1.'】'.$v->preference}}</p>
                            <p class="sw-article-para"> <b>一句话描述：</b>{{$v->oneword}}</p>
                            {{--<a href="javascript:;" class="sw-connect-btn">项目资料</a>--}}
                        </div>
                        {{--<div class="sw-upload-wrapper" style="margin-left: 10px;">
                            <span class="sw-upload-cap">{{$v->bpname or '上传文件'}}</span>
                        </div>--}}
                        <div class="sw-article-person">
                            <span class="sw-article-cap">BP：</span>
                            <button class="iscomplete" onclick="window.location='{{env('ImagePath')."/show/".$v->bpurl}}'">{{$v->bpname}}</button>
                        </div>

                        <span class="sw-article-time"><b class="sw-time-explain">提交时间：</b>{{$v->showtime}}</span>
                    </li>
                </ul>
                @endforeach
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
    <style>
    .xxxooo li{display: inline; padding:20px;font-size: 16px;}
    .xxxooo .active{color:#e25633;}
    </style>
<!-- 底部 -->
@endsection