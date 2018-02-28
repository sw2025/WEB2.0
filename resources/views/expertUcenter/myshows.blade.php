@extends('layouts.ucenter4')
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/experts.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/newmyneed.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <script type="text/javascript" src="{{asset('iconfont/iconfont.js')}}"></script>
    <style>
        #entimg2avt{
            border-radius: 5px;
            width: 130px;
            background: #ccc8c8;
            height: 168px;
            padding-top: 9%;
        }
        #entimg2avt p{
            color: #383333;
            font-size: 30px;
            text-align: center;
        }

    </style>
    <div class="ucenter-con">
        <!-- 选择start -->
        <div class="v-myneed-top">
            <a href="javascript:;" class="v-release-btn" onclick="">项目评议</a>
            <div class="v-condition">
                <a href="javascript:;" class="v-condition-link v-c-link1 @if(!empty($action) && $action == '待评议')active @endif" index="waitverify">待评议<span class="v-count">{{$putcount}}</span></a>
                <a href="javascript:;" class="v-condition-link v-c-link2 @if(!empty($action) && $action == '已评议')active @endif" index="refuseverify">已评议<span class="v-count">{{$waitcount}}</span></a>
            </div>
        </div>
        <!-- 选择  end -->
        <div class="uct-list-filter">
            <div class="uct-search">

            </div>
            <!-- 筛选条件 start -->
            <div class="uct-search-result">
                <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
                    @if(isset($action))<a href="javascript:;" class="all-results-trace all-results-opt">{{$action}}</a>@endif
                </div>



            </div>
            <!-- 筛选条件 end -->
        </div>
        <div class="main-right uct-oh">
            <div class="myask-tab-box">
                <ul class="supply-list clearfix">
                    @foreach($datas as $v)
                        <li class="col-md-6">
                            <a href=" {{url('myshows/showDetail',$v->showid)}}" class="supply-list-link">
                                {{--<img src="" class="supp-list-img" />--}}
                                <span class="exp-list-img" id="entimg2avt" style="background: {{['#ccc8c8','#c5d8d8','#c6ddec','#d4d4d4','#fff'][array_rand(['#ccc8c8','#c5d8d8','#c6ddec','#d4d4d4','#fff'],1)] }};"><p>{{mb_substr($v->flag2,0,1)}}</p><p>{{mb_substr($v->flag2,1,1)}}</p><p>{{mb_substr($v->flag2,2,1)}}</p></span>
                                <span class="supp-list-time">{{date('Y-m-d',strtotime($v->showtime))}}</span>
                                <div class="supp-list-brief" style="margin-left: 145px;">
                                    <span class="supp-list-name">{{$v->title}}</span>
                                    <span class="supp-list-category">项目分类：<em>{{$v->domain1}} / {{$v->domain2}}</em></span>
                                    <div class="supp-list-desc">
                                        {{$v->brief}}
                                    </div>
                                </div>
                            </a>
                            <div class="supp-list-icon" style="margin-bottom: 10px;">
                                <a href="" class="review" title="留言">评议人: {{$v->basicdata or 0}}</a>
                                <a href="" class="review" title="留言">已评议: {{$v->messcount or 0}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pages myinfo-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                </div>
            </div>
            <div class="myask-tab-box"></div>
            <div class="myask-tab-box"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':{{$datas->currentPage()-1}}});
            function pageselectCallback(page_index, jq){
                // 从表单获取每页的显示的列表项数目
                var current = parseInt(page_index)+1;
                var url = window.location.href;
                url = url.replace(/(\?|\&)?page=\d+/,'');
                var isexist = url.indexOf("?");
                if(isexist == -1){
                    url += '?ordertime=desc&page='+current;
                } else {
                    url += '&page='+current;
                }
                window.location=url;
                //阻止单击事件
                return false;
            }
            $('.myask-tabar-a').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
                var ind = $(this).index();

                // $('.myask-tab-box').eq(ind).show().siblings().hide();

            });
        })

        function putneed (){
            $.post('{{url('myneed/verifyputneed')}}',{'role':'企业'},function (data) {
                if(data.type == 3){
                    layer.msg(data.msg,{'icon':data.icon});
                } else if(data.type == 2){
                    layer.confirm(data.msg, {
                        btn: ['去认证','暂不需要'], //按钮
                        skin:'layui-layer-molv'
                    }, function(){
                        window.location.href=data.url;
                    }, function(){
                        layer.close();
                    });
                } else if (data.type == 1){
                    layer.alert(data.msg,{'icon':data.icon});
                } else {
                    window.location = '{{asset('uct_myshow/supplyShow')}}';
                }
            });

        }
    </script>
    <script src="{{url('js/myshow.js')}}" type="text/javascript"></script>
@endsection