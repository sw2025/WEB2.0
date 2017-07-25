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
                        <button class="cash-btn" type="button">提现</button>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $('.cash-btn').click(function() {
            var userId=$.cookie("userId")
            var $enterVal = $('.cash-num').val();
            var $num = parseFloat($enterVal).toFixed(2);
            var $leftNum = $('.avai-money-sum').html();
            // alert($num)
            if(parseFloat($leftNum - $num).toFixed(2) < 0){
                layer.alert('可用金额不足，无法提现', {
                    title:false,
                    closeBtn: 0
                });
            }else{
                $.ajax({
                    url:"{{asset('applicationCash')}}",
                    data:{"userId":userId,"money":money},
                    dateType:"json",
                    "type":"POST",
                    success:function(res){
                        if(res['code']=="success"){
                            layer.msg("提现成功");
                            window.locarion.href="{{asset('uct_recharge')}}"
                        }else{
                            layer.msg("提现失败");
                        }
                    }
                })
            }
        });
    })
</script>
@endsection