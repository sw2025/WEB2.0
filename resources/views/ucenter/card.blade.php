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
                            <input type="text" class="card-sum bank-card" placeholder="请输入卡号" />
                            <span class="must">*</span>
                        </p>
                        <p class="card-name">
                            <label for="">户主</label>
                            <input type="text" class="card-sum" placeholder="请输入姓名" />
                            <span class="must">*</span>
                        </p>
                        <div class="card-bank">
                            <label for="">银行</label>
                            <div class="card-bank-sel">
                                <a class="card-bank-open">请选择开户行</a>
                                <ul class="card-bank-list">
                                    <li>中国银行</li>
                                    <li>中国农业银行</li>
                                </ul>
                            </div>
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
</script>
@endsection