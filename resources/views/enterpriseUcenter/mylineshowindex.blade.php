@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
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
                <ul class="sw-mains-list">
                    <li class="sw-article">
                        <div class="sw-article-tit"><a href="{{url('keeplineshow',$v->lineshowid)}}">{{$v->title}}</a></div>
                        <div class="sw-article-desc">
                            <p class="sw-article-para">{{$v->describe}}</p>
                            <p class="sw-article-para">{{$v->remarks}}</p>
                            {{--<a href="javascript:;" class="sw-connect-btn">项目资料</a>--}}
                        </div>
                        <div class="sw-upload-wrapper" style="margin-left: 10px;">
                            <span class="sw-upload-cap">{{$v->bpname or '上传文件'}}</span>
                            <input class="sw-upload-btn"  type="file" name="files[]" id='bpurl' data-url="https://www.sw2025.com/upload" {{--index="/images/15078635376874.png"--}} multiple="" accept="" index="@if(!empty($lineShowData)) 1 @endif">
                        </div>

                        <span class="sw-article-time"><b class="sw-time-explain">提交时间：</b>{{$v->puttime}}</span>
                        <span class="sw-article-state">等待平台回复</span>
                    </li>
                </ul>
                @endforeach
                    <div class="xxxooo" style="width: 100%;text-align:center;">
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