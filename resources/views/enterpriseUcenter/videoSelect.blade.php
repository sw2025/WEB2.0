@extends("layouts.master")
@section("content")

    <link rel="stylesheet" type="text/css" href="{{asset('css/list.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <script src="{{asset('js/reselect.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
<div class="swcontainer sw-ucenter">
    <!-- 个人中心左侧 -->
    @include('layouts.entucenter')
            <!-- 个人中心主体 -->
    <div class="sw-mains">
    <div class="main">
        <!-- 专家资源 / start -->
        <div class="ucenter-con">
            <div class="reselect-top" style="display: none;">
                <label class="myinfo-check-label ischecked"><input type="checkbox"  class="myinfo-check"></label>
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

                    <div class="video-consult filter-row clearfix">
                        <span class="left-cap">视频咨询：</span>
                        <a href="javascript:;" {{$consult or 'class=active'}}>全部</a>
                        <a href="javascript:;" @if(isset($consult) && $consult == '收费') class=active @endif>收费</a>
                        <a href="javascript:;" @if(isset($consult) && $consult == '免费') class=active @endif>免费</a>
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
                                    <span class="exp-list-img"><img src="{{env('ImagePath').$v->showimage}}" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">{{$v->expertname}}</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>@if($v->state && $v->fee)￥{{$v->fee}}/分钟@else 免费 @endif</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em></em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        @foreach(explode(',',$v->domain1) as $do2)
                                            <span class="exp-lab-a">&nbsp;{{$do2}}&nbsp;</span>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    {{$v->brief}}
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
                    <a href="{{asset('uct_video/applyVideo')}}" class="back-btn reselect-btn" id="return">返回</a>
                    <button type="button" class="select-btn reselect-btn">确定</button>
                </div>
            </div>
        </div>
    </div>
        <style>
            /*搜索条*/
            .uct-search-result{padding:15px;}
            .uct-list-filter{/*max-width: 965px;min-width:800px;*/border: 1px dashed #bebebe;font-size: 12px;border-radius: 5px;background:#fff;margin:20px 0;}
            .uct-search{background:#dbdbdb;padding:20px 0;}
            .uct-list-search{width:525px;margin:0 auto;font-size: 16px;position: relative;}
            .uct-list-search-inp{width:475px;height: 40px;line-height: 40px;padding:0 20px;box-sizing: border-box;}
            .uct-list-search-btn{position: absolute;right: 0;top: 0;background:#00a7ed;border: none;color: #fff;width: 50px;height: 40px;line-height: 40px;text-align: center;}
            .uct-list-search-btn i{-webkit-text-stroke-width: 0;font-size: 20px;}
            /*排序*/
            .ucenter-con .uct-sort{margin:0 0 20px 0;}
            /*列表*/
            .uct-oh{overflow: hidden;position: relative;}
            .main-right .supply-list{margin-left: -10px;margin-right: -10px;padding-top: 24px;}
            .vid-man-top-rt .vid-man-top-con{padding:12px 12px 0;}
            .emcee span,.emceer-pers{display: block;float: left;text-align: center;}
            .emceer-pers i{display: block;font-size: 28px;color:#00a7ed;margin-bottom: -5px;margin-top: -5px;}
            .emcee-members .emceer-pers{margin:0 1em 10px 0;}
            .myask-invite .vid-man-top-cat{margin-bottom: 3px;}
            .myask-invite .vid-man-top-con{padding:12px;}
            /***********专家视频咨询 end***********/
            .datas-newchange{margin-top:0;margin-bottom:20px;}
            .reselect-top{color:#ed0021;position: relative;padding:12px 30px;margin:10px 0;border: 1px solid #eee;background:#fff;font-size: 15px;}
            .reselect-top .myinfo-check-label{top: 16px;left:9px;}
            .xuanzhong{position: absolute;top: 1px;right: 26px;width: 32px;height: 32px;line-height: 32px;text-align: center;background:#ececec;color:#666;border-left: 1px solid #ccc;border-bottom: 1px solid #ccc;}
            .xzchecked{color:#fff;background:#00a7ed;border-color: #fff;}
            .reselect-btn-box{text-align: center;padding-bottom: 30px;}
            .reselect-btn{display: inline-block;padding:3px 25px;border: 1px solid #ccc;border-radius: 3px;margin:0 50px;}
            .back-btn{background:#ececec;color:#333;}
            .back-btn:hover{background:#f4f4f4;}
            .select-btn{background:#1296d9;color:#fff;}
            .select-btn:hover{background:#00a7ed;}
            .reject-reason{color:#ed0021;margin-top:10px;text-align:justify;position: relative;}
            .reject-reason span{}
            .vid-new-ava{width: 40px;height: 40px;border-radius: 2px;}
            .been-read{color:#666;}
            .been-read .td-title{color:#999;}
            .been-read i{color:#d8d8d8;}
            .myinfo-page{padding:20px 0 15px;}
            .myinfo-page #Pagination .pagination a, .myinfo-page #Pagination .pagination span{padding:1px 7px;}
            .myinfo-page #Pagination .pagination .prev, .myinfo-page #Pagination .pagination .next{display: none;}
            .myinfo-page .page-sum{vertical-align: 9px;}
            /*分页*/
            .pages {overflow: hidden;/*padding:0 0 10px 25px;*/text-align: center;}
            .pages #Pagination1 {float: left;overflow: hidden;}
            .pages #Pagination1 .pagination {height: 32px;text-align: right;font-family: \u5b8b\u4f53,Arial;}
            .pages #Pagination1 .pagination a, .pages #Pagination1 .pagination span {float: left;display: inline;padding: 7px 15px;border: 1px solid #e6e6e6;border-right: none;background: #f6f6f6;color: #666666;font-family: \u5b8b\u4f53,Arial;font-size: 14px;cursor: pointer;}
            .pages #Pagination1 .pagination .current {background: #269edc;color: #fff;}
            .pages #Pagination1 .pagination .prev, .pages #Pagination1 .pagination .next {float: left;padding: 7px 15px;border: 1px solid #e6e6e6;background: #f6f6f6;color: #666666;cursor: pointer;}
            .pages #Pagination1 .pagination .prev i, .pages #Pagination1 .pagination .next i {display: inline-block;width: 4px;height: 11px;margin-right: 5px;background: url(../images/icon.fw.png) no-repeat;}
            .pages #Pagination1 .pagination .prev {border-right: none;}
            .pages #Pagination1 .pagination .pagination-break {padding: 3px 5px;border: none;border-left: 1px solid #e6e6e6;background: none;cursor: default;}
            .topPages .pages #Pagination1 .pagination .prev, .topPages .pages #Pagination1 .pagination .next{display: block!important;}
            .pages #Pagination {/*float: left;*/overflow: hidden;display: inline-block;}
            .pages #Pagination .pagination {text-align: right;font-family: \u5b8b\u4f53,Arial;overflow: hidden;}
            .pages #Pagination .pagination a, .pages #Pagination .pagination span {float: left;display: inline;padding: 7px 15px;border: 1px solid #e6e6e6;/*border-right: none;*/ background: #f6f6f6;color: #666666;font-family: \u5b8b\u4f53,Arial;font-size: 14px;cursor: pointer;}
            .pages #Pagination .pagination .current {background: #269edc;color: #fff;}
            .pages #Pagination .pagination .prev, .pages #Pagination .pagination .next {float: left;padding: 7px 15px;border: 1px solid #e6e6e6;background: #f6f6f6;color: #666666;cursor: pointer;}
            .pages #Pagination .pagination .prev i, .pages #Pagination .pagination .next i {display: inline-block;width: 4px;height: 11px;margin-right: 5px;background: url(../images/icon.fw.png) no-repeat;}
            /*.pages #Pagination .pagination .prev {border-right: none;} */
            .pages #Pagination .pagination .pagination-break {padding: 3px 5px;border: none;/*border-left: 1px solid #e6e6e6;*/ background: none;cursor: default;}

            .pages .searchPage {float: left;margin-top: 3px;}
            .pages .searchPage .page-sum {padding: 11px 13px;color: #999999;font-family: \u5b8b\u4f53,Arial;font-size: 14px;}
            .pages .searchPage .page-go {padding: 8px 0;color: #999999;font-family: \u5b8b\u4f53,Arial;font-size: 14px;padding: 10px 0\9;*padding: 6px 0;}
            .pages .searchPage .page-go input {width: 21px;height: 20px;margin: 0 5px;padding-left: 5px;border: 1px solid #e4e4e4;}
            .pages .searchPage .page-btn {margin: 9px 0 5px 5px;padding: 2px 5px;background: #269edc;border-radius: 2px;color: #ffffff;font-family: Arial, 'Microsoft YaHei';font-size: 14px;text-decoration: none;}
            .pages .page-sum{/*float: left;*/margin-top: 2px;margin-left: 20px;color:#666;display: inline-block;vertical-align: 12px;}
            .allPage{font-weight: normal;}
        </style>
    <script type="text/javascript">
        $(function(){
            if($.cookie("videoreselect")){
                var expertChecked=$.cookie('videoreselect').split(",");
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
            var date = new Date();
            date.setTime(date.getTime() + (120 * 60 * 1000));
            if($.cookie("videoreselect")){
                reselect=$.cookie('videoreselect').split(",");
            }else{
                reselect=[];
                $.cookie("videoreselect",reselect,{expires:date,path:'/',domain:'sw2025.com'});
            }
            if(reselect.length==5){
                if($.inArray(value,reselect)>=0){
                    deleteArray(reselect,value);
                    $.cookie("videoreselect",reselect.join(","),{expires:date,path:'/',domain:'sw2025.com'});
                }else{
                    layer.confirm('您已经指定5位专家', {
                        btn: ['确定'] //按钮
                    });
                    return false;
                }
            }else{
                if(!$(this).hasClass("xzchecked")){
                    reselect.push(value);
                    $.cookie("videoreselect",reselect.join(','),{expires:date,path:'/',domain:'sw2025.com'});
                }else{
                    deleteArray(reselect,value);
                    $.cookie("videoreselect",reselect.join(","),{expires:date,path:'/',domain:'sw2025.com'});
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
            var date = new Date();
            date.setTime(date.getTime() + (120 * 60 * 1000));
            if($(".myinfo-check-label").hasClass('ischecked')){
                $.cookie("videoisAppoint",1,{expires:date,path:'/',domain:'sw2025.com'});
            }else{
                $.cookie("videoisAppoint",0,{expires:date,path:'/',domain:'sw2025.com'});
            }
            window.location.href="{{asset('entmysector/supplysector')}}";
        })
        $("#return").on("click",function(){
            $.cookie("videoreselect","",{path:'/',domain:'sw2025.com'});
            window.location.href="{{url('entmysector/supplysector')}}";
        })

    </script>

@endsection