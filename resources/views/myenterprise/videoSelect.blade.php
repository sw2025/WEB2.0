@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/list.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <script src="{{asset('js/reselect.js')}}" type="text/javascript"></script>
    <div class="main">
        <!-- 专家资源 / start -->
        <div class="ucenter-con">
            <div class="reselect-top">
                <label class="myinfo-check-label ischecked"><input type="checkbox"  class="myinfo-check"></label>如果所选专家在规定时间内未接受邀请，选择系统分配
            </div>
            <div class="uct-list-filter">
                <div class="uct-search">
                    <div class="uct-list-search">
                        <input type="text" class="uct-list-search-inp placeholder" placeholder="请输入专家姓名／机构名称／企业家姓名" value="{{$searchname or null}}">
                        <button type="button" class="uct-list-search-btn"><i class="iconfont icon-sousuo"></i></button>
                    </div>
                </div>
                <!-- 筛选条件 start -->
                <div class="uct-search-result">
                    <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
                        @if(isset($role))<a href="javascript:;" class="all-results-expert all-results-opt">{{$role}}</a>@endif
                        @if(isset($supply))<a href="javascript:;" class="all-results-field all-results-opt">{{$supply[0].'/'.$supply[1]}}</a>@endif
                        @if(isset($address))<a href="javascript:;" class="all-results-location all-results-opt">{{$address}}</a>@endif
                        @if(isset($consult))<a href="javascript:;" class="all-results-video all-results-opt">{{$consult}}</a>@endif
                    </div>
                    <div class="experts-classify filter-row clearfix">
                        <span class="left-cap">专家分类：</span>
                        <a href="javascript:;" {{$role or 'class=active'}}>全部</a>
                        <a href="javascript:;" @if(isset($role) && $role == '专家') class=active @endif>专家</a>
                        <a href="javascript:;" @if(isset($role) && $role == '机构') class=active @endif>机构</a>
                        <a href="javascript:;" @if(isset($role) && $role == '企业家') class=active @endif>企业家</a>
                    </div>
                    <div class="video-consult filter-row clearfix">
                        <span class="left-cap">视频咨询：</span>
                        <a href="javascript:;" {{$consult or 'class=active'}}>全部</a>
                        <a href="javascript:;" @if(isset($consult) && $consult == '收费') class=active @endif>收费</a>
                        <a href="javascript:;" @if(isset($consult) && $consult == '免费') class=active @endif>免费</a>
                    </div>
                    <div class="serve-field filter-row clearfix">
                        <span class="left-cap">服务领域：</span>
                        <a href="javascript:;" class="serve-all @if(empty($supply)) active @endif">全部</a>
                        @foreach($cate as $big)
                            @if($big->level == 1)
                                <div class="serve-field-list">
                                    <a href="javascript:;" class="serve-field-list-deft @if(isset($supply) && $supply[0] == $big->domainname) active @endif">{{$big->domainname}}</a>
                                    <ul class="serve-field-list-show" >
                                        @foreach($cate as $small)
                                            @if($small->level == 2 && $small->parentid == $big->domainid)
                                                <li class="@if(!empty($supply) && $small->domainname == $supply[1]) active @endif">{{$small->domainname}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="location filter-row clearfix">
                        <span class="left-cap">所在地区：</span>
                        <div class="location-province">
                            <a href="javascript:;" @if(empty($address)) class="active" @endif">全部</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="北京") class="active" @endif>北京</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="上海") class="active" @endif>上海</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="天津") class="active" @endif>天津</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="重庆") class="active" @endif>重庆</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="河北") class="active" @endif>河北</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="山西") class="active" @endif>山西</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="内蒙") class="active" @endif>内蒙</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="辽宁") class="active" @endif>辽宁</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="吉林") class="active" @endif>吉林</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="黑龙") class="active" @endif>黑龙江</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="江苏") class="active" @endif>江苏</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="浙江") class="active" @endif>浙江</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="安徽") class="active" @endif>安徽</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="福建") class="active" @endif>福建</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="江西") class="active" @endif>江西</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="山东") class="active" @endif>山东</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="河南") class="active" @endif>河南</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="湖北") class="active" @endif>湖北</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="湖南") class="active" @endif>湖南</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="广东") class="active" @endif>广东</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="广西") class="active" @endif>广西</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="海南") class="active" @endif>海南</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="四川") class="active" @endif>四川</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="贵州") class="active" @endif>贵州</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="云南") class="active" @endif>云南</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="西藏") class="active" @endif>西藏</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="陕西") class="active" @endif>陕西</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="甘肃") class="active" @endif>甘肃</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="青海") class="active" @endif>青海</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="宁夏") class="active" @endif>宁夏</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="新疆") class="active" @endif>新疆</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="台湾") class="active" @endif>台湾</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="香港") class="active" @endif>香港</a>
                            <a href="javascript:;" @if(!empty($address) && $address=="澳门") class="active" @endif>澳门</a>
                        </div>
                    </div>
                </div>
                <!-- 筛选条件 end -->
            </div>
            <!-- 排序 start -->
            <div class="sort uct-sort">
                <a href="javascript:;" class="list-time @if(!empty($ordertime)) active @endif">认证时间<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordertime) && $ordertime == 'asc') white-color @elseif(!empty($ordertime) && $ordertime == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordertime) && $ordertime == 'asc') blue-color  @elseif(!empty($ordertime) && $ordertime == 'desc') white-color  @endif"></i></span></a>
                <a href="javascript:;" class="list-collect @if(!empty($ordercollect)) active @endif">收藏数<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordercollect) && $ordercollect == 'asc') white-color @elseif(!empty($ordercollect) && $ordercollect == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordercollect) && $ordercollect == 'asc') blue-color  @elseif(!empty($ordercollect) && $ordercollect == 'desc') white-color  @endif"></i></span></a>
                <a href="javascript:;" class="list-reviews @if(!empty($ordermessage)) active @endif">留言数<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordermessage) && $ordermessage == 'asc') white-color @elseif(!empty($ordermessage) && $ordermessage == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordermessage) && $ordermessage == 'asc') blue-color  @elseif(!empty($ordermessage) && $ordermessage == 'desc') white-color  @endif"></i></span></a>
            </div>
            <!-- 排序 end -->
            <div class="main-right uct-oh">
                <ul class="supply-list clearfix">
                    @foreach($datas as $v)
                        <li class="col-md-6">
                            <a href="{{url('expert/detail/'.$v->expertid)}}" class="expert-list-link"  target="_blank">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="{{asset($v->showimage)}}" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">{{$v->expertname}}</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>@if($v->state && $v->fee)￥{{$v->fee}}@else 免费 @endif</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>{{$v->domain1}}</em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        @foreach(explode(',',$v->domain2) as $do2)
                                            <span class="exp-lab-a">&nbsp;{{$do2}}&nbsp;</span>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    1996年，科比被当时的夏洛特黄蜂以首轮第13顺位选中，随即他被交易到湖人。在漫长的职业生涯里，科比帮助比被当时的...
                                </div>
                            </a>
                            <a href="javascript:;" class="xuanzhong" id="{{$v->expertid}}" showImg="{{$v->showimage}}"><i class="iconfont icon-xuanzhong"></i></a>
                        </li>
                    @endforeach
                </ul>
                <div class="pages myinfo-page">
                    <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                </div>
                <div class="reselect-btn-box">
                    <a href="{{asset('uct_video/applyVideo')}}" class="back-btn reselect-btn">返回</a>
                    <button type="button" class="select-btn reselect-btn">确定</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            if($.cookie("reselect")){
                var expertChecked=$.cookie('reselect').split(",");
                for(var i=0; i<expertChecked.length; i++) {
                    var checked=expertChecked[i];
                    var end=checked.indexOf("/");
                    var id=checked.substring(0,end);
                    $("#"+id).addClass('xzchecked')
                }
            }
            var currentPage=parseInt("{{$datas->currentPage()}}")-1;
            $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':currentPage});
            function pageselectCallback(page_index, jq){
                // 从表单获取每页的显示的列表项数目
                var current = parseInt(page_index)+1;
                var url = window.location.href;
                url = url.replace(/(\?|\&)?page=\d+/,'');
                var isexist = url.indexOf("?");
                if(isexist == -1){
                    url += '?ordertime=desc&page='+current;
                } else {
                    url += '&page='+current;
                }
                window.location=url;
                //阻止单击事件
                return false;
            }
        })
        $('.xuanzhong').click(function(event) {
            var key=$(this).attr("id");
            var img=$(this).attr("showImg");
            var value=key+img;
            var reselect;
            if($.cookie("reselect")){
                reselect=$.cookie('reselect').split(",");
            }else{
                reselect=[];
                $.cookie("reselect",reselect,{expires:7,path:'/',domain:'sw2025.com'});
            }
            if(reselect.length==5){
                if($.inArray(value,reselect)>=0){
                    deleteArray(reselect,value);
                    $.cookie("reselect",reselect.join(","),{expires:7,path:'/',domain:'sw2025.com'});
                }else{
                    layer.confirm('您已经指定5位专家', {
                        btn: ['确定'] //按钮
                    });
                    return false;
                }
            }else{
                if(!$(this).hasClass("xzchecked")){
                    reselect.push(value);
                    $.cookie("reselect",reselect.join(','),{expires:7,path:'/',domain:'sw2025.com'});
                }else{
                    deleteArray(reselect,value);
                    $.cookie("reselect",reselect.join(","),{expires:7,path:'/',domain:'sw2025.com'});
                }
            }
            $(this).toggleClass('xzchecked');
        });
        //删除已经指定的专家
        var deleteArray=function (arr, val) {
            for(var i=0; i<arr.length; i++) {
                if(arr[i] == val) {
                    arr.splice(i, 1);
                    break;
                }
            }
        }
        $(".reselect-btn").on("click",function(){
            if($(".myinfo-check-label").hasClass('ischecked')){
                $.cookie("isAppoint",1,{expires:7,path:'/',domain:'sw2025.com'});
            }else{
                $.cookie("isAppoint",0,{expires:7,path:'/',domain:'sw2025.com'});
            }
            window.location.href="{{asset('uct_video/applyVideo')}}";
        })

    </script>
@endsection