@extends("layouts.ucenter4")
@section("content")
    <div class="bg_v2">
        <div class="card-step works-step">
            <span class="green-circle">1</span>发起约见<span class="card-step-cap">&gt;</span>
            <span class="green-circle">2</span>等待确认<span class="card-step-cap">&gt;</span>
            <span class="green-circle">3</span>确认约见<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">4</span>线下约谈<span class="card-step-cap"></span>
        </div>
        <div class="invite-experts">
            <table class="invite-table">
                <tr>
                    <td>企业名称</td>
                    <td>{{$datas->enterprisename}}</td>
                </tr>

                <tr>
                    <td>企业行业</td>
                    <td>{{$datas->industry}}</td>
                </tr>
                <tr>
                    <td>发起约见时间</td>
                    <td>{{$datas->puttime}}</td>
                </tr>

                <tr>
                    <td>咨询描述</td>
                    <td>{{$datas->contents}}</td>
                </tr>
                <tr>
                    <td>约见时长</td>
                    <td>{{$datas->timelot}}小时</td>
                </tr>
                <tr>
                    <td>我的收益</td>
                    <td>{{$datas->price}}</td>
                </tr>
            </table>

        </div>
        <br><br><br><br>
        <div>
            <span class="accept" style="width: 200px;margin-left:400px;">已确认</span>
        </div>
        <div class="respond-btn-box">
            <!-- 状态按钮根据实际状态只展示一个 -->
           {{-- @if($datas->configid == 4)
                <button type="button" class="unrespond respond-btn" onclick="responseevent({{$datas->consultid}},this)">响应</button>
            @elseif($datas->configid == 5)
                <button type="button" class="responded respond-btn">已响应</button>
            @elseif($datas->configid == 7)
                <span class="respond-tips">已完成</span>
            @else
                <span class="respond-tips">请等待企业邀请，未获企业邀请</span>
            @endif--}}
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.bank-card').keyup(function(){
                var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
                $(this).val(value)
            })
        })


        function responseevent(id,obj){
            $(obj).attr('disabled',true);
            $(obj).html('正在响应');
            $.post('{{url('uct_linemeetexpert/requestLineMeet')}}',{'id':id}, function (data){
                if(data.icon == 2){
                    layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                        $(obj).attr('disabled',false);
                        $(obj).html('响应');
                        window.location.href = window.location.href;
                    });
                } else {
                    layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                        window.location.href = window.location.href;
                    });
                }
            })
        }
    </script>
@endsection