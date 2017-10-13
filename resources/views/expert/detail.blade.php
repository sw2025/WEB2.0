@extends("layouts.master")
@section("content")
<script type="text/javascript" src="{{asset('js/reply.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/details.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />
<style>
    textarea{
        border:none;
    }

    .textareaspan{
        width:99%;
        font-size: 14px;
    }
    #selectexpert{
        float: right;
        border: 1px solid #000;
        padding: 4px;
        background: #fff;
        border-radius: 5px;
    }
    #selectexpert:hover{
        background: #3daff3;
        color: #fff;
    }
</style>
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
                    <button id="selectexpert" style="font-size: 15px;" onclick="selectexpertjoinevent(null)">邀请专家办事/视频咨询</button>
                    <img src="@if(empty($datas->showimage)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$datas->showimage}}@endif" class="exp-details-img" />
                    <div class="exp-details-brief">
                        <span class="exp-details-name"><i class="iconfont icon-iconfonticon"></i>{{$datas->expertname}}</span>
                        <a href="javascript:;" index="{{$datas->expertid}}" class="collect-state @if(in_array($datas->expertid,$collectids)) done @endif">@if(in_array($datas->expertid,$collectids))已收藏 @else 收藏 @endif</a>
                        <span class="exp-details-time">入驻时间：<em>{{$datas->created_at}}</em></span>
                        <span class="exp-details-categary">分<b class="wem2"></b>类：<em>{{$datas->category}}</em></span>
                        <span class="exp-details-video">视频咨询：<em>@if(!$datas->state || $datas->fee == 0)免费@else ￥{{$datas->fee}} @endif</em></span>
                        <span class="exp-details-best">擅长领域：<em>{{$domainselect[$datas->domain1]}}</em></span>
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
                        <span class="details-tit-cap">专家介绍</span>
                    </div>
                    <textarea id="textarea" class="details-abs-desc" readonly>{{$datas->brief}}</textarea><a name="reply"></a>
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
                <!-- 新增代码/start -->
                <div class="publish-need-sel">
                    <span class="publ-need-sel-cap">留言问题分类</span><a href="javascript:;" class="publ-need-sel-def" style="margin-left: 130px;" id="message">请选择</a>
                    <ul class="publish-need-list" style="display: none;">
                        @foreach($cate as $v)
                            @if($v->level == 1)
                                <li>
                                    <a href="javascript:;">{{$v->domainname}}</a>
                                    <ul class="publ-sub-list">
                                        @foreach($cate as $small)
                                            @if($small->parentid == $v->domainid && $small->level == 2)
                                                <li>{{$small->domainname}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                    </ul>
                </div>
                <!-- 新增代码/end -->
                <form action="">
                    <div class="message-write">
                        <textarea name="content" id="{{$datas->expertid}}" cols="30" rows="10" class="message-txt" placeholder="请输入想给专家留言的需求信息(按照发布需求的格式)"></textarea>
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
                            @if(!$v->parentid && ((!empty(session('userId')) && $v->userid == session('userId')) || $datas->userid == session('userId')))
                                <div class="mes-list-box clearfix">
                                    <div class="floor-host">
                                        <img src="@if(empty($v->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$v->avatar}}@endif" class="floor-host-ava" />
                                        <div class="floor-host-desc">
                                            <a href="javascript:;" class="floor-host-name">{{$v->nickname or substr_replace($v->phone,'****',3,4)}} [{{$v->enterprisename or $v->expertname}}]</a><span class="floor-host-time">{{$v->messagetime}}</span>@if(!empty(session('userId')) && $v->userid == session('userId'))<button id="selectexpert" onclick="selectexpertjoinevent($(this).siblings('textarea'))">邀请专家进入办事</button>@endif
                                            <textarea class="floor-host-words textareaspan" readonly>{{$v->content}}</textarea>
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
                                                            <a href="javascript:;" class="floor-guest-name"> @if($reply->userid == $datas->userid) {{$reply->expertname}} @else{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}} [{{$reply->enterprisename or $reply->expertname}}] @endif</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" class="reply-btn replybtn1" userid="{{$reply->userid}}">回复</a>
                                                        </div>
                                                    </li>
                                                @elseif($reply->parentid == $v->id)

                                                    <li>
                                                        <img src="@if(empty($reply->avatar)){{url('img/avatar.jpg')}}@else {{env('ImagePath').$reply->avatar}}@endif" class="floor-guest-ava" />
                                                        <div class="gloor-guest-cnt">
                                                            <a href="javascript:;" class="floor-guest-name">@if($reply->userid == $datas->userid) {{$reply->expertname}} @else{{$reply->nickname or substr_replace($reply->phone,'****',3,4)}}  [{{$reply->enterprisename or $reply->expertname}}] @endif</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">@if($reply->phone2 == $datas->phone) {{$reply->expertname}} @else {{$reply->nickname2 or substr_replace($reply->phone2,'****',3,4)}} @endif</a>
                                                            <span class="floor-guest-words">{{$reply->content}}</span>
                                                        </div>
                                                        <div class="floor-bottom">
                                                            <span class="floor-guest-time">{{$reply->messagetime}}</span><a href="javascript:;" userid="{{$reply->userid}}" class="reply-btn replybtn1">回复</a>
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
                            <span class="exp-rec-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>@if(!$v->state || $v->fee == 0) 免费 @else ￥{{$v->fee}}/5分钟 @endif</em></span>
                            <span class="exp-rec-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>{{$domainselect[$v->domain1]}}</em></span>
                            <div class="exp-rec-lab">
                                @foreach(explode(',',$v->domain2) as $v2)
                                <span class="exp-lab-a">{{$v2}}</span>
                                    @endforeach
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
<script src="{{url('js/textareaauto.js')}}" type="text/javascript"></script>
<script>
        $(function(){
            //*********** 新增页面js/start ***********//
            $('.publ-need-sel-def').click(function (e) {
                e.stopPropagation();
                $(this).next('ul').stop().slideToggle();
            });
            $('.publish-need-list li').hover(function() {
                $(this).children('ul').stop().show();
            }, function() {
                $(this).children('ul').stop().hide();
            });

            $('.publ-sub-list li').click(function (e) {
                e.stopPropagation();
                var publishHtml = $(this).html();
                var parentname=$(this).parent().siblings().html();
                //$(this).parent().prev('a').html(parentname+'/'+publishHtml);
                $('.publ-need-sel-def').html(parentname+'/'+publishHtml);
                $('.publish-need-list').hide();
            });
            $(document).click(function(event) {
                $('.publish-need-list').hide();
            });
            //*********** 新增页面js/end ***********//

        })

    /**
     * Created by admin on 2017/9/24.
     */
    function selectexpertjoinevent(obj){
        if(!$.cookie('userId')){
            layer.confirm('您还未登陆是否去登陆？', {
                btn: ['去登陆','暂不需要'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href='/login';
            }, function(){
                layer.close();
            });
            return false;
        }
        if(obj != null){
            var str = '<div style="padding:10px;">系统会自动在创建办事/视频咨询的过程中将您的问题分类和需求自动填充到新建办事/视频咨询中，可进行修改后完成邀请专家。是否继续？</div>';
        }else{
            var str = '<div style="padding:10px;">系统会自动选定当前专家作为您的自选专家请后续补充相关的领域和办事/视频咨询描述</div>';
        }
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['400px', '180px'],
            shadeClose: false, //开启遮罩关闭
            title:'新建[办事/视频咨询]提醒',
            content: str,
            btn: ['邀请办事','邀请视频咨询','取消'],
            yes: function(index, layero){
                $.cookie("isAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("reselect",'{{$datas->expertid.$datas->showimage}}',{path:'/',domain:'sw2025.com'});
                if(obj != null){
                    var ss = $(obj).val().split(/【(.*)】/i);
                    $.cookie("domain",ss[1],{path:'/',domain:'sw2025.com'});
                    $.cookie("describe", $.trim(ss[2]),{path:'/',domain:'sw2025.com'});
                }
                window.location.href="{{url('uct_works/applyWork')}}";
            },btn2: function(index, layero){
                $.cookie("videoisAppoint",1,{path:'/',domain:'sw2025.com'});
                $.cookie("videoreselect",'{{$datas->expertid.$datas->showimage}}',{path:'/',domain:'sw2025.com'});
                if(obj != null){
                    var ss = $(obj).val().split(/【(.*)】/i);
                    $.cookie("videodomain",ss[1],{path:'/',domain:'sw2025.com'});
                    $.cookie("videodescribe", $.trim(ss[2]),{path:'/',domain:'sw2025.com'});
                }
                window.location.href="{{url('/uct_video/applyVideo')}}";
            },btn3: function (index, layero){
                layer.close(index);
            }
        });
    }

    $(function () {
        /* $.each($("textarea"), function(i, n){
         autoTextarea($(n)[0]);
         });*/
        $('.textareaspan').each(function () {
            autoTextarea($(this)[0]);
        });

    })
    var autoTextarea = function (elem, extra, maxHeight) {
        extra = extra || 0;
        var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
                isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
                addEvent = function (type, callback) {
                    elem.addEventListener ?
                            elem.addEventListener(type, callback, false) :
                            elem.attachEvent('on' + type, callback);
                },
                getStyle = elem.currentStyle ?
                        function (name) {
                            var val = elem.currentStyle[name];
                            if (name === 'height' && val.search(/px/i) !== 1) {
                                var rect = elem.getBoundingClientRect();
                                return rect.bottom - rect.top -
                                        parseFloat(getStyle('paddingTop')) -
                                        parseFloat(getStyle('paddingBottom')) + 'px';
                            };
                            return val;
                        } : function (name) {
                    return getComputedStyle(elem, null)[name];
                },
                minHeight = parseFloat(getStyle('height'));
        elem.style.resize = 'none';//如果不希望使用者可以自由的伸展textarea的高宽可以设置其他值

        var change = function () {
            var scrollTop, height,
                    padding = 0,
                    style = elem.style;

            if (elem._length === elem.value.length) return;
            elem._length = elem.value.length;

            if (!isFirefox && !isOpera) {
                padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
            };
            scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

            elem.style.height = minHeight + 'px';
            if (elem.scrollHeight > minHeight) {
                if (maxHeight && elem.scrollHeight > maxHeight) {
                    height = maxHeight - padding;
                    style.overflowY = 'auto';
                } else {
                    height = elem.scrollHeight - padding;
                    style.overflowY = 'hidden';
                };
                style.height = height + extra + 'px';
                scrollTop += parseInt(style.height) - elem.currHeight;
                document.body.scrollTop = scrollTop;
                document.documentElement.scrollTop = scrollTop;
                elem.currHeight = parseInt(style.height);
            };
        };

        addEvent('propertychange', change);
        addEvent('input', change);
        addEvent('focus', change);
        change();
    };

</script>
@endsection