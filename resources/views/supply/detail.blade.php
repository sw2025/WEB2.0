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
                    <span class="details-ch-tit">供求信息</span>
                </div>
                <span class="details-en-tit">SUPPLY AND DEMAND INFORMATION</span>
            </div>
            <div class="supp-details-con">
                <div class="supp-det-con-top">
                    <img src="@if(empty($datas->entimg)) {{asset($datas->extimg)}} @else {{asset($datas->entimg)}}  @endif" class="supp-details-img" />
                    <div class="supp-details-brief">
                        <span class="supp-details-name"><i class="iconfont icon-gongsi"></i>{{$datas->expertname or $datas->enterprisename}}</span>
                        <a href="javascript:;" class="collect-state done">已收藏</a>
                        <span class="supp-details-time">发布时间：<em>{{$datas->needtime}}</em></span>
                        <span class="supp-details-zone">地<b class="wem2"></b>区：<em>{{$datas->address}}</em></span>
                        <span class="supp-details-categary">需求分类：<em>{{$datas->domain1}} / {{$datas->domain2}}</em></span>

                    </div>
                </div>
                <div class="details-abs">
                    <div class="details-abs-tit">
                        <div class="details-graph"><span class="square"></span></div>
                        <span class="details-tit-cap">简介</span>
                    </div>
                    <div class="details-abs-desc">
                      {{$datas->brief}}
                    </div>
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
                        <textarea name="" id="" cols="30" rows="10" class="message-txt" placeholder="请输入留言"></textarea>
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
                                    <img src="{{asset('img/avatar1.jpg')}}" class="floor-host-ava" />
                                    <div class="floor-host-desc">
                                        <a href="javascript:;" class="floor-host-name">{{$v->nickname}}({{$v->name}})[{{$v->enterprisename or $v->expertname}}]</a><span class="floor-host-time">2017-7-8  17：25</span>
                                        <span class="floor-host-words">{{$v->content}}</span>
                                    </div>
                                </div>
                                <div class="message-reply-show">
                                    <a href="javascript:;" class="look-reply">查看回复（2）</a>
                                    <a href="javascript:;" class="message-reply">回复</a>
                                </div>
                                <div class="reply-list">
                                    <ul class="reply-list-ul">
                                        @foreach($message as $reply)
                                            @if(!$reply->use_userid && $reply->parentid == $v->id)
                                            <li>
                                                <img src="{{asset('img/avatar2.jpg')}}" class="floor-guest-ava" />
                                                <div class="gloor-guest-cnt">
                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname}}({{$reply->name}})</a>
                                                    <span class="floor-guest-words">{{$reply->content}}</span>
                                                </div>
                                                <div class="floor-bottom">
                                                    <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn">回复</a>
                                                </div>
                                            </li>
                                            @elseif($reply->parentid == $v->id)

                                            <li>
                                                <img src="{{asset('img/avatar3.jpg')}}" class="floor-guest-ava" />
                                                <div class="gloor-guest-cnt">
                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname}}({{$reply->name}})</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">{{$reply->use_userid == $v->userid ? $v->nickname.'('.$v->name.')' : '还没想出来'}}</a>
                                                    <span class="floor-guest-words">{{$reply->content}}</span>
                                                </div>
                                                <div class="floor-bottom">
                                                    <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn">回复</a>
                                                </div>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="reply-box">
                                        <textarea class="reply-enter"></textarea>
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
                <span class="aside-top-tit">推荐供求信息</span>
            </div>
            <div class="ad-box">
                <span class="ad-cap">更多种类</span>
                多种选择<span class="ad-ct">更好的服务</span>选择在升维
            </div>
            <ul class="supp-recom-list">

                @foreach($recommendNeed as $v)
                <li>
                    <a href="{{url('supply/detail',$v->needid)}}" class="supp-rec-link">
                        <div class="supp-rec-top">
                            <img src="@if(empty($v->entimg)) {{asset($v->extimg)}} @else {{asset($v->entimg)}}  @endif" class="supp-rec-img" />
                            <div class="supp-rec-com">
                                <span class="supp-rec-name">【{{$v->needtype}}】{{$v->expertname or $v->enterprisename}}</span>
                                <p class="supp-rec-category">需求分类：<span><em>{{$v->domain1}} / {{$v->domain2}}</em></span></p>
                            </div>
                        </div>
                        <span class="supp-rec-time">{{$v->needtime}}</span>
                        <div class="supp-rec-brief">
                            {{$v->brief}}
                        </div>
                    </a>
                    <div class="exp-rec-icon supp-rec-icon">
                        <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                        <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                    </div>
                </li>
               @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection