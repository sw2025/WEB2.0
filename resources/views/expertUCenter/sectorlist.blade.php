@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
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
        @include('layouts.expucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-mains-list">
            <h1 style="font-size: 22px;color: #61498f;margin-bottom: 25px;">我的私董会 <i class="iconfont" style="font-size: 23px;">&#xe602;</i></h1>
            @foreach($datas as $v)
            <li class="sw-article">
                <div class="sw-article-tit"><a href="javascript:;">{{$v->domain1}}</a><br /><span>{{$v->enterprisename}}</span></div>
                <div class="sw-article-desc">
                    <p class="sw-article-para">{{$v->brief}}</p>
                </div>
                <div class="zhan-wei">
                    @if($v->state==0 || $v->state==1)
                        <a href="javascript:;" class="sw-to-review allowsector" index="{{$v->consultid}}">同意参加</a>
                        <a href="javascript:;" class="sw-no-time refalse" index="{{$v->consultid}}">没有时间</a>
                    @elseif($v->state==2)
                        <a href="javascript:;" class="sw-to-review">请等待企业用户确认</a>
                    @elseif($v->state==3)
                        <a href="{{url('expmysector/intoSector',$v->consultid)}}" class="sw-no-time intosector">进入会议</a>
                    @elseif($v->state==4)
                        <a href="javascript:;" class="sw-no-time intosector">已完成</a>
                    @elseif($v->state==5)
                        <a href="javascript:;" class="sw-no-time intosector">已失效</a>
                    @endif

                </div>
                <span class="sw-article-time"><b class="sw-time-explain">会议开始时间：</b>{{date('Y年m月d日 H点i分',strtotime($v->starttime))}}<br /><b class="sw-time-explain">会议时长：</b>{{(strtotime($v->endtime)-strtotime($v->starttime))/60}}分钟</span>
                <span class="sw-article-state">
                     @if($v->state==0 || $v->state==1)
                        待选择
                    @elseif($v->state==2)
                        已同意
                    @elseif($v->state==3)
                        已被企业选择参加
                    @elseif($v->state==4)
                        已完成
                    @elseif($v->state==5)
                        已无效
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
        $('.allowsector').on('click',function () {
            var consultid = $(this).attr('index');
            $.post('{{url('/uct_myask/responseconsult')}}',{'consultid':consultid,'consultdeal':1},function (data) {
                layer.msg(data.msg,{'icon':data.icon},function () {
                    window.location.reload();
                });
            });
        });
        $('.refalse').on('click',function () {
            var remark;
            var consultid = $(this).attr('index');
            layer.prompt({title: '请输入原因', formType: 2}, function(pass, index){
                remark=pass;
                $.post('{{url('/uct_myask/responseconsult')}}',{'consultid':consultid,'remark':remark,'consultdeal':0},function (data) {
                    layer.msg(data.msg,{'icon':data.icon},function () {
                        window.location.reload();
                    });
                });
            });

        });
    </script>
@endsection