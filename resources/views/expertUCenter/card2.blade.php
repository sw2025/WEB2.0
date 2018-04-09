@extends("layouts.master")
@section("content")
    <style>
        /***********更换手机号 end***********/
        /***********绑定银行卡 start***********/
        .card-step,.myneed-com-name{/*border-bottom: 2px solid #dcdcdc;*/font-size: 16px;color:#333;text-align: center;padding: 14px 0;margin:0 20px;line-height: 28px;}
        .green-circle,.gray-circle{font-weight: bold;color:#fff;width: 28px;height: 28px;display: inline-block;background:#2fd887;border-radius: 20px;text-align: center;line-height: 28px;margin-right: 14px;}
        .gray-circle{background: #d4d4d4;}
        .card-step-cap{margin:0 30px;}
        .card-enter{text-align: center;}
        .card-must{color:#666;padding:115px 0;}
        .card-sum,.card-bank-open{width: 300px;}
        .card-sum,.card-bank-open,.cash-num{height: 30px;line-height: 30px;background:#eaeaea;margin:0 10px;padding-left: 10px;}
        .must{color:#ff1919;font-size: 20px;display: inline-block;vertical-align: middle;}
        .test-btn,.cash-btn{display: inline-block;width: 250px;height: 40px;text-align: center;line-height: 40px;background:#61498f;border: none;border-radius: 4px;color:#fff;font-size: 16px;margin-bottom: 50px;}
        .card-number{padding-top: 50px;padding-bottom: 34px;}
        .card-name,.card-bank{padding-bottom: 34px;}
        .card-number label,.card-name label,.card-bank label{display:inline-block;width:3em;text-align:right;}
        .card-submit{margin-bottom: 10px;margin-top: 65px;}
        .card-tip{color: #999;display: block;padding-bottom: 20px;}
        .card-bank-sel{display: inline-block;position: relative;width: 330px;}
        .card-bank-open{display: block;color: #ABABAB;text-align: left;position: relative;}
        .card-bank-open:before{font-family: "iconfont";content: "\e618";background: #61498f;position: absolute;color: #fff;width: 30px;text-align: center;top: 0;right: 0;}
        .card-bank-list{position: absolute;top: 30px;left: 10px;text-align: left;background: #fff;width: 310px;display: none;}
        .card-bank-list li{margin: 2px 0;padding: 5px 0 5px 10px;}
        .card-bank-list li:hover{background: #f5f5f5;}
        /***********绑定银行卡 end***********/
        /***********充值 start***********/
        .recharge-sum{padding: 70px 0 55px;margin: 0 90px;text-align: center;border-bottom: 2px solid #eaeaea;}
        .recharge-opt{position: relative;margin-left: 40px;color: #666;}
        .recharge-radio span{display: inline-block;width: 8px;height: 8px;border: 2px solid #eaeaea;border-radius: 10px;background: #eaeaea;margin-right: 10px;vertical-align: -1px;}
        .rad-inp{opacity: 0;position: absolute;top: 0;left: 0;filter:alpha(opacity=0);}
        .focus .recharge-radio span{border-color: #2fd887;}
        .recharge-inp-sum{width: 110px;height: 30px;padding-left: 10px;background: #eaeaea;margin-left: 10px;}
        .recharge-way{text-align: center;padding: 55px 0;}
        .way-img{display: inline-block;}
        .way-cap{display: inline-block;vertical-align: -7px;margin-left: 12px;}
        .recharge-btn-box{text-align: center;}
    </style>
    <div class="swcontainer sw-ucenter">
        <!-- 个人中心左侧 -->
        @include('layouts.expucenter')
                <!--样式初始化-->
        <div class="sw-mains">
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
                            window.location.href="{{asset('/expmycharge/myCharge')}}"
                        });

                    }else{
                        layer.msg("验证失败");
                    }
                }
            })

        })
    </script>
  @endsection