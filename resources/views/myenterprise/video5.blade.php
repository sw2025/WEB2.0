@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <!-- 专家视频咨询 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>会议申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">4</span>咨询管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>完成
                </div>
                <input type="hidden" id="consult" name="consult" value="{{$consultId}}">
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
                        <span class="mywork-det-tit"><em class="light-color">金额：</em>{{$expertcost}} / 5分钟</span>
                        <span class="mywork-det-tit"><em class="light-color">开始时间：</em>{{$data->starttime}}</span>
                        <span class="mywork-det-tit"><em class="light-color">结束时间：</em>{{$data->endtime}}</span>
                        <div class="mywork-det-desc">
                            <em class="light-color">描述：</em>
                            <p class="mywork-det-desc-para">{{$data->brief}}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="uct-works-exps">
                        <ul class="uct-works-exps-list">
                            @foreach($selExperts as $selExpert)
                                <li id="{{$selExpert->expertid}}" fee="{{$selExpert->fee  or 0}}" state="{{$selExpert->state}}"><a href="javascript:;" target="_bank"><img src="{{env('ImagePath').$selExpert->showimage}}" alt="">{{$selExpert->expertname}}</a></li>
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
                var state=$(this).attr("state");
                var fee=$(this).attr("fee");
                if(state==1){
                    expertId=expertId+"/"+fee;
                }else{
                    fee="0";
                    expertId=expertId+"/"+fee;
                }
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
                console.log(expertIds);
                var consultId=$("#consult").val();
                var totalCount=0;
                if(expertIds.length!=0){
                    $.ajax({
                        url:"{{asset('handleSelect')}}",
                        data:{"userId":$.cookie('userId'),"expertIds":expertIds,"consultId":consultId},
                        dateType:"json",
                        type:"POST",
                        success:function(res){
                            switch(res['code']){
                                case "noMoney":
                                    layer.confirm('您的余额不足,前去充值?', {
                                        btn: ['充值','取消'], //按钮
                                    }, function(){
                                        window.location.href="{{asset('uct_member')}}";
                                    }, function(){
                                        layer.close();
                                    });
                                break;
                                case "success":
                                    window.location.reload();
                                break;
                                case "error":
                                    layer.msg("网络异常");
                                break;
                            }
                        }
                    })
                }else{
                    layer.confirm('请您至少选定1位专家', {
                        btn: ['确定'] //按钮
                    });
                    return false;
                }
            })
        })
    </script>
@endsection
