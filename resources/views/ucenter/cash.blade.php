@extends("layouts.ucenter")
@section("content")
    <div class="main">
            <!-- 提现金额 / start -->
            <h3 class="main-top">提现金额</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="available-money">
                        可用余额<span class="avai-money-all"><i class="iconfont icon-jinbi"></i><em class="avai-money-sum">{{$balance or 0}}</em>元</span>
                    </div>
                    <div class="card-enter">
                        <p class="card-must">
                            <label for="">提现金额</label><input type="text" class="cash-num" placeholder="请输入金额" />
                        </p>
                        <button class="cash-btn" type="button">提现申请</button>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        var $enterValPre=$('.avai-money-sum').html();
        $(".cash-num").on("mouseout",function(){
            var $enterVal = $('.cash-num').val();
            var $leftNum = $('.avai-money-sum').html();
            if($enterVal){
                var $num = parseFloat($enterVal).toFixed(2);
                var surplusMoney=parseFloat($leftNum - $num).toFixed(2);
                if(surplusMoney < 0) {
                    layer.confirm('可用金额不足，无法提现', {
                        btn: ['确定'] //按钮
                    });
                    $(".cash-btn").hide();
                }else{
                    $enterValPre=$leftNum;
                    $('.avai-money-sum').html(surplusMoney)
                    $(".cash-btn").show();
                }
            }else{
                $('.avai-money-sum').html($enterValPre)
                $(".cash-btn").show();
            }
        })
        $('.cash-btn').click(function() {
            var userId=$.cookie("userId");
            var $money = $('.cash-num').val();
            var $leftNum = $('.avai-money-sum').html();
            if($money){
                var $num = parseFloat($money).toFixed(2);
                var surplusMoney=parseFloat($leftNum - $num).toFixed(2);
                if(surplusMoney < 0) {
                    layer.confirm('可用金额不足，无法提现', {
                        btn: ['确定'] //按钮
                    });
                }else{
                    $enterValPre=$leftNum;
                    $('.avai-money-sum').html(surplusMoney)
                    $.ajax({
                        url:"{{asset('applicationCashs')}}",
                        data:{"userId":userId,"money":$money},
                        dateType:"json",
                        "type":"POST",
                        success:function(res){
                            if(res['code']=="success"){
                                layer.confirm('稍后将为您处理', {
                                    btn: ['确定'] //按钮
                                }, function(){
                                    window.location.href="{{asset('uct_recharge')}}"
                                });
                            }else{
                                layer.msg("提现申请失败");
                            }
                        }
                    })
                }
            }else{
                $('.avai-money-sum').html($enterValPre)
                alert("请输入提现金额")
            }
        });
    })
</script>
@endsection