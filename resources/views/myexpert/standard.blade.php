@extends("layouts.ucenter")
@section("content")
    <!-- 公共header / start -->
            <div class="main">
                <h3 class="main-top">收费标准</h3>
                <!-- 收费标准 / start -->
                <div class="ucenter-con">
                    <div class="main-right">
                        <div class="recharge-sum standards">
                            <span class="recharge-opt focus others">
                                <input class="rad-inp" checked="true" type="radio" id="rad4" name="money">
                                <label for="rad4" class="recharge-radio"><span></span>收费</label><input type="text" placeholder="请输入金额" readonly="" id="money" class="recharge-inp-sum">&nbsp;&nbsp;元/次
                            </span>
                            <span class="recharge-opt">
                                <input class="rad-inp" type="radio" id="rad1" name="money">
                                <label for="rad1" class="recharge-radio"><span></span>免费</label>
                            </span>
                        </div>
                        <div class="uct-works-tips standard-intro">
                            说明：共享单车新规发布：禁止向未满12岁儿童提供
                        </div>
                        <div class="recharge-btn-box">
                            <button class="test-btn recharge-submit" id="submit" type="button">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 收费标准 / end -->
    <!-- 公共footer / end -->
    <script>
        $(function(){
            $('#submit').click(function () {
                var fee=$('#money').val();
                $('#submit').attr('disabled','disabled');
                $.ajax({
                    url:"{{asset('/uct_standard')}}",
                    data:{'fee':fee},
                    dataType:"json",
                    type:"POST",
                    success:function(data){
                        if (data.icon == 1){
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                                window.location = '{{asset('/uct_expert2')}}';
                            });
                        } else {
                            layer.msg(data.msg,{'time':2000,'icon':data.icon});
                        }
                    }
                })
            })
        });
    </script>
@endsection