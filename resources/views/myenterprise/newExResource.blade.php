@extends("layouts.ucenter2")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/experts.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <div class="ucenter-con">
                <div class="uct-list-filter">
                    <div class="uct-search">
                        <div class="uct-list-search">
                            <input type="text" class="uct-list-search-inp placeholder " placeholder="请输入专家姓名／机构名称／企业家姓名" value="{{$searchname or null}}">
                            <button type="button" class="uct-list-search-btn"><i class="iconfont icon-sousuo"></i></button>
                        </div>
                    </div>
                    <!-- 筛选条件 start -->
                    <div class="uct-search-result">
                        <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
                            @if(isset($action))<a href="javascript:;" class="all-results-trace all-results-opt">{{$action}}</a>@endif
                            @if(isset($role))<a href="javascript:;" class="all-results-expert all-results-opt">{{$role}}</a>@endif
                            @if(isset($supply))<a href="javascript:;" class="all-results-field all-results-opt">{{$supply[0].'/'.$supply[1]}}</a>@endif
                            @if(isset($address))<a href="javascript:;" class="all-results-location all-results-opt">{{$address}}</a>@endif
                            @if(isset($consult))<a href="javascript:;" class="all-results-video all-results-opt">{{$consult}}</a>@endif
                        </div>
                        <div class="my-trace filter-row clearfix">
                            <span class="left-cap">我的足迹：</span>
                            <a href="javascript:;" {{$role or 'class=active'}}>不限</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已收藏') class=active @endif index="collect">已收藏</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已留言') class=active @endif index="message">已留言</a>
                        </div>
                        <div class="experts-classify filter-row clearfix">
                            <span class="left-cap">专家分类：</span>
                            <a href="javascript:;" {{$role or 'class=active'}}>不限</a>
                            <a href="javascript:;" @if(isset($role) && $role == '知名专家') class=active @endif>知名专家</a>
                            <a href="javascript:;" @if(isset($role) && $role == '知名机构') class=active @endif>知名机构</a>
                            <a href="javascript:;" @if(isset($role) && $role == '知名企业家') class=active @endif>知名企业家</a>
                        </div>
                        <div class="video-consult filter-row clearfix">
                            <span class="left-cap">视频咨询：</span>
                            <a href="javascript:;" {{$consult or 'class=active'}}>不限</a>
                            <a href="javascript:;" @if(isset($consult) && $consult == '收费') class=active @endif>收费</a>
                            <a href="javascript:;" @if(isset($consult) && $consult == '免费') class=active @endif>免费</a>
                        </div>
                        <div class="serve-field filter-row clearfix">
                            <span class="left-cap">服务领域：</span>
                            <a href="javascript:;" class="serve-all @if(empty($supply)) active @endif">不限</a>
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
                                <a href="javascript:;" @if(empty($address)) class="active" @endif">不限</a>
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
                <div class="main-right uct-oh">
                    <ul class="supply-list clearfix">
                        @foreach($datas as $v)
                        <li class="col-md-6">
                            <a href="{{url('uct_resource/resDetail',$v->expertid)}}" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="{{asset($v->showimage)}}" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">{{$v->expertname}}</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>@if($v->state && $v->fee)￥{{$v->fee}}@else 免费 @endif</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em> {{$v->domain1}} </em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        @foreach(explode(',',$v->domain2) as $do2)
                                            <span class="exp-lab-a"> {{$do2}} </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    {{$v->brief}}...
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="{{url('expert/detail',$v->expertid)}}#reply" class="review" title="留言"><i class="iconfont icon-pinglun1"></i> {{$v->messcount}}</a>
                                <a href="javascript:;" class="collect @if(in_array($v->expertid,$collectids)) red @endif" index="{{$v->expertid}}" title="@if(in_array($v->expertid,$collectids))已收藏 @else 收藏@endif"><i class="iconfont icon-likeo"></i> <span>{{$v->collcount}}</span></a>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    <div class="pages myinfo-page v-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                    </div>
                </div>
            </div>
<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("{{$datas->lastpage()}}",{'callback':pageselectCallback,'current_page':{{$datas->currentPage()-1}}});

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
</script>
    <script src="{{url('js/myexpert.js')}}" type="text/javascript"></script>
@endsection