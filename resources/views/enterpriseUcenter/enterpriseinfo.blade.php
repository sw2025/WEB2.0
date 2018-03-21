@extends("layouts.master")
@section("content")

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
    <!-- 个人中心右侧 -->
    <div class="sw-mains">
        <!-- 主体 -->
        <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">企业信息 <i class="iconfont" style="font-size: 23px;">&#xe602;</i></h1>
        <div class="sw-fillin">
            <div class="sw-fill-row">
                <span class="sw-fill-left">企业名称</span>
                <input type="text" class="sw-fill-inp entname" placeholder="输入企业名称" value="{{$entinfo->enterprisename or ''}}">
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">联系人</span>
                <input type="text" class="sw-fill-inp entjob" placeholder="输入联系人名称" value="{{$entinfo->job or ''}}">
            </div>

            <div class="sw-fill-row">
                <span class="sw-fill-left">所在行业</span>
                <div class="sw-fill-select">
                    <a href="javascript:;" class="sw-fill-opt entindustry">{{$entinfo->industry or ''}}</a>
                    <ul class="sw-fill-list">
                        <li>IT|通信|电子|互联网</li>
                        <li>金融业</li>
                        <li>房地产|建筑业</li>
                        <li>商业服务</li>
                        <li>贸易|批发|零售|租赁业</li>
                        <li>文体教育|工艺美术</li>
                        <li>生产|加工|制造</li>
                        <li>交通|运输|物流|仓储</li>
                        <li>服务业</li>
                        <li>文化|传媒|娱乐|体育</li>
                        <li>能源|矿产|环保</li>
                        <li>政府|非盈利机构</li>
                        <li>农|林|牧|渔|其他</li>
                    </ul>
                </div>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">企业规模</span>
                <div class="sw-fill-select">
                    <a href="javascript:;" class="sw-fill-opt entsize">{{$entinfo->size or ''}}</a>
                    <ul class="sw-fill-list">
                        <li>20人以下</li>
                        <li>20-99人</li>
                        <li>100-499人</li>
                        <li>500-999人</li>
                        <li>1000-9999人</li>
                        <li>10000人以上</li>
                    </ul>
                </div>
            </div>

            <p class="sw-btn-wrapper">
                <button class="sw-btn-submit" type="button">保&nbsp;&nbsp;存</button>
            </p>
        </div>
    </div>
</div>

    <script>

        $('.sw-btn-submit').on('click',function () {

            var entname = $('.entname').val();
            var entjob = $('.entjob').val();
            var entindustry = $('.entindustry').text();
            var entsize = $('.entsize').text();
            $.post('{{url("modifyEntData")}}',{'entname':entname,'job':entjob,'industry':entindustry,'size':entsize},function (data) {
                if(data.icon == 2){
                    layer.alert(data.msg);
                } else if(data.icon==1){
                    layer.msg(data.msg,{'time':2000},function () {
                        window.location = window.location.href;
                    });
                } else if(data.icon==3){
                    layer.msg(data.msg);
                }
            });
        });

    </script>
@endsection