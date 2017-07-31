@extends("layouts.ucenter")
@section("content")
    <div class="main">
            <!-- 我的视频咨询 / start -->
            <h3 class="main-top">我的视频咨询</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name">
                        {{$datas->enterprisename}}
                    </div>
                    <div class="mywork-det">
                        <span class="myask-detail-need"><em class="light-color myask-detail-cap">需求分类：</em>{{$datas->domain1.' / '.$datas->domain2}}</span>
                        <span class="myask-detail-time"><em class="light-color">时间：</em>{{$datas->consulttime}}</span>
                        <div class="mywork-det-txt">
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">{{$datas->brief}}</p>
                            </div>
                        </div>
                        <div class="respond-btn-box">
                            <!-- 状态按钮根据实际状态只展示一个 -->
                            @if($datas->configid == 4)
                                <button type="button" class="unrespond respond-btn" onclick="responseevent({{$datas->consultid}})">响应</button>
                            @elseif($datas->configid == 5)
                                <button type="button" class="responded respond-btn">已响应</button>
                            @else
                                <span class="respond-tips">请等待企业邀请，未获企业邀请</span>
                            @endif
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

    function responseconsult(consultid){
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
    }
</script>
@endsection