@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <!-- 专家视频咨询 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>会议申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">4</span>会议管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>完成
                </div>
                <div class="publish-need uct-works default-result">
                    <div class="expert-certy-state">
                        <span class="uct-works-icon"><i class="iconfont icon-yaoqing1"></i></span>
                                <span class="publish-need-blue">
                                    <em>邀请专家</em>INVITED EXPERT
                                </span>
                    </div>
                    <div class="system-invite light-color">已经邀请<span class="invite-count">{{$counts}}人</span></div>
                    @foreach($datas as $data)
                        <div class="mywork-det-txt uct-works-known">
                            <span class="mywork-det-tit"><em class="light-color">分类：</em>{{$data->domain1.'/'.$data->domain2}}</span>
                            <span class="mywork-det-tit"><em class="light-color">所在行业：</em>{{$data->industry}}</span>
                            <span class="mywork-det-tit"><em class="light-color">开始时间：</em>{{$data->starttime}}</span>
                            <span class="mywork-det-tit"><em class="light-color">结束时间：</em>{{$data->endtime}}</span>
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">{{$data->brief}}</p>
                            </div>
                        </div>
                        <div class="uct-works-exp">
                            <a href="javascript:;" class="special-btn  uct-works-btn @if($data->state=='指定专家') active @endif">指定专家</a>
                            <a href="javascript:;" class="system-btn2 uct-works-btn @if($data->state=='系统分配') active @endif ">系统分配专家</a>
                        </div>
                    @endforeach

                    <div class="uct-works-exps" style="margin-top: -35px;">
                        <ul class="uct-works-exps-list">
                            @foreach($selExperts as $selExpert)
                                <li id="{{$selExpert->expertid}}" ><a href="{{url('expert/detail',$selExpert->expertid)}}" target="_blank"><img src="{{env('ImagePath').$selExpert->showimage}}" alt="" style="border: 1px solid #ccc;border-radius: 10px;">{{$selExpert->expertname}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    </script>
@endsection
