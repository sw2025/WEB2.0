@extends("layouts.ucenter")
@section("content")
   <div class="bg_v2">
        <div class="card-step works-step">
            <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
            <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
            <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
            <span class="gray-circle">6</span>完成
        </div>
        <div class="invite-experts">
            <div class="invite-expert-tit">
                <i class="iconfont icon-shenhejujue"></i><span>系统已邀请<b class="invite-counts">{{$selected}}</b>人</span>
            </div>

            <table class="invite-table">
                @foreach($datas as $data)
                <tr>
                    <td>需求分析</td>
                    <td>{{$data->domain1.'/'.$data->domain2}}</td>
                </tr>

                <tr>
                    <td>描述</td>
                    <td>{{$data->brief}}</td>
                </tr>
                <tr>
                    <td>专家类型</td>
                    <td>
                        <div class="select-wrapper">
                            <a href="javascript:;" class="select-expert @if($data->state=='指定专家') active @endif" >指定专家</a>
                            <a href="javascript:;" class="select-expert @if($data->state=='系统分配') active @endif">系统分配专家</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>专家头像</td>
                    <td>
                        <div class="selected-experts">
                            @foreach($selExperts as $selExpert)
                                <a href="{{url('expert/detail',$selExpert->expertid)}}" target="_blank" class="expert-wrapper" title="{{$selExpert->expertname}}">
                                    <img src="{{env('ImagePath').$selExpert->showimage}}" height="105" width="105" class="expert-avatar" />
                                    <span class="expert-name">{{$selExpert->expertname}}</span>
                                </a>
                            @endforeach
                        </div>
                    </td>
                </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection