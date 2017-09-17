@extends("layouts.ucenter")
@section("content")
        <!-- 我的消息 / start -->
        <div class="main">
            <h3 class="main-top">我的消息</h3>
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
            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                window.location = window.location.href;
            });
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
   /* function pageselectCallback(page_index, jq){
        // 从表单获取每页的显示的列表项数目
        var current = parseInt(page_index)+1;
        var divindex = $('.myask-tabar').children('.active').attr('index');

        ajaxfunction(current);

        //阻止单击事件
        return false;
    }

    function ajaxfunction (current) {
        $.get('{{url('uct_myinfo')}}',{'page':current},function (data) {
            var ee = data.data;
            var str = '';
            $('.myinfo-list').html();
            for (var i = 0; i < ee.length; i++) {
                str += '<li>';
                str += '<div class="myinfo-row">';
                str += '<label class="myinfo-check-label"><input type="checkbox" class="myinfo-check" value="' + ee[i].id + '"/></label>';
                if (ee[i].state) {
                    str += '<a href="javascript:;" class="myinfo-td been-read">';
                    str += '<i class="iconfont icon-youxiang"></i>';
                    str += '<span class="td-tips">已读</span>';
                } else {
                    str += '<a href="javascript:;" class="myinfo-td">';
                    str += '<i class="iconfont icon-youxiang"></i>';
                    str += '<span class="td-tips">新消息</span>';
                }
                str += ' <span class="td-title">标题</span>';
                str += '<span class="td-title-con">' + ee[i].title + '</span>';
                str += '<span class="td-time">' + ee[i].sendtime + '</span>';
                str += '</a>';
                str += '</div>';
                str += '<div class="myinfo-row-details">';
                str += '<p class="myinfo-row-det-con">' + ee[i].content + '</p>';
                if (!ee[i].sendid) {
                    str += '<p class="myinfo-come">From 系统消息</p>';
                }
                str += ' </div>';
                str += ' </li>';
            }
            $('.myinfo-list').html(str);
        });
    }
*/

</script>
@endsection