@extends("layouts.ucenter")
@section("content")
    <div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">企业办事服务</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>

                    <span class="gray-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>

                    <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <div class="publish-need uct-works default-result">

                    @foreach($datas as $data)
                        <div class="expert-certy-state">
                            <i class="iconfont icon-chenggong"></i>
                                <span class="publish-need-blue">
                                    <em>等待推送</em>IS REVIEWING
                                </span>
                        </div>
                        <div class="publish-need-sel">
                            <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def verify-default">{{$data->domain1.'/'.$data->domain2}}</a>
                            <ul class="publish-need-list" style="display: none;">
                            </ul>
                        </div>
                        <div class="datas-sel publish-need-sel mt20">
                            <span class="datas-sel-cap padd12">所在行业</span>
                            <a href="javascript:;" class="datas-sel-def verify-default" id="industrys">{{$data->industry}}</a>
                        </div>
                        <textarea readonly="readonly" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述">{{$data->brief}}</textarea>
                        <div class="uct-works-exp">

                            <a href="javascript:;" class="special-btn  uct-works-btn  @if($data->state=='指定专家') active @endif">指定专家</a>

                            <a href="javascript:;" class="system-btn2 uct-works-btn @if($data->state=='系统分配') active @endif ">系统分配</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){

        })

    </script>
@endsection