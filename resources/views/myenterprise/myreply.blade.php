@extends("layouts.ucenter")
@section("content")
        <!-- 我的消息 / start -->
        <div class="main">
            <h3 class="main-top">专家给我的留言</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myinfo-tit">
                        <span class="myinfo-tit-fl"><i class="iconfont icon-xiaoxi"></i>留言列表</span>
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
                                    <span class="td-title">留言</span>
                                    <span class="td-title-con">专家{{$v->expertname}} 向您发送了一条留言</span>
                                    <span class="td-time">{{$v->messagetime}}</span>
                                </a>
                            </div>
                            <div class="myinfo-row-details">

                                <p class="myinfo-row-det-con">{{$v->content}}</p>
                                <p class="myinfo-come"><a href="{{url('/uct_entres/detail',$entinfo->enterpriseid)}}#reply" >查看此留言</a> &ensp;|&ensp; <a href="javascript:;" onclick="replythis(@if(empty($v->parentid)) {{$v->id}} @else {{$v->parentid}} @endif,{{$v->enterpriseid}})">回复</a>  &ensp;|&ensp; <a href="javascript:;" onclick="selectexpertjoinevent({{$v->expertid}},'{{$v->expertimg}}')">邀请专家[办事/视频咨询]</a> </p>
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
        $.post('{{url('uct_flagreadmsg')}}',{'data':arr,'state':state},function (data) {
            if(state == 1 || state == 2){
                layer.msg(data.msg);
            } else {
                layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                    window.location = window.location.href;
                });
            }

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

<script>

    function selectexpertjoinevent(expertid,img){
        if(!$.cookie('userId')){
            layer.confirm('您还未登陆是否去登陆？', {
                btn: ['去登陆','暂不需要'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href='/login';
            }, function(){
                layer.close();
            });
            return false;
        }
        var str = '<div style="padding:10px;">系统会自动选定当前专家作为您的自选专家请后续补充相关的领域和办事/视频咨询描述。<p style=color:red;font-size:12px;>提示：请您确保您的身份是升维网认证企业，且在后续创建办事或者咨询时会产生相关费用。请做好相关准备<p></div>';

        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['400px', '210px'],
            shadeClose: false, //开启遮罩关闭
            title:'新建[办事/视频咨询]提醒',
            content: str,
            btn: ['邀请办事','邀请视频咨询','取消'],
            yes: function(index, layero){
                $.cookie("isAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("reselect",expertid+img,{path:'/',domain:'sw2025.com'});
                window.location.href="{{url('uct_works/applyWork')}}";
            },btn2: function(index, layero){
                $.cookie("videoisAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("videoreselect",expertid+img,{path:'/',domain:'sw2025.com'});
                window.location.href="{{url('/uct_video/applyVideo')}}";
            },btn3: function (index, layero){
                layer.close(index);
            }
        });
    }

    layer.config({
        extend: '/extend/layer.ext.js'
    });

    function replythis(id,enterpriseid){
        layer.prompt({title: '请输入回复留言的内容', formType: 2}, function(pass, index){
            if(pass == ''){
                layer.msg('请输入原因',{'time':1000});
                return false;
            }
            $.post('{{url('/exttomymsg/reply')}}',{'id':id,'entid':enterpriseid,'content':pass},function (data) {
                layer.msg(data.msg,{'icon':data.icon});
            });
            //layer.close(index);
        });

    }

</script>
@endsection