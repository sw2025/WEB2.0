@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="css/list.css" />
    <script type="text/javascript" src="js/list.js"></script>
    <div class="main">
        <!-- 我的办事 / start -->
        <h3 class="main-top">我的办事</h3>
        <div class="ucenter-con">
            <div class="myrequire-bg">

                <div class="three-icon  resource-icon">
                    <a href="javascript:;" class="icon-row" index="5"><i class="iconfont icon-xiangyingcelve"></i><span>已响应</span><em>{{$responsecount}}</em></a>
                    <a href="javascript:;" class="icon-row" index="4"><i class="iconfont icon-yaoqing"></i><span>已受邀</span><em>{{$putcount}}</em></a>
                    <a href="javascript:;" class="icon-row" index="7"><i class="iconfont icon-wancheng"></i><span>已完成</span><em>{{$complatecount}}</em></a>
                </div>
                <div class="publish-intro mywork-intro">
                    <span class="introduce-cap">办事规则介绍</span>
                    <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                </div>
            </div>
            <div class="myask-tabar">
                <a class="myask-tabar-a active" href="javascript:;" index="pushevent">办事推送列表</a>
                <a class="myask-tabar-a" href="javascript:;" index="allevent">我的办事列表</a>
            </div>
            <div class="main-right myask-tab">
                <div class="myask-tab-box">
                    <div class="mywork-wrap">
                        <table class="paycheck-list">
                            <thead>
                            <tr>
                                <th>办事类型</th>
                                <th>企业名称</th>
                                <th>需求描述</th>
                                <th>发布时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $v)
                                <tr>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->domain1.' / '.$v->domain2}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->name}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->brief}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->eventtime}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="myask-tab-box" style="display: none">
                    <div class="mywork-wrap">
                        <table class="paycheck-list">
                            <thead>
                            <tr>
                                <th>办事类型</th>
                                <th>企业名称</th>
                                <th>需求描述</th>
                                <th>办事状态</th>
                                <th>发布时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas2 as $v)
                                <tr>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->domain1.' / '.$v->domain2}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->name}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->brief}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->status}}</a></td>
                                    <td><a href="{{url('uct_mywork/workDetail',$v->eventid)}}">{{$v->eventtime}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div class="pages myinfo-page">
                <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){

            $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':{{$datas->currentPage()-1}}});

            function pageselectCallback(page_index, jq){
                // 从表单获取每页的显示的列表项数目
                var current = parseInt(page_index)+1;
                var divindex = $('.myask-tabar').children('.active').attr('index');
                var guize = $('.three-icon .active').attr('index');
                if(guize == null){
                    switch (divindex){
                        case 'pushevent':
                            var data = {'page':current,'action':0};
                            break;
                        case 'allevent':
                            var data = {'page':current,'action':1};
                            break;
                    }
                } else {
                    var data = {'page':current,'action':guize};
                }

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
                    var obj = $('.myask-tab-box').eq(params.action).children('div').children('table').children('tbody');
                    obj.html('');
                    var ee = data.data;
                    var str = '';
                    for(var i=0;i<ee.length;i++){
                        str += '<tr>';
                        str +='<td><a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'">'+ee[i].domain1+' / '+ee[i].domain2+'</a></td>';
                        str +='<td><a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'">'+ee[i].name+'</a></td>';
                        str +='<td><a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'">'+ee[i].brief+'</a></td>';
                        if(params.action){
                            str +='<td><a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'">'+ee[i].status+'</a></td>';
                        }
                        str +='<td><a href="{{url('uct_mywork/workDetail')}}'+'/'+ee[i].eventid+'">'+ee[i].eventtime+'</a></td>';
                        str +='</tr>';
                    }
                    obj.html(str);
                    $("#Pagination").pagination(data.last_page,{'callback':pageselectCallback,'current_page':data.current_page-1});
                    $('.allPage').text(data.last_page);
                });
            }

            $('.myask-tabar-a').click(function() {
                var guize = $('.three-icon .active').attr('index');
                $(this).addClass('active').siblings().removeClass('active');
                var ind = $(this).index();
                $('.myask-tab-box').eq(ind).show().siblings().hide();
                if(guize == null){
                    senddatato({'page':1,'action':ind});
                }
            });


            $('.three-icon a').on('click',function () {
                var config = $(this).attr('index');
                $('.myask-tab-box').eq(1).show().siblings().hide();
                $('.myask-tabar-a').eq(1).addClass('active').siblings().removeClass('active');
                senddatato({'page':1,'action':config});
            });
        })
    </script>
@endsection