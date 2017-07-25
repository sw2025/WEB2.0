@extends("layouts.ucenter")
@section("content")
    <!-- 充值提现 / start -->
    <div class="main">
        <h3 class="main-top">充值提现</h3>
        <div class="ucenter-con">
            <div class="main-right clearfix">
                <div class="remaining ">
                    <div class="remain-top clearfix">
                        <span class="remain-num">余额<em>{{$balance or 0}}</em></span>
                        <div class="remain-state">
                            <span><i class="iconfont icon-shouru"></i>收入：{{$incomes or 0}}</span>
                            <span><i class="iconfont icon-zhichu"></i>支出：{{$pays or 0}}</span>
                            <span><i class="zaitu"></i>在途：{{$expends or 0}}</span>
                        </div>
                    </div>
                    <div class="remain-bottom">
                        <a href="{{asset('uct_recharge/rechargeMoney')}}" class="recharge-money">充值</a>
                        <a href="{{asset('uct_recharge/cash')}}" class="cash">提现</a>
                    </div>
                </div>
                <div class="upload-bankcard">
                    <!-- 已上传银行卡start -->

                        <div class="uploaded-img" @if(!empty($bankcard))style="display: block"@else style="display: none" @endif>
                            <div class="bankcard-img" ><em>卡号</em>{{$bankcard}}</div>
                            <span class="delete-card" title="删除"><i class="iconfont icon-chahao"></i></span>
                        </div>
                    <!-- 已上传银行卡end -->
                    <!-- 未上传银行卡start -->
                    <div class="card-upload" @if(!empty($bankcard))style="display: none" @else style="display: block" @endif>
                        <div class="card-span fileinput-button">
                            <span class="card-upload-tip" ><a href="{{asset('uct_recharge/card')}}"><i class="iconfont icon-add"></i>添加银行卡</a></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="money-category clearfix">
                <div class="money-cate-fr">
                    <span class="money-cate-fr-cap">类型</span><a href="javascript:;" class="money-cate-def" id="moneyList">收入</a>
                    <ul class="money-cate-list" id="cateList">
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
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                <div class="pages myinfo-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage" id="allPage"></strong>页</span>
                    <input type="hidden" id="startPage" value="">
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function(){
        var returnRecord=function(type,startPage){
            $("#tbody").empty();
            $.ajax({
                url:"{{asset('getRecord')}}",
                data:{"startPage":startPage,"type":type},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){
                        var str="";
                        $.each(res['msg'],function(key,value){
                            str="<tr><td>"+value.payno+"</td><td>"+value.money+"</td><td>"+value.brief+"</td><td>"+value.created_at+"</td></tr>";
                            $("#tbody").append(str);
                        })
                        $("#allPage").text(res['counts']);
                        $("#startPage").val(res['startPage']);
                        counts=res['counts'];
                        currentPage=res['startPage']-1;

                    }else{
                        layer.msg("暂无数据")
                        $("#allPage").text(0);
                        counts=res['counts'];
                        currentPage=0;
                    }
                    $("#Pagination").pagination(counts,{'callback':pageselectCallback,'current_page':currentPage});
                }
            })
        }
        var type=$("#moneyList").text();
        var startPage=1;
        returnRecord(type,startPage);
        function pageselectCallback(page_index,jq){
             var startPage=parseInt(page_index)+1;
             var type=$("#moneyList").text();
             returnRecord(type,startPage)
         }
        $("#cateList").on("click","li",function(){
            var type=$(this).text();
            var startPage=1;
            returnRecord(type,startPage)
        })

    })

</script>
@endsection