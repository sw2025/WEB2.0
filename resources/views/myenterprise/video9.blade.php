@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/jquery.raty.min.js')}}"></script>
    <!--    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
       <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <style type="text/css">
        table.table-striped {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }
        table.table-striped th {
            font-size: 15px;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }
        table.table-striped td {
            font-size: 14px;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

    </style>
    <div class="main">
        <!-- 专家视频咨询 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>咨询申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">4</span>咨询管理<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">5</span>完成
                </div>
                <input type="hidden" id="event" name="event" value="{{$consultId}}">
                <div class="publish-need uct-works-final">
                    <div class="expert-certy-state">

                                <span class="expert-certy-blue">
                                    <img src="{{asset('img/yichang.png')}}" style="position: relative;">
                                    <em style="color: #f10;font-weight: bolder;">异常终止</em>Abnormal termination
                                </span>
                    </div>
                        <table class="table table-striped" style="width: 80%;margin: 10px auto;">
                            <tr class="success">
                                <th>视频咨询企业</th>
                                <td>{{$selExperts->enterprisename}}</td>
                            </tr>
                            <tr>
                                <th>视频咨询领域</th>
                                <td>{{$datas[0]->domain1.' / '.$datas[0]->domain2}}</td>
                            </tr>
                            <tr>
                                <th>视频咨询描述</th>
                                <td>{{mb_substr($datas[0]->brief,0,50)}}</td>
                            </tr>
                            <tr>
                                <th>视频咨询专家</th>
                                <td>@foreach($selExperts2 as $v2)
                                    <a href="{{url('expert/detail',$v2->expertid)}}">{{$v2->expertname}}</a> |
                                @endforeach
                                </td>
                            </tr>

                            <tr>
                                <th>异常终止原因</th>
                                <td>{{$datas[0]->remark}}</td>
                            </tr>
                        </table>


                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    </script>
@endsection