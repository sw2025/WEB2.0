@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/reply.js')}}"></script>
<style>
    .textareaspan{
        width:99%;
        font-size: 15px;
        border:none;
    }
</style>
    <div class="main">
            <!-- 我的需求 / start -->
            <h3 class="main-top">我的项目</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name" style="font-size: 25px;margin: 10px;">
                        {{$datas->title}}
                    </div>
                    <div class="myneeds">
                        <div class="myneed-con">
                            <span class="myneed-type"><b>领域分类：</b> {{$datas->domain1}} / {{$datas->domain2}}</span>
                            <span class="myneed-time"><b>发布时间：</b> <em>{{$datas->showtime}}1</em></span>
                            <span class="myneed-type"><b>BP 文件:</b>  &ensp;&ensp;<a href="{{env('ImagePath')}}/show/{{$datas->bpurl}}" target="_blank">{{$datas->bpname}}</a> </span>

                        @if($datas->userid == session('userId') && $configid->configid == 4)<div class="myneed-set"><button class="myneed-set-btn" index="{{$cryptid}}" supplyid="{{$datas->showid}}">设为完成</button><span class="myneed-tips">提示：完成后会提高您的评议优先级，方便进行下次评议</span></div>@endif
                            @if($datas->userid == session('userId') && $configid->configid == 5)<div class="myneed-set" style="font-size: 25px;">已完成 </div>@endif
                            <div class="myneed-icon">
                                <a href="javascript:;" class="visitor"><i class="iconfont icon-yanjing"></i>{{$datas->looks or 0}}</a>
                            </div>
                            <div class="myneed-desc">
                                <span class="myneed-desc-tit"><b>项目描述:</b></span><br />
                                <textarea class="myneed-desc-para" id="textarea" style="width: 100%;color: #000;border:none;overflow-y: auto;">{{$datas->brief}}</textarea>
                            </div>
                        </div>
                        <div class="message-list">
                            <div class="details-abs-tit">
                                <div class="details-graph forth"><span class="square"></span></div>
                                <span class="details-tit-cap forth-cap" style="font-size: 20px;">专家评议列表</span>
                            </div>
                            <div class="all-replys">
                                @foreach($message as $v)
                                        <div class="mes-list-box clearfix">
                                            <div class="floor-host">
                                                <img src="@if(empty($v->showimage)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->showimage}}@endif" class="floor-host-ava" style="width:70px;height: 70px;" />
                                                <div class="floor-host-desc" style="padding-left: 85px;">
                                                    <a href="/expert/detail/{{$v->expertid}}" class="floor-host-name">{{$v->expertname}}</a><span class="floor-host-time">{{$v->messagetime}}</span>
                                                    <textarea class="floor-host-words textareaspan">{{$v->content}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(function(){
            $('.bank-card').keyup(function(){
                var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
                $(this).val(value)
            })
        })
        $('.myneed-set-btn').on('click',function () {
            var mdid = $(this).attr('index');
            var supplyid = $(this).attr('supplyid');
            layer.confirm('您确定要完成该项目评议？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url('uct_myshow/solveShow')}}',{'mdid':mdid,'showid':supplyid},function (data) {
                    layer.msg(data.msg,{'icon':data.icon,time: 1500},function () {
                        window.location.href = document.referrer;
                    });
                });
            }, function(){
                layer.close();
            });

        });

    </script>
    <script src="{{url('js/mysupply.js')}}" type="text/javascript"></script>
    <script src="{{url('js/textareaauto.js')}}" type="text/javascript"></script>
    <script>
        $('.textareaspan').each(function () {
            autoTextarea($(this)[0]);
        });
    </script>
@endsection