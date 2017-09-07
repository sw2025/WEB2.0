
@extends('layouts.ucenter4')
@section("content")
<div class="main">
            <!-- 我的办事 / start -->
            <h3 class="main-top">我的办事</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name">
                        {{$datas->enterprisename}}
                    </div>
                    <div class="mywork-det">
                        <div class="mywork-det-txt">
                            <span class="mywork-det-tit"><em class="light-color">需求分类：</em>{{$datas->domain1.' / '.$datas->domain2}}</span>
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">{{$datas->brief}}</p>
                            </div>
                        </div>
                        <div class="respond-btn-box">
                            <!-- 状态按钮根据实际状态只展示一个 -->
                            @if($datas->configid == 4)
                                <button type="button" class="unrespond respond-btn" onclick="responseevent({{$datas->eventid}},this)">响应</button>
                            @elseif($datas->configid == 5)
                                <button type="button" class="responded respond-btn">已响应</button>
                            @elseif($datas->configid == 7)
                            <span class="respond-tips">已完成</span>
                                @else
                                <span class="respond-tips">请等待企业邀请，未获企业邀请</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        $('.bank-card').keyup(function(){
            var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
            $(this).val(value)
        })
    })


    function responseevent(eventid,obj){
        $(obj).attr('disabled',true);
        $(obj).html('正在响应');
        $.post('{{url('uct_mywork/responseevent')}}',{'eventid':eventid,'token':'{{$token}}'}, function (data){
                   if(data.icon == 2){
                       layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                           $(obj).attr('disabled',false);
                           $(obj).html('响应');
                          window.location = '{{url('/')}}';
                       });
                   } else {
                       layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                           window.location.href = document.referrer;
                       });
                   }
            })
    }
</script>
@endsection