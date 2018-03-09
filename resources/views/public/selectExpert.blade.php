@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/selectExpert.css')}}">
    <script type="text/javascript" src="{{asset('js/select.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/myexpert.js')}}"></script>

<!-- 公共header / end -->
<!-- 搜索框 / start -->
<div class="section">
    <div class="swcontainer list-bg">
        <div class="list-search">
            <input type="text" class="list-search-inp" placeholder="请输入大V姓名" value="{{$searchname or null}}"/>
            <button type="button" class="list-search-btn"><i class="iconfont icon-sousuo"></i></button>
        </div>
    </div>
</div>
<!-- 搜索框 / end -->
<!-- 筛选条件 / start -->
<div class="swcontainer list-filter">
    <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
        @if(isset($address))<a href="javascript:;" class="all-results-location all-results-opt">{{$address}}</a>@endif
    </div>
    {{--<div class="experts-classify filter-row clearfix">
        <span class="left-cap">专家分类：</span>
        <a href="javascript:;" class="active">全部</a>
        <a href="javascript:;">知名专家</a>
        <a href="javascript:;">知名机构</a>
        <a href="javascript:;">知名企业家</a>
    </div>--}}
    {{--<div class="video-consult filter-row clearfix">
        <span class="left-cap">视频咨询：</span>
        <a href="javascript:;" class="active">全部</a>
        <a href="javascript:;">收费</a>
        <a href="javascript:;">免费</a>
    </div>--}}
    {{--<div class="serve-field filter-row clearfix">
        <span class="left-cap">服务领域：</span>
        <a href="javascript:;" class="serve-all active">全部</a>
        <div class="serve-field-list">
            <a href="javascript:;" class="serve-field-list-deft">销售类</a>
            <ul class="serve-field-list-show">
                <li>销售1</li>
                <li>销售2</li>
            </ul>
        </div>
        <div class="serve-field-list">
            <a href="javascript:;" class="serve-field-list-deft">投资类</a>
            <ul class="serve-field-list-show">
                <li>投资1</li>
                <li>投资2</li>
            </ul>
        </div>
        <div class="serve-field-list">
            <a href="javascript:;" class="serve-field-list-deft">金融类</a>
            <ul class="serve-field-list-show">
                <li>金融1</li>
                <li>金融2</li>
            </ul>
        </div>
        <div class="serve-field-list">
            <a href="javascript:;" class="serve-field-list-deft">服务类</a>
            <ul class="serve-field-list-show">
                <li>服务1</li>
                <li>服务2</li>
            </ul>
        </div>
    </div>--}}
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
<!-- 筛选条件 / end -->
<div class="swcontainer">
    <div class="sw-row">
        <!-- 排序 / start -->
        <div class="sort">
            <a href="javascript:;" class="list-time @if(!empty($ordertime)) active @endif">认证时间<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordertime) && $ordertime == 'asc') white-color @elseif(!empty($ordertime) && $ordertime == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordertime) && $ordertime == 'asc') blue-color  @elseif(!empty($ordertime) && $ordertime == 'desc') white-color  @endif"></i></span></a>
        </div>
        <!-- 排序 / end -->
        <!-- 专家列表 / start -->
        <ul class="expert-list clearfix">
            @foreach($datas as $v)
            <li class="swcol-md-4">
                <a href="expert_details.html" class="expert-list-link">
                    <div class="exp-list-top">
                        <span class="exp-list-img"><img src="{{env('ImagePath').$v->showimage}}" /></span>
                        <div class="exp-list-brief">
                            <span class="exp-list-name">{{$v->expertname}}</span>
                            <span class="exp-list-video"><i class="iconfont icon-shipin"></i>所在地区：<em>{{$v->address}}</em></span>
                            <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域<em></em></span>
                        </div>
                        <div class="exp-list-lab">
                            @foreach(explode(',',$v->domain1) as $domain)
                                <span class="exp-lab-a">{{$domain}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="exp-list-desc">
                        {{$v->brief}}
                    </div>
                </a>
                <span class="checkbox-wrapper nocheck xuanzhong" linefee="{{$v->linefee}}"fee="{{$v->fee}}" name="{{$v->expertname}}" id="{{$v->expertid}}" index="{{$v->showimage}}"></span>
            </li>
            @endforeach
        </ul>
        <!-- 专家列表 / end -->
        <!-- 分页 -->
        <div class="pages">
            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
        </div>

        <div class="reselect-btn-box">
            <a href="javascript:;" class="back-btn reselect-btn" id="return">返回</a>
            <button type="button" class="select-btn reselect-btn" id="submit">确定</button>
        </div>
    </div>
</div>

<!-- 公共footer / end -->

<script type="text/javascript">
    $(function(){
        if($.cookie("reselect")){
            var expertChecked=$.cookie('reselect').split(",");
            for(var i=0; i<expertChecked.length; i++) {
                var checked=expertChecked[i];
                var end=checked.indexOf("@");
                var id=checked.substring(0,end);
                $("#"+id).removeClass('nocheck');
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
        var name=$(this).attr("name");
        var linefee=$(this).attr("linefee");
        var fee=$(this).attr("fee");
        var key=$(this).attr("id");
        var img=$(this).attr("index");
        var type = "{{$type}}";
        if( type == 'show'){
            var value=key+'@'+img;
        }else{
            var value=key+'@'+img+'@'+name+'@'+linefee+'@'+fee;
        }
        var reselect;
        var date = new Date();
        date.setTime(date.getTime() + (120 * 60 * 1000));
        if($.cookie("reselect")){
            reselect=$.cookie('reselect').split(",");
        }else{
            reselect=[];
            $.cookie("reselect",reselect,{expires:date,path:'/',domain:'sw2025.com'});
            $.cookie("reselect",reselect,{expires:date,path:'/',domain:'swchina.com'});
        }
        console.log(reselect);
        if("{{$type}}"=="show"){
            var allownumbers=5;
        } else if("{{$type}}"=="meet"){
            var allownumbers=1;
        }
        if(reselect.length==allownumbers){
            if($.inArray(value,reselect)>=0){
                deleteArray(reselect,value);
                $.cookie("reselect",reselect.join(","),{expires:date,path:'/',domain:'sw2025.com'});
                $.cookie("reselect",reselect.join(","),{expires:date,path:'/',domain:'swchina.com'});
            }else{
                layer.alert('您已经指定'+allownumbers+'位大V', {
                    btn: ['确定'], //按钮
                    'title':'升维网提示'
                });
                $('#'+key).addClass('nocheck');
                return false;
            }
        }else{
            if($(this).hasClass("nocheck")){
                reselect.push(value);
                $.cookie("reselect",reselect.join(','),{expires:date,path:'/',domain:'sw2025.com'});
                $.cookie("reselect",reselect.join(','),{expires:date,path:'/',domain:'swchina.com'});
            }else{
                deleteArray(reselect,value);
                $.cookie("reselect",reselect.join(","),{expires:date,path:'/',domain:'sw2025.com'});
                $.cookie("reselect",reselect.join(","),{expires:date,path:'/',domain:'swchina.com'});
            }
        }
        $(this).toggleClass('nocheck');
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
    $("#submit").on("click",function(){
        if("{{$type}}"=="show"){
            window.location.href="{{url('showIndex')}}";
        } else if("{{$type}}"=="meet"){
            window.location.href="{{url('meetIndex')}}";
        } else if("{{$type}}"=="daV"){
            window.location.href="{{url('daVIndex')}}";
        }
    })
    $("#return").on("click",function(){
        $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
        $.cookie("reselect","",{path:'/',domain:'swchina.com'});
        if("{{$type}}"=="show"){
            window.location.href="{{url('showIndex')}}";
        } else if("{{$type}}"=="meet"){
            window.location.href="{{url('meetIndex')}}";
        } else if("{{$type}}"=="daV"){
            window.location.href="{{url('daVIndex')}}";
        }

    })

</script>

@endsection

