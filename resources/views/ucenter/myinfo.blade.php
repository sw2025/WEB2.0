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
                        <li>
                            <div class="myinfo-row">
                                <label class="myinfo-check-label"><input type="checkbox" class="myinfo-check" /></label>
                                <a href="javascript:;" class="myinfo-td">
                                    <i class="iconfont icon-youxiang"></i>
                                    <span class="td-tips">新消息</span>
                                    <span class="td-title">标题</span>
                                    <span class="td-title-con">关于小李同志本次任务工作情况汇报</span>
                                    <span class="td-time">2017-07-18</span>
                                </a>
                            </div>
                            <div class="myinfo-row-details">
                                <p class="myinfo-row-det-con">非常好~！工作很认真~！！！涨工资~！！！！</p>
                                <p class="myinfo-come">From 系统消息</p>
                            </div>
                        </li>
                        <li>
                            <div class="myinfo-row">
                                <label class="myinfo-check-label"><input type="checkbox" class="myinfo-check" /></label>
                                <a href="javascript:;" class="myinfo-td been-read">
                                    <i class="iconfont icon-youxiang"></i>
                                    <span class="td-tips">已读</span>
                                    <span class="td-title">标题</span>
                                    <span class="td-title-con">关于小李同志本次任务工作情况汇报</span>
                                    <span class="td-time">2017-07-18</span>
                                </a>
                            </div>
                            <div class="myinfo-row-details">
                                <p class="myinfo-row-det-con">非常好~！工作很认真~！！！涨工资~！！！！</p>
                                <p class="myinfo-come">From 系统消息</p>
                            </div>
                        </li>
                    </ul>
                    <div class="pages myinfo-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("15");
    })
</script>
@endsection