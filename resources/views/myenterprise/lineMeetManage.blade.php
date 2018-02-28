@extends("layouts.ucenter1")
@section("content")
    <div class="vmain-manage-list clearfix">
        <div class="v-works-manage-list-top clearfix">
           {{-- <div class="v-works-sel">
                <span class="allwork">全部咨询</span>
                <a href="javascript:;" class="v-works-sel-def" id="domainType">{{$type or "不限"}}</a>
                --}}{{--<ul class="v-works-sel-list domainType" style="display: none;">
                    <li @if($type && $type=="不限") class="active" @endif>不限</li>
                    @foreach($domains as $value)
                        <li @if($type && $type ==$value->domainname) active @endif>{{$value->domainname}}</li>
                    @endforeach
                </ul>--}}{{--
            </div>--}}

            <div class="v-works-sel">
                <span class="allwork">全部状态</span>
                <a href="javascript:;" class="v-works-sel-def" id="type">{{$type or "不限"}}</a>
                <ul class="v-works-sel-list type" style="display: none;">
                    <li class="active">不限</li>
                    <li>已提交</li>
                    <li>未通过</li>
                    <li>已通过</li>
                    <li>已完成</li>
                </ul>
            </div>
            {{--<div class="v-works-sel">
                <span class="allwork">咨询模式</span>
                <a href="javascript:;" class="v-works-sel-def" id="consultType">{{$consultType or "不限"}}</a>
                <ul class="v-works-sel-list consultType" style="display: none;">
                    <li class="active">不限</li>
                    <li>单人</li>
                    <li>多人</li>
                </ul>
            </div>--}}
            <div class="v-supply-con" style="display: none;">
                <h2>办事规则介绍</h2>根据用户提出的领域分类和描述系统可以匹配此类专家或者用户自选专家后按照办事流程开始办事<br>办事流程介绍：
                <p style="color:#000;font-weight: bold;">办事申请→专家响应→选择专家→进入办事→办事完成</p>
            </div>
            <a href="{{'expert'}}?role=专家&ordertime=desc" class="goto-work" id="linemeet"><i class="iconfont icon-woyaobanshi"></i>我要约谈</a>
        </div>
        <ul class="v-manage-list-ul clearfix">
            @if($datas->lastpage())
                @foreach($datas as $data)
                    <li>
                        <a href="{{asset('uct_linemeet/detail/'.$data->id)}}" class="v-manage-list-ul-link" style="padding-bottom: 42px;">
                            <div class="v-manage-link-top">
                                <div class="v-manage-link-tit">
                                    <strong class="v-manage-link-sentit">{{$data->expertname}}</strong>
                                    <span class="biaoqian">{{$data->domain2}}</span>
                                </div>
                            </div>
                            <p class="v-manage-link-desc">
                                {{$data->contents}}
                            </p>
                          @if($data->configid=="1")
                                <span class="now-state state-ts">已发起约见</span>
                            @elseif($data->configid=="2")
                                <span class="now-state state-ts">等待专家确认</span>
                            @elseif($data->configid=="3")
                                <span class="now-state state-jx">约见</span>
                            @elseif($data->configid=="4")
                                <span class="now-state state-wc">已完成</span>
                            @endif
                            <div class="v-manage-link-time">
                                <span><i class="iconfont icon-shijian2"></i>{{$data->puttime}}</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            @else
                <li>
                    <div class="v-supply-tip">
                        <span class="v-supply-tip-top"><strong>升维网</strong>海量专家提供线下约谈</span>
                        <div class="v-supply-tactic"><span>找资金</span><span>找技术</span><span>找市场</span><span>定战略</span></div>
                        <div class="rules">
                            <h2>约谈规则介绍</h2>
                            <p>1.企业用户选择需要约谈的专家，详细填约谈的问题描述。</p>
                            <p>2.专家接受后，企业支付专家一定的费用，双方约谈，完成。</p>
                        </div>
                        <div class="mygo">
                            <a href="{{asset('expert')}}?role=专家&ordertime=desc" class="goto-work1" id="linemeet1"><i class="iconfont icon-woyaobanshi"></i>我要约谈</a>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
        <div class="pages myinfo-page v-page">
            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
        </div>
