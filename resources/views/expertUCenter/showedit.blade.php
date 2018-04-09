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
                投资人<span>评议结果：</span>
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
                    <b class="sw-prodesc-cap">项目描述：</b>
                    <p class="sw-detail-desc"><a href="{{asset('./show/'.$data->bpurl)}}" target="_blank">{{$data->bpname}}</a></p>
                </div>
                <div class="sw-result-desc">
                    <b class="sw-prodesc-cap">项目BP：</b>
                    <p class="sw-detail-desc">{{$data->brief}}</p>
                </div>
                <div class="sw-detail-txt">
                    <b class="sw-prodesc-cap">对项目的评价：</b>
                    <textarea name="" id="content1" cols="30" rows="10" placeholder="请输入评议内容">{{$message->content or null}}</textarea>
                </div>
                <div class="sw-detail-txt">
                    <b class="sw-prodesc-cap">是否有融资意向：</b>
                    <textarea name="" id="content2" cols="30" rows="10" placeholder="请输入意向">{{$message->content2 or null}}</textarea>
                </div>
                <div class="sw-detail-txt">
                    是否对此项目感兴趣：<input id="isyes" type="checkbox" style="width: 20px;height: 20px;" @if(!empty($message) && $message->isyes) checked @endif>
                </div>
                <p class="sw-btn-wrapper">
                    @if($data->state != 3)
                    <button class="sw-btn-submit" type="button">@if(empty($message)) 发布评议 @else 修改评议@endif</button>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
    <script>
        $('.sw-btn-submit').on('click',function () {
            var isyes = $('#isyes').is(":checked") ? 1:0;
            var content1 = $('#content1').val();
            var content2 = $('#content2').val();
            var showid={{$data->showid}};
            if(content1==''||content2==''){
                layer.alert('请输入评议内容或者意向');
                return false;
            }
            $(this).attr('disabled',true);
            $.post("{{url('/dealpostshow')}}",{'isyes':isyes,'content1':content1,'content2':content2,'showid':showid},function (data){
                layer.msg(data.msg,{'icon':data.icon},function () {
                    window.location = window.location.href;
                });
            });
        });
    </script>
@endsection