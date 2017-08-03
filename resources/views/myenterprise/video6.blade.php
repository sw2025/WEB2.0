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
                    <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">5</span>会议管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <div class="uct-video-manage">
                    <div class="video-manage-top">
                        @foreach($datas as $data)
                            @foreach($selExperts as $selExpert)
                                <div class="vid-man-top-lt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <p class="vid-man-top-cat"><span class="light-color">分类：</span>{{$data->domain1.'/'.$data->domain2}}</p>
                                        <p class="vid-man-top-cat"><span class="light-color">金额：</span>{{$selExpert->money}}</p>
                                        <p class="vid-man-top-cat"><span class="light-color">开始时间：</span>{{$data->starttime}}</p>
                                        <p class="vid-man-top-cat"><span class="light-color">结束时间：</span>{{$data->endtime}}</p>
                                        <span class="light-color">描述：</span>
                                        <div class="vid-man-top-desc">{{$data->brief}}</div>
                                    </div>
                                </div>
                                <div class="vid-man-top-rt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <div class="emcee">
                                            <span class="light-color emcee-cap">主持人：</span>
                                            @if($selExpert->userid==$userId)
                                                <span class="emceer-pers"><img src="httP://sw2025.com{{$selExpert->showimage}}" class="vid-new-ava">{{$selExpert->expertname}}</span>
                                            @endif
                                        </div>
                                        <div class="emcee-bottom">
                                            <span class="light-color emcee-cap emcee-bot-cap">成员：</span>
                                            <div class="emcee-members">
                                                <span class="emceer-pers"><img src="httP://sw2025.com{{$selExpert->showimage}}" class="vid-new-ava">{{$selExpert->expertname}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="video-manage-frame">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 公共footer / end -->
    <script type="text/javascript">
        $(function(){

        })

    </script>
@endsection

