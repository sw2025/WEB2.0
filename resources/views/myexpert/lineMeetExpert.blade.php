@extends("layouts.ucenter4")
@section("content")
    <div class="vmain-manage-list clearfix">
                <div class="v-works-manage-list-top clearfix">
                    <div class="v-works-mlt-select">
                        <a href="javascript:;" class="v-works-mlt-opt @if($index==0) active @endif" index="0" page="0">线下约见请求</a>
                        <a href="javascript:;" class="v-works-mlt-opt @if($index!=0) active @endif" index="1" page="0">我的线下约见</a>
                    </div>
                    @if($index==0)
                    <div class="v-feedback condition0">
                    <span class="v-feedback-span"><i class="iconfont icon-laba"></i>
                    <span class="v-feedback-count">{{$counts}}</span>家企业向您发出线下约见</span>
                    </div>
                        @endif
                </div>




            @if($index==0)

            <br/>
            <div class="v-m-list-box">
                    <ul class="v-manage-list-ul v-m-l-show clearfix">
                        @foreach($datas as $v)
                        <li>
                            <div class="v-manage-list-ul-link">
                                <a href="{{url('uct_linemeetexpert/lineMeetDetail',$v->id)}}" class="block-a">
                                    <div class="v-manage-link-top">
                                        <div class="v-manage-link-tit">
                                            <strong class="v-manage-link-sentit exp-name-block">{{$v->enterprisename}}</strong>
                                            <span class="biaoqian">{{$v->industry}}</span>
                                        </div>
                                    </div>
                                    <p class="v-manage-link-desc exp-paragraph">
                                        {{$v->contents}}
                                    </p>
                                </a>
                                <span class="accept" onclick="responseevent({{$v->id}},this)">接 受</span>
                                <div class="v-manage-link-time">
                                    <span><i class="iconfont icon-shijian2">{{$v->puttime}}</i></span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else

                    <div class="v-feedback condition1" >
                        {{-- <div class="v-works-sel">
                             <span class="allwork">全部咨询</span>
                             <a href="javascript:;" class="v-works-sel-def" id="domainType">{{$type or "不限"}}</a>
                             <ul class="v-works-sel-list domainType"  >
                                 <li @if($type && $type=="不限") class="active" @endif>不限</li>
                                 @foreach($domains as $value)
                                     <li @if($type && $type ==$value->domainname) active @endif>{{$value->domainname}}</li>
                                 @endforeach
                             </ul>
                         </div>
                         <div class="v-works-sel">
                             <span class="allwork">全部状态</span>
                             <a href="javascript:;" class="v-works-sel-def" id="configType">{{$configType or "不限"}}</a>
                             <ul class="v-works-sel-list configType" >
                                 <li class="active">不限</li>
                                 <li>已响应</li>
                                 <li>正在咨询</li>
                                 <li>已完成</li>
                                 <li>已评价</li>
                                 <li>异常终止</li>
                             </ul>
                         </div>--}}
                    </div>
                    <ul class="v-manage-list-ul v-m-l-show clearfix">
                        @foreach($datas as $v)
                        <li>
                            <a href="{{url('uct_linemeetexpert/lineMeetDetail',$v->id)}}" class="v-manage-list-ul-link">
                                <div class="v-manage-link-top">
                                    <div class="v-manage-link-tit">
                                        <strong class="v-manage-link-sentit exp-name-block">{{$v->enterprisename}}</strong>
                                        <span class="biaoqian">{{$v->domain2}}</span>
                                    </div>
                                </div>
                                <p class="v-manage-link-desc exp-paragraph">
                                    {{$v->contents}}
                                </p>
                                @if($v->configid=="1")
                                    <span class="now-state state-ts">已发起约见</span>
                                @elseif($v->configid=="2")
                                    <span class="now-state state-ts">等待专家确认</span>
                                @elseif($v->configid=="3")
                                    <span class="now-state state-jx">约见</span>
                                @elseif($v->configid=="4")
                                    <span class="now-state state-wc">已完成</span>
                                @endif
                                <div class="v-manage-link-time">
                                    <span><i class="iconfont icon-shijian2"></i>{{$v->puttime}}</span>
                                </div>
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

<script type="text/javascript">
    $(function(){
        $(document).click(function () {
            $('.v-works-sel-list').hide();
        })
      /*  $('.v-works-sel .v-works-sel-def').click(function (event) {
            event.stopPropagation();
            $(this).next('ul').slideToggle();
        });
        $('.domainType li').click(function (event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var configType = $('#configType').text();
            window.location.href = "?index=1&type=" + selHtml + "&configType=" + configType;
        });

        $('.configType li').click(function (event) {
            event.stopPropagation();
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            var domain = $('#domainType').text();
            window.location.href = "?index=1&type=" + domain + "&configType=" + selHtml;
        });*/

        $('.v-works-mlt-opt').click(function(event) {
            var $ind = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            if ($ind == 0) {
                $(".condition0").show();
                $(".condition1").hide();
                window.location.href = "?index=" + $ind;
            } else {
                $(".condition0").hide();
                $(".condition1").show();
                window.location.href = "?index=" + $ind + "&type=不限";
            }
        });


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
    })

    function responseevent(id,obj){
        $(obj).attr('disabled',true);
        $(obj).html('正在响应');
        $.post('{{url('uct_linemeetexpert/requestLineMeet')}}',{'id':id}, function (data){
            if(data.icon == 2){
                layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                    $(obj).attr('disabled',false);
                    $(obj).html('响应');
                    window.location.href = window.location.href;
                });
            } else {
                layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                    window.location.href ="uct_linemeetexpert?index=1&type=不限";
                    //http://sb.sw2025.com/uct_linemeetexpert?index=1&type=%E4%B8%8D%E9%99%90
                    //http://sb.sw2025.com/uct_linemeetexpert/lineMeetExpert?index=1&type=%E4%B8%8D%E9%99%90
                });
            }
        })
    }
</script>
@endsection