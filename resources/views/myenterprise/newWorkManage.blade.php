@extends("layouts.ucenter")
@section("content")
    <div class="v-works-manage-list-top clearfix">
        <div class="v-works-sel">
            <span class="allwork">全部办事</span>
            <a href="javascript:;" class="v-works-sel-def" id="domainType">{{$type or "不限"}}</a>
            <ul class="v-works-sel-list domainType" style="display: none;">
                <li @if($type && $type=="不限") class="active" @endif>不限</li>
                @foreach($domains as $value)
                    <li @if($type && $type ==$value->domainname) active @endif>{{$value->domainname}}</li>
                @endforeach
            </ul>
        </div>
        <div class="v-works-sel">
            <span class="allwork">全部状态</span>
            <a href="javascript:;" class="v-works-sel-def" id="configType">{{$configType or "不限"}}</a>
            <ul class="v-works-sel-list configType" style="display: none;">
                <li class="active">不限</li>
                <li>已推送</li>
                <li>已响应</li>
                <li>正在办事</li>
                <li>已完成</li>
                <li>已评价</li>
                <li>异常终止</li>
            </ul>
        </div>
        <div class="v-supply-con" style="display: none;">
            <h2>办事规则介绍</h2>根据用户提出的领域分类和描述系统可以匹配此类专家或者用户自选专家后按照办事流程开始办事<br>办事流程介绍：
            <p style="color:#000;font-weight: bold;">办事申请→专家响应→选择专家→进入办事→办事完成</p>
        </div>
        <a href="javascript:;" class="goto-work" id="applyEvent"><i class="iconfont icon-woyaobanshi"></i>我要办事</a>
    </div>
    <ul class="v-manage-list-ul clearfix">
        @if($datas->lastpage())
        @foreach($datas as $v)
        <li>
            <a href="{{asset('uct_works/detail/'.$v->eventid)}}" class="v-manage-list-ul-link">
                <div class="v-manage-link-top">
                    <div class="v-manage-link-tit">
                        <strong class="v-manage-link-sentit">{{$v->domain1}}</strong>
                        <span class="biaoqian">{{$v->domain2}}</span>
                    </div>
                </div>
                <p class="v-manage-link-desc">
                    {{$v->brief}}
                </p>
                @if($v->configname=="已推送")
                <span class="now-state state-ts">已推送</span>
                @elseif($v->configname=="已响应")
                <span class="now-state state-ts">已响应</span>
                @elseif($v->configname=="正在办事")
                <span class="now-state state-jx">正在办事</span>
                @elseif($v->configname=="已完成")
                    <span class="now-state state-wc">已完成</span>
                @elseif($v->configname=="已评价")
                    <span class="now-state state-wc">已评价</span>
                @else
                <span class="now-state state-zz">异常终止</span>
                @endif
                <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->created_at}}</span>
            </a>
        </li>
        @endforeach
        @else
            <li>
                <div class="v-supply-tip">
                    <span class="v-supply-tip-top"><strong>升维网</strong>海量专家提供问题办事</span>
                    <div class="v-supply-tactic"><span>找资金</span><span>找技术</span><span>找市场</span><span>定战略</span></div>
                    <div class="rules">
                        <h2>办事规则介绍</h2>
                        <p>1.企业用户选择需要办事的分类，详细填写办事的描述。</p>
                        <p> 2.系统按办事的分类为企业自动匹配专家进行推送，企业也可以自主选择心仪的专家进行推送。</p>
                        <p> 3.专家接受后，企业选择最合适的一位专家，双方达成合作，如需发生服务费用，双方线下协商</p>
                    </div>
                    <div class="mygo">
                        <a href="javascript:;" class="goto-work1" id="applyEvent1"><i class="iconfont icon-woyaobanshi"></i>我要办事</a>
                    </div>
                </div>
            </li>
        @endif
    </ul>
    <div class="pages myinfo-page v-page">
            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage() }}</strong>页</span>
    </div>
    </div>
    <div class="pop-pay iknow">
        <div class="payoff">
            <div class="single">
                <p>1.企业在“发起办事”中，联系机构与专家。</p>
                <p>2.企业在视频交流中，邀请专家“一对一咨询”，专家接受邀请后即进行咨询。</p>
                <p>3.企业视频系统中，针对某项重大议题，邀请2-3位专家参加研讨会议，专家接受邀请后即召开会议。</p>
                <p>4.企业在咨询或召开会议时，可以“自行邀请专家”，也可以由“系统匹配专家”。</p>
                <p>5.企业可以向平台发布商情信息，以便对方查看。</p>
            </div>
            <div style="text-align: center;padding: 0 0 20px;"><button type="button" class="pop-btn vip" id="vip">我知道了</button></div>
        </div>
    </div>
    <script src="pingppjs/dist/pingpp.js"></script>
    <script>
        $(function(){
            if($.cookie('register')){
                $(".iknow").show();
            }
        })
        var select = new Array();
        // 提示申请服务内容
        var $html = '<h2>办事规则介绍</h2><p> 1.企业用户选择需要办事的分类，详细填写办事的描述。</p><p>2.系统按办事的分类为企业自动匹配专家进行推送，企业也可以自主选择心仪的专家进行推送。</p><p> 3.专家接受后，企业选择最合适的一位专家，双方达成合作，如需发生服务费用，双方线下协商。</p>';
        $('.goto-work').hover(function(){
            $('.v-supply-con').html($html).show();
        },function(){
            $('.v-supply-con').hide();
        });
        $(document).click(function(){
            $('.v-works-sel-list').hide();
        })
        $('.v-works-sel .v-works-sel-def').click(function(event) {
            event.stopPropagation();
            $(this).next('ul').slideToggle();
        });
        $('.domainType li').click(function(event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var configType=$('#configType').text();
            window.location.href="?domain="+selHtml+"&configType="+configType;
        });

        $('.configType li').click(function(event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var domain=$('#domainType').text();
            window.location.href="?domain="+domain+"&configType="+selHtml;
        });

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

        $("#applyEvent").on("click",function(){
            $(this).attr('disabled',true);
            var userId=$.cookie('userId');
            $.ajax({
                url:"{{asset('IsMember')}}",
                data:{"userId":userId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var code=res['code'];
                    var account=res['account'];
                    switch(code){
                        case "success":
                            $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
                            $.cookie("domain","",{path:'/',domain:'sw2025.com'});
                            $.cookie("describe","",{path:'/',domain:'sw2025.com'});
                            $.cookie("industry","",{path:'/',domain:'sw2025.com'});
                            window.location.href="{{asset('uct_works/applyWork')}}";
                        break;
                        case "enterprise":
                            layer.confirm('您还未进行企业认证？', {
                                btn: ['去认证','暂不需要'], //按钮
                            }, function(){
                                window.location.href="{{asset('uct_member')}}";
                            }, function(){
                                $(this).attr('disabled',false);
                                layer.close();
                            });
                            break;
                        case "expried":
                            //pop(code,account);
                            layer.msg('您的余额不足，请及时充值',{'time':1500},function(){
                                $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
                                $.cookie("domain","",{path:'/',domain:'sw2025.com'});
                                $.cookie("describe","",{path:'/',domain:'sw2025.com'});
                                $.cookie("industry","",{path:'/',domain:'sw2025.com'});
                                window.location.href="{{asset('uct_works/applyWork')}}";
                            });

                            break;
                    }
                }
            })

        })

        $("#applyEvent1").on("click",function(){
            $(this).attr('disabled',true);
            var userId=$.cookie('userId');
            $.ajax({
                url:"{{asset('IsMember')}}",
                data:{"userId":userId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var code=res['code'];
                    var account=res['account'];
                    switch(code){
                        case "success":
                            $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
                            $.cookie("domain","",{path:'/',domain:'sw2025.com'});
                            $.cookie("describe","",{path:'/',domain:'sw2025.com'});
                            //$.cookie("industry","",{path:'/',domain:'sw2025.com'});
                            $.cookie("state","",{path:'/',domain:'sw2025.com'});
                            window.location.href="{{asset('uct_works/applyWork')}}";
                            break;
                        case "enterprise":
                            layer.confirm('您还未进行企业认证？', {
                                btn: ['去认证','暂不需要'], //按钮
                            }, function(){
                                window.location.href="{{asset('uct_member')}}";
                            }, function(){
                                $(this).attr('disabled',false);
                                layer.close();
                            });
                            break;
                    }
                }
            })

        })
        $("#vip").on("click",function(){
            $.cookie("register","",{path:'/',domain:'sw2025.com'});
            $(".iknow").hide();
        })
    </script>
@endsection