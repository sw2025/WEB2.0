@extends("layouts.ucenter")
@section("content")
    <!-- 充值提现 / start -->
    <div class="main">
        <h3 class="main-top">充值</h3>
        <div class="ucenter-con">
            <div class="main-right clearfix">
                <div class="remaining ">
                    <div class="remain-top clearfix">
                        <span class="remain-num"><em>{{$members}}</em></span>
                        <div class="remain-state">
                            <span><i class="iconfont icon-shouru"></i>剩余办事次数：{{$eventCount}}次</span>
                            <span><i class="iconfont icon-zhichu"></i>剩余视频咨询时长：{{$consultCount}}分钟</span>
                        </div>
                    </div>
                    <div class="remain-bottom">
                        <a href="{{asset('uct_recharge/rechargeMoney')}}" class="recharge-money">开通会员</a>
                    </div>
                </div>
                <div class="upload-bankcard">
                    <!-- 已上传银行卡start -->

                        <div class="uploaded-img" @if($state==0||$state==2||$state==3||$state==4)style="display: block"@else style="display: none" @endif>

                            <div class="bankcard-img" ><em>卡号@if($state==3)(审核失败)@elseif($state==2)(待系统审核)@elseif($state==4)(待打款验证)@endif</em>{{$bankcard}}</div>
                            @if($state==4)<a href="{{asset('uct_recharge/card2')}}"><button type="button">去验证</button></a>@endif

                            <span class="delete-card" title="删除"><i class="iconfont icon-chahao"></i></span>
                        </div>
                    <!-- 已上传银行卡end ---->
                    <!-- 未上传银行卡start -->
                    <div class="card-upload" @if(empty($bankcard) || $state==1)style="display:block" @else style="display: none" @endif>
                        <div class="card-span fileinput-button">
                            <span class="card-upload-tip" ><a href="{{asset('uct_recharge/card')}}"><i class="iconfont icon-add"></i>添加银行卡</a></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="money-category clearfix">
                <div class="money-cate-fr">
                    <span class="money-cate-fr-cap">类型</span><a href="javascript:;" class="money-cate-def" id="moneyList">支出</a>
                    <ul class="money-cate-list" id="cateList">
                        <li>支出</li>
                        <li>开通会员</li>
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
        var returnRecord=function(type,startPage,role){
            $("#tbody").empty();
            $.ajax({
                url:"{{asset('getRecord')}}",
                data:{"startPage":startPage,"type":type,'role':role},
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

        returnRecord(type,startPage,"企业");

        function pageselectCallback(page_index,jq){
             var startPage=parseInt(page_index)+1;
             var type=$("#moneyList").text();
            returnRecord(type,startPage,"企业")
         }
        $("#cateList").on("click","li",function(){
            var type=$(this).text();
            var startPage=1;
            returnRecord(type,startPage,"企业")
        })

    })
    $(".cash").on("click",function(){
        $.ajax({
            url:"{{url('haveCard')}}",
           dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']==0){
                    layer.confirm('您尚未绑定银行卡？', {
                        btn: ['去绑定','暂不需要'], //按钮
                    }, function(){
                        window.location.href="{{asset('uct_recharge/card')}}";
                    }, function(){
                        layer.close();
                    });
                }else if(res['code']==2){
                    layer.confirm('您银行卡尚未绑定成功!');
                }else{
                    window.location.href="{{url('uct_recharge/cash')}}";
                }
            }

        })
    })
    $('.delete-card').click(function() {
        var userId=$.cookie("userId");
        layer.confirm('您确定删除该银行卡吗？', {
            btn: ['删除','取消'], //按钮
        }, function(){
            $.ajax({
                url:"{{asset('updateCard')}}",
                data:{"userId":userId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){
                        $(".delete-card").parent().hide();
                        $(".delete-card").parent().next().show();
                        layer.msg("删除成功!");
                    }else{
                        layer.msg("删除失败!")
                    }
                }
            })
        });
    });

</script>
@endsection