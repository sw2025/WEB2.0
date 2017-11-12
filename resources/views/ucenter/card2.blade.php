@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/uctcard.css')}}" />

    <div class="main">
            <!-- 绑定银行卡 / start -->
            <h3 class="main-top">绑定银行卡</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">2</span>信息验证
                    </div>
                    <div class="card-enter">
                        <p class="card-must">
                            <label for="">金额</label><input type="text" class="card-sum" placeholder="请输入金额" name="money" id="money" /><span class="must">*</span>
                        </p>
                        <button class="test-btn" type="button">验证</button>
                    </div>
                </div>
            </div>
        </div>
    <script>

        $(".test-btn").on("click",function(){
            var money=$("#money").val();
            var userId=$.cookie("userId");
            if(!money){
                layer.tips("金额不能为空", '.card-sum', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }
            $.ajax({
                url:"{{asset('verifyCard')}}",
                data:{"userId":userId,"money":money,"action":"verify"},
                dateType:"json",
                "type":"POST",
                success:function(res){
                    if(res['code']=="success"){
                        $("#money").val(money);
                        $(".test-btn").hide();
                        layer.msg("验证成功",function () {
                            window.location = '{{url('uct_recharge')}}';
                        });

                    }else{
                        layer.msg("验证失败");
                    }
                }
            })

        })
    </script>
  @endsection