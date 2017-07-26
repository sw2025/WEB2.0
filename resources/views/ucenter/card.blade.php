@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 绑定银行卡 / start -->
            <h3 class="main-top">绑定银行卡</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">2</span>信息验证
                    </div>
                    <div class="card-enter">
                        <p class="card-number">
                            <label for="">卡号</label>
                            <input type="text" class="card-sum bank-card" name="bankCard" id="bankCard" placeholder="请输入卡号" />
                            <span class="must">*</span>
                        </p>
                        <p class="card-name">
                            <label for="">户主</label>
                            <input type="text" class="card-sum bank-account" name="account" id="account" placeholder="请输入姓名" />
                            <span class="must">*</span>
                        </p>
                        <div class="card-bank">
                            <label for="">银行</label>
                            <div class="card-bank-sel">
                                <a class="card-bank-open" id="bankName">请选择银行</a>
                                <ul class="card-bank-list">
                                    <li>中国银行</li>
                                    <li>中国农业银行</li>
                                </ul>
                            </div>
                            <span class="must">*</span>
                        </div>
                        <div class="card-name">
                            <label for="">开户行</label>
                            <input type="text" class="card-sum bank-full" name="bankFullName" id="bankFullName" placeholder="请输入开户行" />
                            <span class="must">*</span>
                        </div>
                        <button class="test-btn card-submit" type="button">提交</button>
                        <span class="card-tip">*将为您的账号打入一笔小于1元的金额</span>
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
    $("#bankCard").on("blur",function(){
        var bankCard=$("#bankCard").val();
        $.ajax({
            url:"{{asset('getBankName')}}",
            data:{"bankCard":bankCard},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    bankName=$("#bankName").text(res['msg']);
                }else{
                    layer.msg("暂未匹配到银行信息")
                }
            }
        })
    });
    $(".card-submit").on("click",function(){
        var bankCard=$("#bankCard").val();
        var account=$("#account").val();
        var bankName=$("#bankName").text();
        alert(bankName);
        var bankFullName=$("#bankFullName").val();
        if(!bankCard){
            layer.tips("卡号不能为空", '.bank-card', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(!account){
            layer.tips("户主不能为空", '.bank-account', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(!bankName){
            layer.tips("银行不能为空", '.card-bank-open', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(!bankFullName){
            layer.tips("开户行不能为空", '.bank-full', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        $.ajax({
            url:"{{asset('cardHandle')}}",
            data:{"bankCard":bankCard,"account":account,"bankName":bankName,"bankFullName":bankFullName},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    window.location.href="{{asset('uct_recharge/card2')}}"
                }else{
                    layer.msg("提交失败")
                }
            }
        })




    })
</script>
@endsection