@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/list.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <div class="main">
            <!-- 专家视频咨询 / start -->
            <h3 class="main-top">专家视频咨询</h3>
            <div class="ucenter-con">
                <div class="myrequire-bg">
                    <a href="{{asset('uct_video/video1')}}" class="need-publish-btn">申请视频咨询</a>
                    <div class="publish-intro resource-intro">
                        <span class="introduce-cap">视频咨询流程介绍</span>
                        <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                    </div>
                </div>
                <div class="main-right">
                    <div class="works-wrap">
                        <div class="works-filter">
                            <span class="works-sel-cap light-color">状态</span>
                            <div class="works-sel">
                                <a href="javascript:;" class="works-sel-def">全部</a>
                                <ul class="works-sel-list">
                                    <li>全部</li>
                                    <li>会议审核</li>
                                    <li>邀请专家</li>
                                    <li>专家响应</li>
                                    <li>等待开会</li>
                                    <li>已完成</li>
                                </ul>
                            </div>
                            <span class="works-sel-count light-color">数量<em>3</em></span>
                        </div>
                        <table class="paycheck-list">
                            <thead>
                            <tr>
                                <th>办事类型</th>
                                <th>专家</th>
                                <th>描述</th>
                                <th>发布时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="javascript:;">办事类型</a></td>
                                <td><a href="javascript:;">系统分配</a></td>
                                <td><a href="javascript:;">充值</a></td>
                                <td><a href="javascript:;">2017-07-12</a></td>
                            </tr>
                            <tr>
                                <td><a href="javascript:;">办事类型</a></td>
                                <td><a href="javascript:;">系统分配</a></td>
                                <td><a href="javascript:;">充值</a></td>
                                <td><a href="javascript:;">2017-07-12</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pages myinfo-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        // 下拉选框
        $('.works-sel .works-sel-def').click(function(event) {
            $(this).next('ul').slideToggle();
        });
        $('.works-sel-list li').click(function(event) {
            var selHtml = $(this).html();
            $(this).parent().prev('a').html(selHtml);
            $(this).parent().hide();
        });

        $("#Pagination").pagination("15");
    })
</script>
@endsection