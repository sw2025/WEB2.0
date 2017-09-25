@extends("layouts.ucenter4")
@section("content")
    <script type="text/javascript" src="{{asset('js/jquery.raty.min.js')}}"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">企业办事服务</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">4</span>办事管理<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">5</span>完成
                </div>
                <input type="hidden" id="event" name="event" value="{{$eventId}}">
                <div class="publish-need uct-works-final">
                    <div class="expert-certy-state">

                                <span class="expert-certy-blue">
                                    <img src="{{asset('img/yichang.png')}}" style="position: relative;">
                                    <em style="color: #f10;font-weight: bolder;">异常终止</em>Abnormal termination
                                </span>
                    </div>
                    @foreach($datas as $v)
                        <table class="table table-striped" style="width: 80%;margin: 10px auto;">
                            <tr class="success">
                                <td>办事企业</td>
                                <td>{{$selExperts->enterprisename}}</td>
                            </tr>
                            <tr>
                                <td>办事领域</td>
                                <td>{{$v->domain1.' / '.$v->domain2}}</td>
                            </tr>
                            <tr>
                                <td>办事描述</td>
                                <td>{{mb_substr($v->brief,0,50)}}</td>
                            </tr>
                            <tr>
                                <td>办事专家</td>
                                <td><a href="{{url('expert/detail',$selExperts2->expertid)}}">{{$selExperts2->expertname}}</a></td>
                            </tr>
                        </table>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    </script>
@endsection