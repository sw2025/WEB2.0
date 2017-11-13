@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/reply.js')}}"></script>

    <div class="main">
            <!-- 我的需求 / start -->
            <h3 class="main-top">我的商情</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name">
                        {{$datas->expertname or $datas->enterprisename}}
                    </div>
                    <div class="myneeds">
                        <div class="myneed-con">
                            <span class="myneed-type">商情大类：{{$datas->domain1}} </span>
                            <span class="myneed-type">商情小类：{{$datas->domain2}} </span>
                            <span class="myneed-time">发布时间：<em>{{$datas->needtime}}1</em></span>
                            @if($datas->userid == session('userId') && $configid->configid == 3)<div class="myneed-set"><button class="myneed-set-btn" index="{{$cryptid}}" supplyid="{{$datas->needid}}">设为关闭</button><span class="myneed-tips">提示：设为关闭后将不在展示到升维平台</span></div>@endif
                            @if($datas->userid == session('userId') && $configid->configid == 4)<div class="myneed-set">已关闭~ </div>@endif
                            <div class="myneed-icon">
                                <a href="javascript:;" class="collect"><i class="iconfont icon-likeo"></i>{{$collcount}}</a>
                                <a href="javascript:;" class="visitor"><i class="iconfont icon-yanjing"></i>{{$datas->looks or 0}}</a>
                            </div>
                            <div class="myneed-desc">
                                <span class="myneed-desc-tit">商情描述</span>
                                <textarea class="myneed-desc-para" id="textarea" style="width: 100%;border:none;overflow-y: auto;">{{$datas->brief}}</textarea>
                            </div>
                        </div>
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
                                                <img src="@if(empty($v->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->avatar}}@endif" class="floor-host-ava" />
                                                <div class="floor-host-desc">
                                                    <a href="javascript:;" class="floor-host-name">{{$v->nickname or substr_replace($v->phone,'****',3,4)}} [{{$v->enterprisename or $v->expertname}}]</a><span class="floor-host-time">{{$v->messagetime}}</span>
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
                                                                <img src="@if(empty($reply->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$reply->avatar}}@endif" class="floor-guest-ava" />
                                                                <div class="gloor-guest-cnt">
                                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->enterprisename or $reply->expertname}}]</a>
                                                                    <span class="floor-guest-words">{{$reply->content}}</span>
                                                                </div>
                                                                <div class="floor-bottom">
                                                                    <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn" userid="{{$reply->userid}}">回复</a>
                                                                </div>
                                                            </li>
                                                        @elseif($reply->parentid == $v->id)

                                                            <li>
                                                                <img src="@if(empty($reply->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$reply->avatar}}@endif" class="floor-guest-ava" />
                                                                <div class="gloor-guest-cnt">
                                                                    <a href="javascript:;" class="floor-guest-name">{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->enterprisename or $reply->expertname}}]</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">{{$reply->nickname2 or substr_replace($reply->phone2,'****',3,4)}}</a>
                                                                    <span class="floor-guest-words">{{$reply->content}}</span>
                                                                </div>
                                                                <div class="floor-bottom">
                                                                    <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" userid="{{$reply->userid}}" class="reply-btn">回复</a>
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
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(function(){
            $('.bank-card').keyup(function(){
                var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
                $(this).val(value)
            })
        })
        $('.myneed-set-btn').on('click',function () {
            var mdid = $(this).attr('index');
            var supplyid = $(this).attr('supplyid');
            layer.confirm('您确定要关闭此商情？', {
                btn: ['确定','摁错了~'] //按钮
            }, function(){
                $.post('{{url('uct_myneed/solveNeed')}}',{'mdid':mdid,'supplyid':supplyid},function (data) {
                    layer.msg(data.msg,{'icon':data.icon,time: 1500},function () {
                        window.location.href = document.referrer;
                    });
                });
            }, function(){
                layer.close();
            });

        });
    </script>
    <script src="{{url('js/mysupply.js')}}" type="text/javascript"></script>
    <script src="{{url('js/textareaauto.js')}}" type="text/javascript"></script>
@endsection