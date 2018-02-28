@extends("layouts.ucenter4")
@section("content")
    <script type="text/javascript" src="{{asset('js/reply.js')}}"></script>
<style>
    .textareaspan{
        width:99%;
        font-size: 15px;
        border:none;
    }

    #submitshow{
        margin: 10px 0px 50px 30%;
        background: #fff;
        border: 1px #000 solid;
        padding: 5px;
        width: 110px;
    }
    #submitshow:hover{
        background: #ddd;
    }
    /* Basic Grey */

    .basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
        border: 1px solid #DADADA;
        color: #111;
        height: 30px;
        margin-bottom: 16px;
        margin-right: 6px;
        margin-top: 2px;
        outline: 0 none;
        padding: 10px 10px 10px 5px;
        width: 70%;
        font-size: 15px;
        line-height:20px;
        box-shadow: inset 0px 1px 4px #ECECEC;
        -moz-box-shadow: inset 0px 1px 4px #ECECEC;
        -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
    }
    .basic-grey textarea{
        padding: 10px 3px 3px 10px;
        margin: 20px 0px 0px 15px;
    }

    .basic-grey textarea{
        height:200px;
    }

</style>
    <div class="main">
            <!-- 我的需求 / start -->
            <h3 class="main-top" style="font-size: 25px;">项目详情</h3>
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


                            @if($datas->userid == session('userId') && $configid->configid == 5)<div class="myneed-set" style="font-size: 25px;">已完成 </div>@endif
                            <div class="myneed-icon">
                                <a href="javascript:;" class="visitor"><i class="iconfont icon-yanjing"></i>{{$datas->looks or 0}}</a>
                            </div>
                            <div class="myneed-desc">
                                <span class="myneed-desc-tit"><b>项目描述:</b></span><br />
                                <textarea class="myneed-desc-para" id="textarea" style="width: 100%;color: #000;border:none;overflow-y: auto;">{{$datas->brief}}</textarea>
                            </div>
                        </div>
                        <input type="hidden" id="showid" value="{{$datas->showid}}" />
                        <div class="message-list">
                            <div class="details-abs-tit">
                                <div class="details-graph forth"><span class="square"></span></div>
                                <span class="details-tit-cap forth-cap" style="font-size: 20px;">请输入您的评议内容</span>
                            </div>
                            <div class="all-replys">
                                @if(!empty($message))
                                    @foreach($message as $v)
                                        <div class="mes-list-box clearfix">
                                            <div class="floor-host">
                                                <img src="@if(empty($v->showimage)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->showimage}}@endif" class="floor-host-ava" style="width:70px;height: 70px;" />
                                                <div class="floor-host-desc" style="padding-left: 85px;">
                                                    <a href="/expert/detail/{{$v->expertid}}" class="floor-host-name">{{$v->expertname}}</a><span class="floor-host-time">{{$v->messagetime}}</span>
                                                    <textarea class="floor-host-words textareaspan" readonly>{{$v->content}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                        <div class="basic-grey">
                                            <textarea id="message" name="message" placeholder="请输入您的评议内容">{{$message[0]->content}}</textarea>
                                        </div>
                                        <button id="submitshow" onclick="updateshow()">修改评议</button>
                                @else
                                    
                                    <div class="basic-grey">
                                        <textarea id="message" name="message" placeholder="请输入您的评议内容"></textarea>
                                    </div>
                                    <button id="submitshow" onclick="submitshow()">提交评议</button>

                                @endif

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

        function submitshow(){
            $('#submitshow').attr('disabled',true);
            $('#submitshow').css('background','#ddd');
            var message = $('#message').val();
            var supplyid = $('#showid').val();
            if(message == ''){
                layer.alert('请输入评议内容');
                $('#submitshow').attr('disabled',false);
                $('#submitshow').css('background','#fff');
                return false;
            }

            $.post('{{url('myshows/messagetoShow')}}',{'showid':supplyid,'content':message},function (data) {

                layer.msg(data.msg,{'icon':data.icon,time: 1500},function () {
                    window.location.href = window.location;
                });
            });
        }

        function updateshow(){
            $('#submitshow').attr('disabled',true);
            $('#submitshow').css('background','#ddd');
            var message = $('#message').val();
            var supplyid = $('#showid').val();
            if(message == ''){
                layer.alert('请输入评议内容');
                $('#submitshow').attr('disabled',false);
                $('#submitshow').css('background','#fff');
                return false;
            }

            $.post('{{url('myshows/messagetoShow')}}',{'showid':supplyid,'content':message,'isupdate':1},function (data) {

                layer.msg(data.msg,{'icon':data.icon,time: 1500},function () {
                    window.location.href = window.location;
                });
            });
        }

    </script>
    <script src="{{url('js/mysupply.js')}}" type="text/javascript"></script>
    <script src="{{url('js/textareaauto.js')}}" type="text/javascript"></script>
    <script>
        $('.textareaspan').each(function () {
            autoTextarea($(this)[0]);
        });
    </script>
@endsection