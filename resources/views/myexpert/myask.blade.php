@extends("layouts.ucenter")
@section("content")
        <div class="main">
            <!-- 我的视频咨询 / start -->
            <h3 class="main-top">我的视频咨询</h3>
            <div class="ucenter-con">
                <div class="myrequire-bg myask">
                    <div class="three-icon resource-icon">
                        <a href="javascript:;" class="icon-row active"><i class="iconfont icon-xiangyingcelve"></i><span>已响应</span><em>10</em></a>
                        <a href="javascript:;" class="icon-row"><i class="iconfont icon-yaoqing"></i><span>已受邀</span><em>10</em></a>
                        <a href="javascript:;" class="icon-row"><i class="iconfont icon-wancheng"></i><span>已完成</span><em>20</em></a>
                    </div>
                    <div class="publish-intro myask-intro">
                        <span class="introduce-cap">视频咨询规则介绍</span>
                        <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                    </div>
                    <div class="myask-meet">
                        <span class="fs12">距会议还有1分钟</span>
                        <a href="javascript:;" class="need-publish-btn">进入会议室</a>
                    </div>
                </div>
                <div class="myask-tabar">
                    <a class="myask-tabar-a active" href="javascript:;">会议推送列表</a>
                    <a class="myask-tabar-a" href="javascript:;">我的会议列表</a>
                </div>
                <div class="main-right myask-tab">
                    <div class="myask-tab-box">
                        <div class="mywork-wrap">
                            <table class="paycheck-list">
                                <thead>
                                <tr>
                                    <th>会议类型</th>
                                    <th>企业名称</th>
                                    <th>会议需求描述</th>
                                    <th>时间范围</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="uct_myaskdetail.html">办事类型</a></td>
                                    <td><a href="uct_myaskdetail.html">北京中博昊达资产管理有限公司</a></td>
                                    <td><a href="uct_myaskdetail.html">需求描述</a></td>
                                    <td><a href="uct_myaskdetail.html">2017-07-12</a></td>
                                </tr>
                                <tr>
                                    <td><a href="uct_myaskdetail.html">办事类型</a></td>
                                    <td><a href="uct_myaskdetail.html">北京中博昊达资产管理有限公司</a></td>
                                    <td><a href="uct_myaskdetail.html">需求描述</a></td>
                                    <td><a href="uct_myaskdetail.html">2017-07-12</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pages myinfo-page">
                            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                        </div>
                    </div>
                    <div class="myask-tab-box">

                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("15");
        $('.myask-tabar-a').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            var ind = $(this).index();
            $('.myask-tab-box').eq(ind).show().siblings().hide();
        });
    })
</script>
@endsection