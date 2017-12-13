@extends("layouts.ucenter4")
@section("content")
    <div class="bg_v2">
        <div class="card-step works-step">
            <span class="green-circle">1</span>咨询申请<span class="card-step-cap">&gt;</span>
            <span class="green-circle">2</span>咨询审核<span class="card-step-cap">&gt;</span>
            <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
            <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">5</span>咨询管理<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">6</span>完成
        </div>
        <div class="invite-experts">
            <table class="invite-table">
                <tr>
                    <td>企业名称</td>
                    <td>{{$datas->enterprisename}}</td>
                </tr>
                <tr>
                    <td>办事分类</td>
                    <td>{{$datas->domain1.'/'.$datas->domain2}}</td>
                </tr>
                <tr>
                    <td>企业行业</td>
                    <td>{{$datas->industry}}</td>
                </tr>
                <tr>
                    <td>咨询开始时间</td>
                    <td>{{$datas->starttime}}</td>
                </tr>
                <tr>
                    <td>咨询结束时间</td>
                    <td>{{$datas->endtime}}</td>
                </tr>
                <tr>
                    <td>咨询描述</td>
                    <td>{{$datas->brief}}</td>
                </tr>
            </table>
        </div>
        <div class="respond-btn-box">
            <!-- 状态按钮根据实际状态只展示一个 -->
            @if($datas->configid == 4)
                <button type="button" class="unrespond respond-btn" onclick="responseevent({{$datas->consultid}},this)">响应</button>
            @elseif($datas->configid == 5)
                <button type="button" class="responded respond-btn">已响应</button>
            @elseif($datas->configid == 7)
                <span class="respond-tips">已完成</span>
            @else
                <span class="respond-tips">请等待企业邀请，未获企业邀请</span>
            @endif
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.bank-card').keyup(function(){
                var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
                $(this).val(value)
            })
        })

       /* function responseconsult(consultid){
            $.post('{{url('uct_myask/responseconsult')}}',{'consultid':consultid,'token':'{{$token}}'}, function (data){
                if(data.icon == 2){
                    layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                        window.location = '{{url('/')}}';
                    });
                } else {
                    layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                        window.location.href = document.referrer;
                    });
                }
            })
        }*/
        function responseevent(consultid,obj){
            $(obj).attr('disabled',true);
            $(obj).html('正在响应');
            $.post('{{url('uct_myask/responseconsult')}}',{'consultid':consultid}, function (data){
                if(data.icon == 2){
                    layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                        $(obj).attr('disabled',false);
                        $(obj).html('响应');
                        window.location = '{{url('/')}}';
                    });
                } else {
                    layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                        window.location.href = '{{url('uct_myask')}}';
                    });
                }
            })
        }
    </script>
@endsection