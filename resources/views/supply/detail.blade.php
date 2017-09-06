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
                    <span class="details-ch-tit">需求信息</span>
                </div>
                <span class="details-en-tit">SUPPLY AND DEMAND INFORMATION</span>
            </div>

            <div class="supp-details-con">
                <div class="supp-det-con-top">
                    <img src="@if(empty($datas->entimg)) {{env('ImagePath').$datas->extimg}} @else {{env('ImagePath').$datas->entimg}}  @endif" class="supp-details-img" />
                    <div class="supp-details-brief">
                        <span class="supp-details-name"><i class="iconfont icon-gongsi"></i>【{{$datas->role}}】@if(!empty($datas->expertname) && !empty($datas->enterprisename)) {{$datas->enterprisename.' / '.$datas->expertname}} @else {{$datas->expertname or $datas->enterprisename}} @endif</span>
                        <a href="javascript:;" index="{{$datas->needid}}" class="collect-state @if(in_array($datas->needid,$collectids)) done @endif">@if(in_array($datas->needid,$collectids))已收藏 @else 收藏 @endif</a>
                        <span class="supp-details-time">发布时间：<em>{{$datas->needtime}}</em></span>
                        <span class="supp-details-zone">地<b class="wem2"></b>区：<em>{{$datas->address}}</em></span>
                        <span class="supp-details-categary">需求分类：<em>{{$datas->domain1}} / {{$datas->domain2}}</em></span>

                    </div>
                </div><a name="reply">
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
                <form action="" method="post">
                    <div class="message-write">
                        <textarea name="content" id="{{$datas->needid}}" cols="30" rows="10" class="message-txt" placeholder="请输入留言"></textarea>
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
                                        <textarea class="reply-enter" index="{{$v->needid}}" id="{{$v->id}}"></textarea>
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
                <span class="aside-top-tit">推荐需求信息</span>
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
                                <span class="supp-rec-name">【{{$v->role}}】@if(!empty($v->expertname) && !empty($v->enterprisename)) {{$v->enterprisename.' / '.$v->expertname}} @else {{$v->expertname or $v->enterprisename}} @endif</span>
                                <p class="supp-rec-category">需求分类：<span><em>{{$v->domain1}} / {{$v->domain2}}</em></span></p>
                            </div>
                        </div>
                        <span class="supp-rec-time">{{$v->needtime}}</span>
                        <div class="supp-rec-brief">
                            {{$v->brief}}
                        </div>
                    </a>
                    <div class="exp-rec-icon supp-rec-icon">
                        <a href="{{url('supply/detail',$v->needid)}}#reply" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                        <a href="javascript:;" class="collect @if(in_array($v->needid,$collectids)) red @endif" index="{{$v->needid}}" title="@if(in_array($v->needid,$collectids)) 已收藏 @else 收藏 @endif"><i class="iconfont icon-likeo"></i></a>
                    </div>
                </li>
               @endforeach
            </ul>
        </div>
    </div>

</div>

<script src="{{url('js/supply.js')}}" type="text/javascript"></script>
@endsection