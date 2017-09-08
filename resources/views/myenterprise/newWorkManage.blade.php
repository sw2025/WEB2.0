@extends("layouts.ucenter")
@section("content")
    <div class="vmain-manage-list clearfix">
        <div class="v-works-manage-list-top clearfix">
            <div class="v-works-mlt-select">
                <a href="javascript:;" class="v-works-mlt-opt @if(!$type || $type == '全部') active @endif">全部</a>
                <a href="javascript:;" class="v-works-mlt-opt @if($type && $type == '找资金') active @endif">找资金</a>
                <a href="javascript:;" class="v-works-mlt-opt @if($type && $type == '找技术') active @endif">找技术</a>
                <a href="javascript:;" class="v-works-mlt-opt @if($type && $type == '找市场') active @endif">找市场</a>
                <a href="javascript:;" class="v-works-mlt-opt @if($type && $type == '定战略') active @endif">定战略</a>
            </div>
            <div class="v-supply-con"></div>

            <a href="javascript:;" class="goto-work" id="applyEvent"><i class="iconfont icon-woyaobanshi"></i>我要办事</a>

        </div>
        <ul class="v-manage-list-ul clearfix">
            @if($datas->lastpage())
            @foreach($datas as $v)
            <li>
                <a href="{{asset('uct_works/detail/'.$v->eventid)}}" class="v-manage-list-ul-link">
                    <div class="v-manage-link-top">
                        <span class="{{$v->icon}}"></span>
                        <div class="v-manage-link-tit">
                            <strong class="v-manage-link-sentit">{{$v->domain1}}</strong>
                            <span class="v-manage-link-juntit" title="">{{$v->domain2}}</span>
                        </div>
                    </div>
                    <p class="v-manage-link-desc">
                        {{$v->brief}}
                    </p>
                    <div class="v-manage-link-rate">
                        <span class="vprogress vprog1 @if($v->configid >= 1) vping @endif" title="办事审核"></span>
                        <span class="vprogress vprog2 @if($v->configid >= 4) vping @endif" title="邀请专家"></span>
                        <span class="vprogress vprog3 @if($v->configid >= 5) vping @endif" title="专家响应"></span>
                        <span class="vprogress vprog4 @if($v->configid >= 6) vping @endif" title="办事管理"></span>
                        <span class="vprogress vprog5 @if($v->configid >= 7) vping @endif" title="完成"></span>
                    </div>
                    <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->created_at}}</span>
                </a>
            </li>
          @endforeach
            @else
                <li>
                    <div class="v-supply-tip">
                        <span class="v-supply-tip-top"><strong>升维网</strong>为<strong>企业</strong></span>
                        <div class="v-supply-tactic"><span>找资金</span><span>找技术</span><span>找市场</span><span>定战略</span></div>
                        <img src="{{asset('img/nolength.png')}}" class="nolength" />

                        <a href="javascript:;" class="goto-work1" id="applyEvent1"><i class="iconfont icon-woyaobanshi"></i>我要办事</a>

                    </div>
                </li>
            @endif

        </ul>
        <div class="pages myinfo-page v-page">
            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage() }}</strong>页</span>
        </div>
    </div>
    <script>
        var select = new Array();
        // 提示申请服务内容
        var $html = '<h2>办事规则介绍</h2>任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报';
        $('.goto-work').hover(function(){
            $('.v-supply-con').html($html).show();
        },function(){
            $('.v-supply-con').hide();
        });
        $('.v-works-mlt-opt').click(function(event) {
            $(this).addClass('active').siblings().removeClass('active');
            window.location.href="?domain="+$(this).text();
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

            var userId=$.cookie('userId');
            $.ajax({
                url:"{{asset('IsMember')}}",
                data:{"userId":userId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){

                        window.location.href="{{asset('uct_works/applyWork')}}"

                    }else if(res['code']=="error"){
                        layer.confirm('您尚未开通会员', {
                            btn: ['开通','取消'], //按钮
                        }, function(){
                            window.location.href='{{asset('uct_member')}}';
                        }, function(){
                            layer.close();
                        });
                    }else{
                        layer.confirm('您的会员已过期,请续费', {
                            btn: ['续费','取消'], //按钮
                        }, function(){
                            window.location.href='{{asset('uct_member/member4/2')}}';
                        }, function(){
                            layer.close();
                        });
                    }
                }
            })

        })

        $("#applyEvent1").on("click",function(){

            var userId=$.cookie('userId');
            $.ajax({
                url:"{{asset('IsMember')}}",
                data:{"userId":userId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){

                        window.location.href="{{asset('uct_works/applyWork')}}"

                    }else if(res['code']=="error"){
                        layer.confirm('您尚未开通会员', {
                            btn: ['开通','取消'], //按钮
                        }, function(){
                            window.location.href='{{asset('uct_member')}}';
                        }, function(){
                            layer.close();
                        });
                    }else{
                        layer.confirm('您的会员已过期,请续费', {
                            btn: ['续费','取消'], //按钮
                        }, function(){
                            window.location.href='{{asset('uct_member/member4/2')}}';
                        }, function(){
                            layer.close();
                        });
                    }
                }
            })

        })
    </script>
@endsection