</div>
<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        // 提示申请服务内容
        var $html = '<h2>线下约见</h2>1.企业用户选择需要咨询的分类，详细填写咨询的描述。<br/>2.系统按咨询的分类为企业自动匹配专家进行推送，企业也可以自主选择心仪的专家进行推送。<br/>3.专家接受后，企业可选择一对一咨询也可选择多人会议（最多两人），双方达成合作，可在指定时间召开会议。';
        $('.goto-work').hover(function(){
            $('.v-supply-con').html($html).show();
        },function(){
            $('.v-supply-con').hide();
        });
       /* $('.v-works-mlt-opt').click(function(event) {
            $(this).addClass('active').siblings().removeClass('active');
            window.location.href="?type="+$(this).text();
        });*/
        $(document).click(function(){
            $('.v-works-sel-list').hide();
        })
        $('.v-works-sel .v-works-sel-def').click(function(event) {
            event.stopPropagation();
            $(this).next('ul').slideToggle();
        });
       /* $('.domainType li').click(function(event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var configType=$('#configType').text();
            var consultType=$('#consultType').text();
            window.location.href="?type="+selHtml+"&configType="+configType+"&consultType="+consultType;
        });*/

        $('.type li').click(function(event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            //var domain=$('#domainType').text();
            //var consultType=$('#consultType').text();
            window.location.href="?type="+selHtml;
        });

       /* $('.consultType li').click(function(event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            //var domain=$('#domainType').text();
            var type=$('#type').text();
            alert(type);
            window.location.href="?type="+domain+"&configType="+type+"&consultType="+selHtml;
        });*/
        var currentPage=parseInt("{{$datas->currentPage()}}")-1;
        $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':currentPage});
        function pageselectCallback(page_index, jq){
            // 从表单获取每页的显示的列表项数目
            var current = parseInt(page_index)+1;
            var url = window.location.href;
            url = url.replace(/(\?|\&)?page=\d+/,'');
            var isexist = url.indexOf("?");
            if(isexist == -1){
                url += '?page='+current;
            } else {
                url += '&page='+current;
            }
            window.location=url;
            //阻止单击事件
            return false;
        }
    })
  /*  $("#applyVideo").on("click",function(){
        var userId=$.cookie('userId');
        $.ajax({
            url:"{{asset('IsEnterprise')}}",
            data:{"userId":userId},
            dateType:"json",
            type:"POST",
            success:function(res){
                var code=res['code'];
                var account=res['account']
                switch(code){
                    case "success":
                        $.cookie("videodomain",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodescribe",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videoType",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodateStart",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodateEnd",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videoindustry",'',{epath:'/',domain:'sw2025.com'});
                        $.cookie("videoreselect","",{path:'/',domain:'sw2025.com'});
                        window.location.href="{{asset('uct_video/applyVideo')}}";
                        break;
                    case "enterprise":
                        layer.confirm('您还未进行企业认证？', {
                            btn: ['去认证','暂不需要'], //按钮
                        }, function(){
                            window.location.href="{{asset('uct_member')}}";
                        }, function(){
                            layer.close();
                        });
                        break;
                }
            }
        })

    })
    $("#applyVideo1").on("click",function(){
        var userId=$.cookie('userId');
        $.ajax({
            url:"{{asset('IsEnterprise')}}",
            data:{"userId":userId},
            dateType:"json",
            type:"POST",
            success:function(res){
                var code=res['code'];
                switch(code){
                    case "success":
                        $.cookie("videodomain",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodescribe",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodateStart",'',{path:'/',domain:'sw2025.com'});
                        $.cookie("videodateEnd",'',{path:'/',domain:'sw2025.com'});
                        //$.cookie("videoindustry",'',{epath:'/',domain:'sw2025.com'});
                        $.cookie("videoreselect","",{path:'/',domain:'sw2025.com'});
                        $.cookie("state","",{path:'/',domain:'sw2025.com'});
                        window.location.href="{{asset('uct_video/applyVideo')}}";
                        break;
                    case "enterprise":
                        layer.confirm('您还未进行企业认证？', {
                            btn: ['去认证','暂不需要'], //按钮
                        }, function(){
                            window.location.href="{{asset('uct_member')}}";
                        }, function(){
                            layer.close();
                        });
                        break;
                }
            }
        })

    })*/

</script>
@endsection