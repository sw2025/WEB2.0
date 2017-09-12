@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <!-- 专家视频咨询 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>会议申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>会议审核<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>会议管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <div class="publish-need uct-works default-result">
                    <div class="expert-certy-state">
                        <span class="uct-works-icon"><i class="iconfont icon-yaoqing1"></i></span>
                                <span class="publish-need-blue">
                                    <em>邀请专家</em>INVITED EXPERT
                                </span>
                    </div>
                    <div class="system-invite light-color">已经邀请<span class="invite-count">{{$counts}}</span></div>
                    @foreach($datas as $data)
                        <div class="mywork-det-txt uct-works-known">
                            <span class="mywork-det-tit"><em class="light-color">分类：</em>{{$data->domain1.'/'.$data->domain2}}</span>
                            <span class="mywork-det-tit"><em class="light-color">开始时间：</em>{{$data->starttime}}</span>
                            <span class="mywork-det-tit"><em class="light-color">结束时间：</em>{{$data->endtime}}</span>
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">{{$data->brief}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    </script>
@endsection
