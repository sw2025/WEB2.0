@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <h3 class="main-top">绑定银行卡</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step">
                    <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>信息验证
                </div>
                <div class="card-enter">
                    <p class="card-must">
                        <label for="">金额</label><input type="text" class="card-sum" placeholder="请输入金额" /><span class="must">*</span>
                    </p>
                    <button class="test-btn" type="button">验证</button>
                </div>
            </div>
        </div>
    </div>
@endsection