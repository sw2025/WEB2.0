@extends("layouts.master")
@section("content")

    <!-- 我的钱包 -->


    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/myPackage.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages.css')}}">
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <style>
        .sw-article-para {
            height: 240px;
            overflow: hidden;
        }
        .meettype{
            border: 1px solid #000;
            border-radius: 5px;
            padding: 0px 3px 0px 3px;
            font-size: 17px;
            margin-top:-1px;
        }
        #gotoverify{
            background: #e25633;
            border: 2px solid #fff2f2;
            padding: 3px;
            border-radius: 5px;
            color: #fff;
        }
    </style>
<script type="text/javascript">
    $(function(){
        //  删除银行卡按钮
        $('.sw-uploaded-img').hover(function () {
            if (!$('.cardNumber').html()){
                return;
            }
            $(this).children('.delete-card').stop().toggle();
        })
    })
</script>

    <!-- banner -->
   {{-- <div class="junior-banner">
        <div class="swcontainer">
            <div class="jun-banner-cap">
                <a href="#" class="jun-banner-btn">创业孵化</a>
                <span class="jun-banner-intro">在线提交创业项目</span>
                <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
            </div>
        </div>
    </div>--}}
    <!-- 主体 -->
    <div class="swcontainer sw-ucenter">
        <!-- 个人中心左侧 -->
        @include('layouts.expucenter')
    <!--样式初始化-->



    <!-- 个人中心右侧 -->
    <div class="sw-mains">
        <!-- 主体 -->
        <h1 style="font-size: 22px;color: #e25633;margin-bottom: 25px;">我的钱包 <i class="iconfont" style="font-size: 23px;">&#xe61c;</i></h1>

        <div class="my-money">
            <div class="my-money-top">
                <div class="m-t-left">
                    <div class="m-t-l-income"><span><b>总收入&nbsp;&nbsp;￥</b>{{$incomes or 0}}</span><a href="{{asset('recharge/cash')}}" class="sw-apply-btn">申请提现</a></div>
                    <div class="m-t-l-income"><span><b>已提现&nbsp;&nbsp;￥</b>{{$pays or 0}}</span></div>
                    <div class="m-t-l-income"><span><b>未提现&nbsp;&nbsp;￥</b>{{$balance or 0}}</span><a href="{{url('expmycharge/chargeStandard')}}" class="sw-recharge-btn">收费设置</a></div>
                </div>
                <div class="sw-upload-bankcard">
                    <!-- 已上传银行卡start -->
                        <div class="sw-bankcard-img"><em>卡号@if($state==3)(审核失败)@elseif($state==2)(待审核)@elseif($state==4)(待验证)@endif</em>
                            <span class="cardNumber">{{$bankcard}}</span>
                            @if($state==4)<a class="gototest" href="{{asset('expmycharge/card2')}}"><button type="button" id="gotoverify">去验证</button></a>@endif
                        </div>
                        <span class="delete-card" title="删除" style="display: none; opacity: 1;"><i class="iconfont icon-chahao"></i></span>
                    </div>
                    <!-- 已上传银行卡end ---->
                    <!-- 未上传银行卡start -->
                    <div class="sw-card-upload" @if(empty($bankcard) || $state==1)style="display:inline-block" @else style="display: none" @endif>
                        <div class="card-span fileinput-button">
                            <span class="swcard-upload-tip"><a href="{{asset('expmycharge/card')}}"><i class="iconfont icon-add"></i>添加银行卡</a></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="my-money-list clearfix">
                <div class="my-money-table-wrapper">
                    <table class="my-money-table">
                        <thead>
                        <tr>
                            <th><div><a href="javascript:;">单号<i class="iconfont icon-sanjiaoxingshangla"></i></a></div></th>
                            <th>
                                <div><a href="javascript:;">金额<i class="iconfont icon-shangxiajiantou2"></i></div></a>
                            </th>
                            <th><div>名称</div></th>
                            <th><div><a href="javascript:;">时间<i class="iconfont icon-sanjiaoxingxiala"></i></a></div></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                <div class="pages">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage" id="allPage"></strong>页</span>
                    <input type="hidden" id="startPage" value="">
                </div>
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
                    $("#Pagination").pagination(counts,{'callback':pageselectCallback,'current_page':currentPage,'link_to':'javascript:;'});
                }
            })
        }
        var type='收入';
        var startPage=1;
        returnRecord(type,startPage,"专家");
        function pageselectCallback(page_index,jq){

            var startPage=parseInt(page_index)+1;
            var type='收入';
            returnRecord(type,startPage,"专家")
        }
        $("#cateList").on("click","li",function(){
            var type=$(this).text();
            var startPage=1;
            returnRecord(type,startPage,"专家")
        })

    })
    $(".cash").on("click",function(){
        $.ajax({
            url:"{{url('expertHaveCard')}}",
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
<!-- 底部 -->
@endsection