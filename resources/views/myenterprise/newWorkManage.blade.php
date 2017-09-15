@extends("layouts.ucenter")
@section("content")
    <style>

        @-webkit-keyframes waitPulse {
            from { background-color: #bbb; -webkit-box-shadow: 0 0 9px #aaa; }
            50% { background-color: #ccc; -webkit-box-shadow: 0 0 18px #ccc; }
            to { background-color: #bbb; -webkit-box-shadow: 0 0 9px #aaa; }
        }

        @-webkit-keyframes followPulse {
            from { background-color: #45b97c; -webkit-box-shadow: 0 0 9px #45b97c; }
            50% { background-color: #60ad84; -webkit-box-shadow: 0 0 18px #333; }
            to { background-color: #45b97c; -webkit-box-shadow: 0 0 9px #45b97c; }
        }

        @-webkit-keyframes faildPulse {
            from { background-color: #bc330d; -webkit-box-shadow: 0 0 9px #ef4136; }
            50% { background-color: #e33100; -webkit-box-shadow: 0 0 18px #e33100; }
            to { background-color: #bc330d; -webkit-box-shadow: 0 0 9px #ef4136; }
        }

        @-webkit-keyframes responsePulse {
            from { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #00a6ac; }
            50% { background-color: #2daebf; -webkit-box-shadow: 0 0 18px #2daebf; }
            to { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #00a6ac; }
        }

        @-webkit-keyframes putPulse {
            from { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #78cdd1; }
            50% { background-color: #2daebf; -webkit-box-shadow: 0 0 18px #2daebf; }
            to { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #78cdd1; }
        }


        @-webkit-keyframes ingPulse {
            from { background-color: #1d953f; -webkit-box-shadow: 0 0 9px #ccc; }
            50% { background-color: #4eb33c; -webkit-box-shadow: 0 0 18px #333; }
            to { background-color: #1d953f; -webkit-box-shadow: 0 0 9px #ccc; }
        }


        @-webkit-keyframes endPulse {
            from { background-color: #ff5c00; -webkit-box-shadow: 0 0 9px #5e7c85; }
            50% { background-color: #e2754b; -webkit-box-shadow: 0 0 18px #ff5c00; }
            to { background-color: #ff5c00; -webkit-box-shadow: 0 0 9px #5e7c85; }
        }

        @-webkit-keyframes yichangPulse {
            from { background-color: #fc9200; -webkit-box-shadow: 0 0 9px #f36c21; }
            50% { background-color: #ffb515; -webkit-box-shadow: 0 0 18px #ffb515; }
            to { background-color: #fc9200; -webkit-box-shadow: 0 0 9px #f36c21; }
        }


        .response {
            border-width: 0;
            cursor: pointer;
            font-family: inherit;
            font-weight: bold;
            line-height: normal;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            padding-top: 0.5em;
            padding-right: 0.5em;
            padding-bottom: 0.5em;
            padding-left: 0.5em;
            font-size: 1em;
            background-color: #adc708;
            border-color: #829606;
            color: white;
            border-radius: 5px;
        }

        #eventwait{
            -webkit-animation-name: waitPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #eventfollow{
            -webkit-animation-name: followPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #response {
            -webkit-animation-name: responsePulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #eventput {
            -webkit-animation-name: putPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #eventing{
            -webkit-animation-name: ingPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #eventend{
            -webkit-animation-name: endPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }

        #eventdont{
            -webkit-animation-name: faildPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            border-style: solid;
        }





    </style>
    <div class="vmain-manage-list clearfix">
        <div class="v-works-manage-list-top clearfix">
            <div class="v-works-mlt-select">
                <a href="javascript:;" class="v-works-mlt-opt @if(!$type || $type == '全部') active @endif">全部</a>
                @foreach($domains as $value)
                    <a href="javascript:;" class="v-works-mlt-opt @if($type && $type ==$value->domainname) active @endif">{{$value->domainname}}</a>
                @endforeach
            </div>
            <div class="v-supply-con"></div>

            <a href="javascript:;" class="goto-work" id="applyEvent"><i class="iconfont icon-woyaobanshi"></i>我要办事</a>

        </div>
        <ul class="v-manage-list-ul clearfix">
            @if($datas->lastpage())
            @foreach($datas as $v)
            <li>
                <a href="{{asset('uct_works/detail/'.$v->eventid)}}" class="v-manage-list-ul-link"  style="padding-bottom: 43px;">
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
                    <span style="position: absolute;bottom: 3px;right: 15px;"><i class="iconfont icon-shijian2"></i>{{$v->created_at}}</span>
                    <p class="response" id="{{$v->btnicon}}" style=" position: absolute;top: 15px;right: 15px;">{{$v->configname}}</p>
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
                data:{"userId":userId,"type":"work"},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var code=res['code'];
                    var account=res['account']
                    switch(code){
                        case "success":
                            window.location.href="{{asset('uct_works/applyWork')}}";
                        break;
                        case "enterprise":
                            window.location.href="{{asset('uct_member')}}";
                            break;
                        case "error":
                            pop(code,account);
                            break;
                        case "expried":
                            pop(code,account);
                            break;
                        case "finish":
                           pop(code,account)
                            break;
                    }
                }
            })

        })

        $("#applyEvent1").on("click",function(){
            var userId=$.cookie('userId');
            $.ajax({
                url:"{{asset('IsMember')}}",
                data:{"userId":userId,"type":"work"},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var code=res['code'];
                    var account=res['account']
                    switch(code){
                        case "success":
                            window.location.href="{{asset('uct_works/applyWork')}}";
                            break;
                        case "enterprise":
                            window.location.href="{{asset('uct_member')}}";
                            break;
                        case "error":
                            pop(code,account);
                            break;
                        case "expried":
                            pop(code,account);
                            break;
                        case "finish":
                            pop(code,account)
                            break;
                    }
                }
            })

        })
    </script>
@endsection