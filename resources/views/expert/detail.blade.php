@extends("layouts.master")
@section("content")
<script type="text/javascript" src="{{asset('js/reply.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/details.css')}}" />
<div class="container section">
    <div class="row clearfix">
        <div class="main-content col-md-8">
            <div class="details-top clearfix">
                <div class="details-bg">
                    <span class="blue-circle"><i class="iconfont icon-jianjie1"></i></span>
                    <span class="details-ch-tit">专家信息</span>
                </div>
                <span class="details-en-tit">THE EXPERT INFORMATION</span>
            </div>
            <div class="exp-details-con">
                <div class="exp-det-con-top">
                    <img src="{{env('ImagePath').$datas->showimage}}" class="exp-details-img" />
                    <div class="exp-details-brief">
                        <span class="exp-details-name"><i class="iconfont icon-iconfonticon"></i>{{$datas->expertname}}</span>
                        <a href="javascript:;" index="{{$datas->expertid}}" class="collect-state @if(in_array($datas->expertid,$collectids)) done @endif">@if(in_array($datas->expertid,$collectids))已收藏 @else 收藏 @endif</a>
                        <span class="exp-details-time">入驻时间：<em>{{$datas->created_at}}</em></span>
                        <span class="exp-details-categary">分<b class="wem2"></b>类：<em>{{$datas->category}}</em></span>
                        <span class="exp-details-video">视频咨询：<em>@if($datas->state && $datas->fee)￥{{$datas->fee}}@else 免费 @endif</em></span>
                        <span class="exp-details-best">擅长领域：<em>{{$datas->domain1}}</em></span>
                        <div class="exp-details-lab">
                            @foreach(explode(',',$datas->domain2) as $do2)
                                <span class="exp-lab-a">&nbsp;{{$do2}}&nbsp;</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="details-abs">
                    <div class="details-abs-tit">
                        <div class="details-graph"><span class="square"></span></div>
                        <span class="details-tit-cap">简介</span>
                    </div>
                    <div class="details-abs-desc">
                        {{$datas->brief}}
                    </div><a name="reply">
                </div>
            </div>
            <div class="details-top clearfix">
                <div class="details-bg">
                    <span class="blue-circle"><i class="iconfont icon-liuyan"></i></span>
                    <span class="details-ch-tit">我的留言</span>
                </div>
                <span class="details-en-tit">COMMENT THREADS</span>
            </div>
            <div class="details-message">
                <form action="">
                    <div class="message-write">
                        <textarea name="content" id="{{$datas->expertid}}" cols="30" rows="10" class="message-txt" placeholder="请输入留言"></textarea>
                        <div class="message-btn"><button class="submit" type="button">提交</button></div>
                    </div>
                </form>
                <div class="message-list">
                    <div class="details-abs-tit">
                        <div class="details-graph forth"><span class="square"></span></div>
                        <span class="details-tit-cap forth-cap">留言列表</span>
                    </div>
                    <div class="all-replys">
                        @foreach($message as $v)
                            @if(!$v->parentid)
                                <div class="mes-list-box clearfix">
                                    <div class="floor-host">
                                        <img src="{{env('ImagePath').$v->avatar}}" class="floor-host-ava" />
                                        <div class="floor-host-desc">
                                            <a href="javascript:;" class="floor-host-name">{{$v->nickname}} [{{$v->enterprisename or $v->expertname}}]</a><span class="floor-host-time">{{$v->messagetime}}</span>
                                            <span class="floor-host-words">{{$v->content}}</span>
                                        </div>
                                    </div>
                                    <div class="message-reply-show">
                                        <a href="javascript:;" class="look-reply">查看回复（@if(key_exists($v->id,$msgcount)){{$msgcount[$v->id]}}@else 0 @endif）</a>
                                        <a href="javascript:;" class="message-reply">回复</a>
                                    </div>
                                    <div class="reply-list">
                                        <ul class="reply-list-ul">
                                            @foreach($message as $reply)
                                                @if(!$reply->use_userid && $reply->parentid == $v->id)
                                                    <li>
                                                        <img src="{{env('ImagePath').$reply->avatar}}" class="floor-guest-ava" />
                                                        <div class="gloor-guest-cnt">
                                                            <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}}</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn" userid="{{$v->userid}}">回复</a>
                                                        </div>
                                                    </li>
                                                @elseif($reply->parentid == $v->id)

                                                    <li>
                                                        <img src="{{env('ImagePath').$reply->avatar}}" class="floor-guest-ava" />
                                                        <div class="gloor-guest-cnt">
                                                            <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}}</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">{{$reply->nickname2 or substr_replace($reply->phone2,'****',3,4)}}</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" userid="{{$v->userid}}" class="reply-btn">回复</a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="reply-box">
                                            <textarea class="reply-enter" index="{{$v->expertid}}" id="{{$v->id}}"></textarea>
                                            <div class="publish-box"><button class="publish-btn" type="button">发表</button></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 det-aside">
            <div class="aside-top">
                <span class="aside-top-icon"><i class="iconfont icon-tuijian"></i></span>
                <span class="width2"></span>
                <span class="aside-top-tit">推荐相关专家</span>
            </div>
            <ul class="exp-recom-list">
                @foreach($recommendNeed as $v)
                <li>
                    <a href="{{url('expert/detail',$v->expertid)}}" class="exp-rec-link">
                            <span class="exp-rec-left">
                                <img class="exp-rec-img" src="{{env('ImagePath').$v->showimage}}">
                                <em class="rec-exp-name">{{$v->expertname}}</em>
                            </span>
                        <div class="exp-rec-right">
                            <span class="exp-rec-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>@if($v->state && $v->fee)￥{{$v->fee}}@else 免费 @endif</em></span>
                            <span class="exp-rec-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>{{$v->domain1}} / {{$v->domain2}}</em></span>
                            <div class="exp-rec-lab">
                                <span class="exp-lab-a">不知道</span>
                                <span class="exp-lab-a">不知道</span>
                                <span class="exp-lab-a">不知道</span>
                                <span class="exp-lab-a">不知道</span>
                            </div>
                            <p class="exp-rec-brief">
                                {{$v->brief}}
                            </p>
                        </div>
                    </a>
                    <div class="exp-rec-icon">
                        <a href="{{url('expert/detail',$v->expertid)}}#reply" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                        <a href="javascript:;" class="collect @if(in_array($v->expertid,$collectids)) red @endif" index="{{$v->expertid}}" title="@if(in_array($v->expertid,$collectids)) 已收藏 @else 收藏 @endif"><i class="iconfont icon-likeo"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script src="{{url('js/expert.js')}}" type="text/javascript"></script>
@endsection