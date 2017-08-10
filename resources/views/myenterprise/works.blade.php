@extends("layouts.ucenter")
@section("content")
<link rel="stylesheet" type="text/css" href="{{asset('css/list.css')}}" />
<script type="text/javascript" src="{{asset('js/list.js')}}"></script>
<div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">企业办事服务</h3>
        <div class="ucenter-con">
            <div class="myrequire-bg">
                <a href="{{asset('uct_works/applyWork')}}" class="need-publish-btn">申请办事服务</a>
                <div class="publish-intro resource-intro">
                    <span class="introduce-cap">办事流程介绍</span>
                    <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                </div>
            </div>
            <div class="main-right">
                <div class="works-wrap">
                    <div class="works-filter">
                        <span class="works-sel-cap light-color">状态</span>
                        <div class="works-sel">
                            <a href="javascript:;" class="works-sel-def">{{$type}}</a>
                            <ul class="works-sel-list">
                                <li>全部</li>
                                <li>办事审核</li>
                                <li>审核失败</li>
                                <li>邀请专家</li>
                                <li>专家响应</li>
                                <li>正在办事</li>
                                <li>已完成</li>
                                <li>异常终止</li>
                            </ul>
                        </div>
                        <span class="works-sel-count light-color">数量<em>{{$counts}}</em></span>
                    </div>
                    <table class="paycheck-list">
                        <thead>
                        <tr>
                            <th>办事类型</th>
                            <th>专家</th>
                            <th>描述</th>
                            <th>办事状态</th>
                            <th>发布时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td><a href="{{asset('uct_works/detail/'.$data->eventid)}}">{{$data->work}}</a></td>
                                <td><a href="{{asset('uct_works/detail/'.$data->eventid)}}">{{$data->state}}</a></td>
                                <td><a href="{{asset('uct_works/detail/'.$data->eventid)}}">{{$data->brief}}</a></td>
                                <td><a href="{{asset('uct_works/detail/'.$data->eventid)}}">{{$data->configname}}</a></td>
                                <td><a href="{{asset('uct_works/detail/'.$data->eventid)}}">{{$data->created_at}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pages myinfo-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(function(){
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
        // 下拉选框
        $('.works-sel .works-sel-def').click(function(event) {
            $(this).next('ul').slideToggle();
        });
        $('.works-sel-list li').click(function(event) {
            var type=0;
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
            switch(selHtml){
                case "全部":
                    type=0;
                break;
                case "办事审核":
                    type=1;
                break;
                case "审核失败":
                    type=3;
                break;
                case "邀请专家":
                    type=4;
                break;
                case "专家响应":
                    type=5;
                break;
                case "正在办事":
                    type=6;
                break;
                case "已完成":
                    type=7;
                break;
                case "异常终止":
                    type=9;
                break;
            }
            window.location.href="?type="+type;
        });

    })
</script>
@endsection