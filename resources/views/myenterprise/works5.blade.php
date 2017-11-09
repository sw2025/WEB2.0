@extends("layouts.ucenter")
@section("content")
   <div class="bg_v2">
        <div class="card-step works-step">
            <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
            <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
            <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
            <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">6</span>完成
        </div>
        <div class="invite-experts">
            <div class="invite-expert-tit">
                <i class="iconfont icon-shenhejujue"></i><span>已响应<b class="invite-counts">{{$selected}}</b>人</span>
            </div>

            <table class="invite-table">
                <input type="hidden" id="event" name="event" value="{{$eventId}}">
                @foreach($datas as $data)
                    <tr>
                        <td>办事分类</td>
                        <td>{{$data->domain1.'/'.$data->domain2}}</td>
                    </tr>

                    <tr>
                        <td>办事描述</td>
                        <td>{{$data->brief}}</td>
                    </tr>
                    <tr>
                        <td>专家头像</td>
                        <td>
                            <div class="selected-experts">
                                @foreach($selExperts as $selExpert)
                                    <li id="{{$selExpert->expertid}}"><a href="javascript:;" class="expert-wrapper"><img src="{{env('ImagePath').$selExpert->showimage}}" alt="" style="border: 1px solid #ccc;border-radius: 10px;"><span class="expert-name">{{$selExpert->expertname}}</span></a></li>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="center-btn">
            <button type="button" class="test-btn">选择专家</button>
        </div>
    </div>
   <script type="text/javascript">
        $(function(){
            var expertIds=new Array();
            $('.selected-experts li').click(function(event) {
                var expertId=$(this).attr("id");
                if(expertIds.length!=1){
                   if(!$(this).hasClass("current")){
                       expertIds.push(expertId);
                   }else{
                       deleteArray(expertIds,expertId);
                    }
               }else{
                  if($.inArray(expertId,expertIds)>=0){
                        deleteArray(expertIds,expertId);
                  }else{
                      layer.confirm('您已经选定1位专家', {
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
                $(this).attr('disabled',true);
                $(this).html('正在处理');
                var _that=this;
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
                                $(_that).attr('disabled',false);
                                $(_that).html('选择专家');
                                return false;
                            }
                        }
                    })
                }else{
                    layer.confirm('请您只选定1位专家', {
                        btn: ['确定'] //按钮
                    });
                    $(_that).attr('disabled',false);
                    $(_that).html('选择专家');
                    return false;
                }
            })
        })
    </script>
@endsection