@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/info.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/paginate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages.css')}}">

    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <div class="swcontainer sw-ucenter">
        <div class="main" style="margin-top: 65px">
            <h1 style="font-size: 22px;color: #61498f;margin-bottom: 25px;">我的消息 <i class="iconfont" style="font-size: 23px;">&#xe7f6;</i></h1>

            <div class="ucenter-con">
        <div class="main-right">
            <div class="myinfo-tit">
                <span class="myinfo-tit-fl"><i class="iconfont icon-xiaoxi"></i>新消息</span>
                            <span class="myinfo-tit-fr">
                                <a href="javascript:;" class="check-all">全选</a>
                                <a href="javascript:;" class="read">标记已读</a>
                                <a href="javascript:;" class="delete">删除</a>
                            </span>
            </div>
            <ul class="myinfo-list">

                @foreach($datas as $v)
                    <li>
                        <div class="myinfo-row">
                            <label class="myinfo-check-label"><input type="checkbox" class="myinfo-check" value="{{$v->id}}"/></label>
                            @if($v->state)
                                <a href="javascript:;" class="myinfo-td been-read">
                                    <i class="iconfont icon-youxiang"></i>
                                    <span class="td-tips">已读</span>
                                    @else
                                        <a href="javascript:;" class="myinfo-td">
                                            <i class="iconfont icon-youxiang"></i>
                                            <span class="td-tips">新消息</span>
                                            @endif
                                            <span class="td-title">标题</span>
                                            <span class="td-title-con">{{$v->title}}</span>
                                            <span class="td-time">{{$v->sendtime}}</span>
                                        </a>
                        </div>
                        <div class="myinfo-row-details">
                            <p class="myinfo-row-det-con">{!! $v->content !!}</p>
                            @if(!empty($v->url))
                                <a href="{{$v->url}}">点此查看</a>
                            @endif

                            @if(!$v->sendid)
                                <p class="myinfo-come">From 系统消息</p>
                            @endif
                        </div>
                    </li>
                @endforeach

            </ul>
            <div class="pages myinfo-page">
                <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
            </div>
        </div>
    </div>
</div>
    </div>
    <script type="text/javascript">
        var select = new Array();
        //选中按钮
        $('.myinfo-check-label').on('click','input', function() {

            if($(this).parent().hasClass('ischecked')){
                select.splice($.inArray($(this).val(),select),1);
            } else {
                select.push($(this).val());
            }
        });
        // 展开我的消息详情
        $('.myinfo-td').on('click', function() {
            if(!$(this).hasClass('been-read')){
                alsoread([$(this).siblings('label').children('input').val()],1);
            }

        });
        // 全选
        $('.check-all').on('click', function() {

            $('.myinfo-check-label input').each(function (i,n) {
                select.push($(n).val());
            });
            select = $.unique(select);
        });
        // 标记为已读
        $('.read').on('click', function() {
            var checkNum = $('.ischecked').length;
            if(checkNum > 0){
                alsoread(select,1);
            }
        });
        // 删除
        $('.delete').on('click', function() {
            var checkNum2 = $('.ischecked').length;
            if(checkNum2 > 0){
                alsoread(select,2);
            }
        });


        function alsoread (arr,state) {
            $.post('{{url('uct_flagread')}}',{'data':arr,'state':state},function (data) {
                layer.msg(data.msg,{'time':2000,'icon':data.icon});
            });
        }

        $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':{{$datas->currentPage()-1}}});

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

    </script>
@endsection