@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">企业办事服务</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <input type="hidden" id="event" name="event" value="{{$eventId}}">
                <div class="publish-need uct-works default-result">
                    <div class="expert-certy-state">
                        <span class="uct-works-icon icon1"></span>
                                <span class="publish-need-blue">
                                    <em>专家响应</em>EXPERTS RESPONSE
                                </span>
                    </div>
                    <div class="system-invite light-color">已经响应<span class="invite-count">{{$selected}}人</span></div>
                    @foreach($datas as $data)
                    <div class="mywork-det-txt uct-works-known">
                        <span class="mywork-det-tit"><em class="light-color">分类：</em>{{$data->domain1.'/'.$data->domain2}}</span>
                        <div class="mywork-det-desc">
                            <em class="light-color">描述：</em>
                            <p class="mywork-det-desc-para">{{$data->brief}}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="uct-works-exps">
                        <ul class="uct-works-exps-list">
                            @foreach($selExperts as $selExpert)
                                <li id="{{$selExpert->expertid}}"><a href="javascript:;"><img src="{{env('ImagePath').$selExpert->showimage}}" alt="" style="border: 1px solid #ccc;border-radius: 10px;">{{$selExpert->expertname}}</a></li>
                            @endforeach
                        </ul>
                        <button type="button" class="test-btn">确认</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            var expertIds=new Array();

            $('.uct-works-exps-list li').click(function(event) {
                var expertId=$(this).attr("id");

                if(expertIds.length!=5){
                    if(!$(this).hasClass("current")){
                        expertIds.push(expertId);
                    }else{
                        deleteArray(expertIds,expertId);
                    }
                }else{
                    if($.inArray(expertId,expertIds)>=0){
                        deleteArray(expertIds,expertId);
                    }else{
                        layer.confirm('您已经选定5位专家', {
                            btn: ['确定'] //按钮
                        });
                        return false;
                    }
                }
                $(this).toggleClass('current');
            });
            //删除已经选定的的专家
            var deleteArray=function (arr, val) {
                for(var i=0; i<arr.length; i++) {
                    if(arr[i] == val) {
                        arr.splice(i, 1);
                        break;
                    }
                }
            }
            //处理反选的专家
            $(".test-btn").on("click",function(){

                if(expertIds.length!=0 && expertIds.length == 1){
                   var eventId=$("#event").val();
                    $.ajax({
                        url:"{{asset('selectExpert')}}",
                        data:{"eventId":eventId,"expertIds":expertIds},
                        dateType:"json",
                        type:"POST",
                        success:function(res){
                            if(res['code']=="success"){
                                window.location.reload();
                            }else{
                                layer.confirm('您选定专家失败,重新选定', {
                                    btn: ['确定'] //按钮
                                });
                                return false;
                            }
                        }
                    })
                }else{
                    layer.confirm('请您只选定1位专家', {
                        btn: ['确定'] //按钮
                    });
                    return false;
                }
            })
        })
    </script>
@endsection