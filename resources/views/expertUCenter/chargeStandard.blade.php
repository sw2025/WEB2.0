@extends("layouts.master")
@section("content")

        <!-- 我的钱包 -->

<link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/myPackage.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/pages.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
<style>
    .sw-checkbox{
        width: 22px;
        height: 22px;
        /* margin-bottom: 2px; */
        /* text-align: center; */
        margin-top: 8px;

    }
    .sw-standard-inp{
        margin-left:20px;
    }
</style>

<!-- banner -->
{{-- <div class="junior-banner">
     <div class="swcontainer">
         <div class="jun-banner-cap">
             <a href="#" class="jun-banner-btn">创业孵化</a>
             <span class="jun-banner-intro">在线提交创业项目</span>
             <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
         </div>
     </div>
 </div>--}}
        <!-- 主体 -->
<div class="swcontainer sw-ucenter">
    <!-- 个人中心左侧 -->
    @include('layouts.expucenter')
            <!--样式初始化-->


    <!-- 收费设置 -->

    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <div class="sw-package">
            <div class="sw-fill-row">
                <span class="sw-charge-left">项目评议收费标准</span>
                <div class="sw-standard-wrapper">
                    <input type="checkbox" class="sw-checkbox" value="" @if($expertinfo->iscomment) checked @endif>><span class="sw-standard-unit">是否开启</span>
                    <input type="text" class="sw-standard-inp" disabled value="69">
                    <span class="sw-standard-unit">元/次</span>
                </div>
            </div>
            <div class="sw-fill-row">
                <span class="sw-charge-left">线下约见</span>
                <div class="sw-standard-wrapper">
                    <input type="checkbox" class="sw-checkbox" value="" @if($expertinfo->islinemeet) checked @endif>><span class="sw-standard-unit">是否开启</span>
                    <input type="text" class="sw-standard-inp linefee"  value="{{$expertinfo->linefee or 1000}}">
                    <span class="sw-standard-unit">元/小时</span>
                </div>
            </div>
            <div class="sw-fill-row">
                <span class="sw-charge-left">线上约见/私董会</span>
                <div class="sw-standard-wrapper">
                    <input type="checkbox" class="sw-checkbox" value="" @if($expertinfo->isonlinemeet) checked @endif>><span class="sw-standard-unit">是否开启</span>
                    <input type="text" class="sw-standard-inp fee" value="{{$expertinfo->fee or 0}}">
                    <span class="sw-standard-unit">元/分钟</span>
                </div>
            </div>
            <p class="sw-btn-wrapper">
                <button class="sw-btn-submit" type="button">保&nbsp;&nbsp;存</button>
            </p>
        </div>
    </div>
</div>
<!-- 底部 -->
<script>
    $('.sw-btn-submit').on('click',function () {
        var iscomment = $('.sw-checkbox').eq(0).is(":checked") ? 1:0;
        var islinemeet = $('.sw-checkbox').eq(1).is(":checked") ? 1:0;
        var isonlinemeet = $('.sw-checkbox').eq(2).is(":checked") ? 1:0;
        var linefee = $('.linefee').val();
        var fee = $('.fee').val();
        if(linefee < 0 || fee < 0){
            layer.msg('请定义正确的资费');
            return false;
        }
        $.post("{{url('chargeStandard')}}",{'iscomment':iscomment,'islinemeet':islinemeet,'isonlinemeet':isonlinemeet,'fee':fee,'linefee':linefee},function (data){
            if(data.icon==2){
                layer.msg(data.msg,{icon:2},function (){
                    window.location = data.url;
                });
            } else {
                layer.msg(data.msg);
            }
        });
    });
</script>
@endsection