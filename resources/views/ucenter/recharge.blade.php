@extends("layouts.ucenter")
@section("content")
        <!-- 充值提现 / start -->
        <div class="main">
            <h3 class="main-top">充值提现</h3>
            <div class="ucenter-con">
                <div class="main-right clearfix">
                    <div class="remaining ">
                        <div class="remain-top clearfix">
                            <span class="remain-num">余额<em>1000</em></span>
                            <div class="remain-state">
                                <span><i class="iconfont icon-shouru"></i>收入：200</span>
                                <span><i class="iconfont icon-zhichu"></i>支出：200</span>
                                <span><i class="zaitu"></i>在途：200</span>
                            </div>
                        </div>
                        <div class="remain-bottom">
                            <a href="{{asset('uct_recharge/rechargeMoney')}}" class="recharge-money">充值</a>
                            <a href="{{asset('uct_recharge/cash')}}" class="cash">提现</a>
                        </div>
                    </div>
                    <div class="upload-bankcard">
                        <!-- 已上传银行卡start -->
                        <div class="uploaded-img">
                            <img class="bankcard-img" src="img/bank.jpg" />
                            <span class="delete-card" title="删除"><i class="iconfont icon-chahao"></i></span>
                        </div>
                        <!-- 已上传银行卡end -->
                        <!-- 未上传银行卡start -->
                        <div class="card-upload">
                            <div class="card-span fileinput-button">
                                <span class="card-upload-tip"><i class="iconfont icon-add"></i>添加银行卡</span>
                                <input id="" type="file" name="files[]" data-url="" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="money-category clearfix">
                    <div class="money-cate-fr">
                        <span class="money-cate-fr-cap">类型</span><a href="javascript:;" class="money-cate-def">收入</a>
                        <ul class="money-cate-list">
                            <li>收入</li>
                            <li>支出</li>
                            <li>在途</li>
                        </ul>
                    </div>
                </div>
                <h3 class="main-top reduce">充值列表</h3>
                <div class="main-right paycheck">
                    <div class="paycheck-wrap">
                        <table class="paycheck-list">
                            <thead>
                            <tr>
                                <th>单号</th>
                                <th>金额</th>
                                <th>描述</th>
                                <th>时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>2100000</td>
                                <td>+1000</td>
                                <td>充值</td>
                                <td>2017-07-12</td>
                            </tr>
                            <tr>
                                <td>2100000</td>
                                <td>+1000</td>
                                <td>充值</td>
                                <td>2017-07-12</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pages myinfo-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("15");
    })
</script>
@endsection