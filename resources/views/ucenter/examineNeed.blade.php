@extends("layouts.ucenter")
@section("content")
            <div class="main">
                <!-- 发布需求 / start -->
                <h3 class="main-top">发布需求</h3>
                <div class="ucenter-con">
                    <div class="main-right">
                        <div class="card-step">
                            <span class="green-circle">1</span>提交需求<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">2</span>需求审核
                        </div>
                        <div class="publish-need">
                            <div class="publish-need-state">
                                <i class="iconfont icon-chenggong"></i>
                                <span class="publish-need-blue">
                                    <em>正在审核</em>IS REVIEWING
                                </span>
                            </div>
                            <div class="publish-need-sel">
                                <span class="publ-need-sel-cap">需求分类</span><a href="javascript:;" class="publ-need-sel-def verify-default">{{$lastdata->domain1}}/{{$lastdata->domain2}}</a>
                                <ul class="publish-need-list">
                                    <li>
                                        <a href="javascript:;">销售类</a>
                                        <ul class="publ-sub-list">
                                            <li>demo1</li>
                                            <li>demo2</li>
                                        </ul>
                                    </li>

                                </ul>
                                <textarea name="" class="publish-need-txt publish-need-txt2" cols="30" rows="10"  readonly="readonly">{{$lastdata->brief}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection