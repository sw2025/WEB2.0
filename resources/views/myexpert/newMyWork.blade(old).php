@extends("layouts.ucenter4")
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
                        <a href="javascript:;" class="v-works-mlt-opt active" index="0" page="0">办事请求</a>
                        <a href="javascript:;" class="v-works-mlt-opt" index="1" page="0">我的办事</a>
                    </div>
                    <div class="v-feedback" style="overflow: hidden">
                            <span class="v-feedback-span"><i class="iconfont icon-laba"></i>
                            <span class="v-feedback-count">{{$waitcount}}</span>个企业向您发出办事请求</span>
                    </div>
                </div>
                <div class="v-m-list-box">
                    <ul class="v-manage-list-ul v-m-l-show clearfix">
                        @foreach($datas as $v)
                        <li>
                            <div class="v-manage-list-ul-link">
                                <div class="v-manage-link-top">
                                    <span class="{{$v->icon}}"></span>
                                    <a href="{{url('uct_mywork/workDetail',$v->eventid)}}" class="v-manage-link-tit">
                                        <strong class="v-manage-link-sentit">{{$v->domain1}}</strong>
                                        <span class="v-manage-link-juntit" title="{{$v->domain2}}">{{$v->domain2}}</span>
                                    </a>
                                </div>
                                <p class="v-manage-link-desc">
                                    {{$v->brief}}
                                </p>
                                <a href="javascript:;" class="accept" onclick="responseevent({{$v->eventid}},this)">接 受</a>
                                <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->eventtime}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="v-manage-list-ul clearfix">
                        @foreach($datas2 as $v)
                        <li>
                            <div class="v-manage-list-ul-link">
                                <div class="v-manage-link-top">
                                    <span class="{{$v->icon}}"></span>
                                    <a href="{{url('uct_mywork/workDetail',$v->eventid)}}" class="v-manage-link-tit">
                                        <strong class="v-manage-link-sentit">{{$v->domain1}}</strong>
                                        <span class="v-manage-link-juntit" title="{{$v->domain2}}">{{$v->domain2}}</span>
                                    </a>
                                </div>
                                <p class="v-manage-link-desc">
                                    {{$v->brief}}
                                </p>
                                <span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>{{$v->eventtime}}</span>
                                @if($v->configid == 7 || $v->configid == 8)
                                    <span class="chuo"></span>
                                @endif
                                <p class="response" id="{{$v->btnicon}}" style=" position: absolute;top: 35px;right: 15px;">{{$v->status}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
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
    $(function(){
        if($.cookie('register')){
                $(".iknow").show();
        }
        $('.v-works-mlt-opt').click(function(event) {
            var $ind = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $('.v-manage-list-ul').eq($ind).addClass('v-m-l-show').siblings().removeClass('v-m-l-show');
            var page = $(this).attr('page');
            if($ind == 0){
                $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':page});
                $('.allPage').html('{{$datas->lastpage()}}');
            } else if($ind == 1) {
                $("#Pagination").pagination("{{$datas2->lastpage()}}",{'callback':pageselectCallback,'current_page':page});
                $('.allPage').html('{{$datas2->lastpage()}}');
            }
        });

        $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':{{$datas->currentPage()-1}}});

        function pageselectCallback(page_index, jq){
            // 从表单获取每页的显示的列表项数目
            var current = parseInt(page_index)+1;
            var divindex = $('.v-works-mlt-select').children('.active').attr('index');
            var data = {'page':current,'action':divindex};

            senddatato(data);
            //阻止单击事件
            return false;
        }

        function senddatato (params){
            var location = '{{url('/uct_mywork')}}?page='+params.page;
            $.get(location,{'action':params.action},function (data) {
                if(params.action > 1){
                    params.action = 1;
                }
                var obj = $('.v-manage-list-ul').eq(params.action);
                obj.html('');
                var ee = data.data;
                var str = '';
                for(var i=0;i<ee.length;i++){

                    str += '<li><div class="v-manage-list-ul-link"><div class="v-manage-link-top">';
                    str += '<span class="'+ee[i].icon+'"></span>';
                    str += '<a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'" class="v-manage-link-tit">';
                    str += '<strong class="v-manage-link-sentit">'+ee[i].domain1+'</strong>';
                    str += '<span class="v-manage-link-juntit" title="'+ee[i].domain2+'">'+ee[i].domain2+'</span></a></div>';
                    str += '<p class="v-manage-link-desc">'+ee[i].brief+'</p>';
                    if(ee[i].state == 0 || ee[i].state == 1){
                        str += '<a href="javascript:;" class="accept" onclick="responseevent('+ee[i].eventid+',this)">接 受</a>';
                    }
                    str += '<span class="v-manage-link-time"><i class="iconfont icon-shijian2"></i>'+ee[i].eventtime+'</span></div>';
                }
                obj.html(str);
                $('.v-works-mlt-opt').eq(params.action).attr('page',data.current_page-1);
                $("#Pagination").pagination(data.last_page,{'callback':pageselectCallback,'current_page':data.current_page-1});
                $('.allPage').text(data.last_page);
            });
        }


    })

    function responseevent(eventid,obj){
        $(obj).attr('disabled',true);
        $(obj).html('正在响应');
        $.post('{{url('uct_mywork/responseevent')}}',{'eventid':eventid,'token':'{{$token}}'}, function (data){
            if(data.icon == 2){
                layer.msg(data.msg,{'time':1000,'icon':data.icon},function ()  {
                    $(obj).attr('disabled',false);
                    $(obj).html('响应');
                    window.location = '{{url('/')}}';
                });
            } else {
                layer.msg(data.msg,{'time':2500,'icon':data.icon},function () {
                    window.location.href = window.location.href;
                });
            }
        })
    }
    $("#vip").on("click",function(){
        $.cookie("register","",{path:'/',domain:'sw2025.com'});
        $(".iknow").hide();
    })
</script>
@endsection