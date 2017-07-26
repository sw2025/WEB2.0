@extends("layouts.ucenter")
@section("content")
<link rel="stylesheet" type="text/css" href="css/list.css" />
<script type="text/javascript" src="js/list.js"></script>
<div class="main">
        <!-- 我的办事 / start -->
        <h3 class="main-top">我的办事</h3>
        <div class="ucenter-con">
            <div class="myrequire-bg">
                <div class="three-icon">
                    <a href="javascript:;" class="icon-row active"><i class="iconfont icon-xiangyingcelve"></i><span>已响应</span><em>10</em></a>
                    <a href="javascript:;" class="icon-row"><i class="iconfont icon-yaoqing"></i><span>已受邀</span><em>10</em></a>
                    <a href="javascript:;" class="icon-row"><i class="iconfont icon-wancheng"></i><span>已完成</span><em>20</em></a>
                </div>
                <div class="publish-intro mywork-intro">
                    <span class="introduce-cap">办事规则介绍</span>
                    <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                </div>
            </div>
            <h3 class="main-top">办事推送列表</h3>
            <div class="main-right">
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
                        <tr>
                            <td><a href="{{asset('uct_mywork/workDetail')}}">办事类型</a></td>
                            <td><a href="{{asset('uct_mywork/workDetail')}}">北京中博昊达资产管理有限公司</a></td>
                            <td><a href="{{asset('uct_mywork/workDetail')}}">需求描述</a></td>
                            <td><a href="{{asset('uct_mywork/workDetail')}}">2017-07-12</a></td>
                        </tr>
                        <tr>
                            <td><a href="uct_mywkdetail.html">办事类型</a></td>
                            <td><a href="uct_mywkdetail.html">北京中博昊达资产管理有限公司</a></td>
                            <td><a href="uct_mywkdetail.html">需求描述</a></td>
                            <td><a href="uct_mywkdetail.html">2017-07-12</a></td>
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
    $("#Pagination").pagination("15");
})
</script>
@endsection