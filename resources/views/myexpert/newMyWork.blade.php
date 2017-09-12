@extends("layouts.ucenter4")
@section("content")
<div class="vmain-manage-list clearfix">
                <div class="v-works-manage-list-top clearfix">
                    <div class="v-works-mlt-select">
                        <a href="javascript:;" class="v-works-mlt-opt active" index="0" page="0">办事请求</a>
                        <a href="javascript:;" class="v-works-mlt-opt" index="1" page="0">我的办事</a>
                    </div>
                    <div class="v-feedback">
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
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="pages myinfo-page v-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                </div>
            </div>
<script type="text/javascript">
    $(function(){
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
</script>
@endsection