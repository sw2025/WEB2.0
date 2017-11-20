@extends("layouts.ucenter4")
@section("content")
    <div class="vmain-manage-list clearfix">
                <div class="v-works-manage-list-top clearfix">
                    <div class="v-works-mlt-select">
                        <a href="javascript:;" class="v-works-mlt-opt @if($index==0) active @endif" index="0" page="0">办事请求</a>
                        <a href="javascript:;" class="v-works-mlt-opt @if($index!=0) active @endif"   index="1" page="0">我的办事</a>
                    </div>
                   @if($index==0)
                        <div class="v-feedback condition0">
                                <span class="v-feedback-span"><i class="iconfont icon-laba"></i>
                                <span class="v-feedback-count">{{$counts}}</span>个企业向您发出办事请求</span>
                        </div>
                    @else
                        <div class="v-feedback condition1" >
                            <div class="v-works-sel">
                                <span class="allwork">全部办事</span>
                                <a href="javascript:;" class="v-works-sel-def" id="domainType">{{$type or "不限"}}</a>
                                <ul class="v-works-sel-list domainType"  >
                                    <li @if($type && $type=="不限") class="active" @endif>不限</li>
                                    @foreach($domains as $value)
                                        <li @if($type && $type ==$value->domainname)class="active" @endif>{{$value->domainname}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="v-works-sel">
                                <span class="allwork">全部状态</span>
                                <a href="javascript:;" class="v-works-sel-def" id="configType">{{$configType or "不限"}}</a>
                                <ul class="v-works-sel-list configType" >
                                    <li class="active">不限</li>
                                    <li>已响应</li>
                                    <li>正在办事</li>
                                    <li>已完成</li>
                                    <li>已评价</li>
                                    <li>异常终止</li>
                                </ul>
                            </div>
                        </div>
                  @endif
                </div>
                <div class="v-m-list-box">
                    @if($index==0)
                    <ul class="v-manage-list-ul v-m-l-show clearfix">
                        @foreach($datas as $v)
                            <li>
                                <div class="v-manage-list-ul-link">
                                    <a href="{{url('uct_mywork/workDetail',$v->eventid)}}" class="block-a">
                                        <div class="v-manage-link-top">
                                            <div class="v-manage-link-tit">
                                                <strong class="v-manage-link-sentit exp-name-block">{{$v->enterprisename}}</strong>
                                                <span class="biaoqian">{{$v->domain2}}</span>
                                            </div>
                                        </div>
                                        <p class="v-manage-link-desc exp-paragraph">
                                            {{$v->brief}}
                                        </p>
                                    </a>
                                    <span class="accept" onclick="responseevent({{$v->eventid}},this)">接 受</span>
                                    <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->eventtime}}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <ul class="v-manage-list-ul  v-m-l-show clearfix">
                        @foreach($datas as $v)
                            <li>
                                <a href="{{url('uct_mywork/workDetail',$v->eventid)}}" class="v-manage-list-ul-link">
                                    <div class="v-manage-link-top">
                                        <div class="v-manage-link-tit">
                                            <strong class="v-manage-link-sentit exp-name-block">{{$v->enterprisename}}</strong>
                                            <span class="biaoqian">{{$v->domain2}}</span>
                                        </div>
                                    </div>
                                    <p class="v-manage-link-desc exp-paragraph">
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
                                    <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->eventtime}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="pages myinfo-page v-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                </div>
            </div>
    <div class="pop-pay iknow" >
        <div class="payoff">
            <div class="single">
                <p> 1.企业邀请专家咨询、参会、办事，专家接受邀请后，以文字、视频等方式与去也交流。</p>
                <p> 2.专家可以主动联系企业。</p>
                <p>3.专家可以通过升维网VIP精选商情，向特定行业企业群发自己的重要成果。</p>
                <p>4.专家自行制定给企业提供咨询、参会的收费标准（按每30分钟多少钱）。</p>
                <p>5.专家与企业自行协商线下项目的收费标准。</p>
            </div>
            <div style="text-align: center;padding: 0 0 20px;"><button type="button" class="pop-btn vip" id="vip">我知道了</button></div>
        </div>
    </div>
<script type="text/javascript">
    $(function() {
        if ($.cookie('register')) {
            $(".iknow").show();
        }
        $(document).click(function () {
            $('.v-works-sel-list').hide();
        })
        $('.v-works-sel .v-works-sel-def').click(function (event) {
            event.stopPropagation();
            $(this).next('ul').slideToggle();
        });
        $('.domainType li').click(function (event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var configType = $('#configType').text();
            window.location.href = "?index=1&domain=" + selHtml + "&configType=" + configType;
        });

        $('.configType li').click(function (event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var domain = $('#domainType').text();
            window.location.href = "?index=1&domain=" + domain + "&configType=" + selHtml;
        });
        $('.v-works-mlt-opt').click(function (event) {
            var $ind = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            if ($ind == 0) {
                $(".condition0").show();
                $(".condition1").hide();
                window.location.href = "?index=" + $ind;
            } else {
                $(".condition0").hide();
                $(".condition1").show();
                window.location.href = "?index=" + $ind + "&domain=不限&configType=不限";
            }
        })
        var currentPage = parseInt("{{$datas->currentPage()}}") - 1;
        $("#Pagination").pagination("{{$datas->lastpage()}}", {
            'callback': pageselectCallback,
            'current_page': currentPage
        });
        function pageselectCallback(page_index, jq) {
            // 从表单获取每页的显示的列表项数目
            var current = parseInt(page_index) + 1;
            var url = window.location.href;
            url = url.replace(/(\?|\&)?page=\d+/, '');
            var isexist = url.indexOf("?");
            if (isexist == -1) {
                url += '?page=' + current;
            } else {
                url += '&page=' + current;
            }
            window.location = url;
            //阻止单击事件
            return false;
        }

        $("#vip").on("click", function () {
            $.cookie("register", "", {path: '/', domain: 'sw2025.com'});
            $(".iknow").hide();
        })
    })
    function responseevent(eventid, obj) {
        $(obj).attr('disabled', true);
        $(obj).html('正在响应');
        $.post('{{url('uct_mywork/responseevent')}}', {'eventid': eventid}, function (data) {
            if (data.icon == 2) {
                layer.msg(data.msg, {'time': 1000, 'icon': data.icon}, function () {
                    $(obj).attr('disabled', false);
                    $(obj).html('响应');
                    window.location = '{{url('/')}}';
                });
            } else {
                layer.msg(data.msg, {'time': 2500, 'icon': data.icon}, function () {
                    window.location.href = window.location.href;
                });
            }
        })
    }
</script>
@endsection