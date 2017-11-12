@extends('layouts.ucenter3')
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/experts.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/newmyneed.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <script type="text/javascript" src="{{asset('iconfont/iconfont.js')}}"></script>
    <div class="ucenter-con">
                <!-- 选择start -->
                <div class="v-myneed-top">
                    <a href="javascript:;" class="v-release-btn" onclick="putneed()">发布商情</a>
                    <div class="v-condition">
                        <a href="javascript:;" class="v-condition-link @if(!empty($action) && $action == '已发布')active @endif" index="myput">已发布<span class="v-count">{{$putcount}}</span></a>
                      {{--  <a href="javascript:;" class="v-condition-link v-c-link1 @if(!empty($action) && $action == '待审核')active @endif" index="waitverify">待审核<span class="v-count">{{$waitcount}}</span></a>--}}
                        <a href="javascript:;" class="v-condition-link v-c-link2 @if(!empty($action) && $action == '审核失败')active @endif" index="refuseverify">审核失败<span class="v-count">{{$refusecount}}</span></a>
                    </div>
                </div>
                <!-- 选择  end -->
                <div class="uct-list-filter">
                    <div class="uct-search">
                        <button id="vipneed" index="{{$level}}"> VIP 商情 <span class="badge"> {{$vipneedcount}} </span></button>
                        <div class="uct-list-search">
                            <input type="text" class="uct-list-search-inp placeholder" placeholder="请输入要搜索的商情信息关键字" value="{{$searchname or null}}">
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
                            @if(!empty($level) && $level)<a href="javascript:;" class="all-results-vip all-results-opt">VIP商情</a>@endif
                        </div>
                        <div class="my-trace filter-row clearfix">
                            <span class="left-cap">我的足迹：</span>
                            <a href="javascript:;" {{$action or 'class=active'}} index="">不限</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已收藏') class=active @endif index="collect">已收藏</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已留言') class=active @endif index="message">已留言</a>
                        </div>
                        <div class="experts-classify filter-row clearfix">
                            <span class="left-cap">发布类别：</span>
                            <a href="javascript:;" {{$role or 'class=active'}} >不限</a>
                            <a href="javascript:;" @if(isset($role) && $role == '专家') class=active @endif>专家</a>
                            <a href="javascript:;" @if(isset($role) && $role == '企业') class=active @endif>企业</a>
                        </div>
                        <div class="serve-field filter-row clearfix">
                            <span class="left-cap">需求领域：</span>
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
                                <a href="javascript:;" @if(empty($address)) class="active" @endif>不限</a>
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
                    <div class="myask-tab-box">
                        <ul class="supply-list clearfix">
                            @foreach($datas as $v)
                            <li class="col-md-6">
                                <a href="@if($v->userid == session('userId') && $v->flag == 2) {{url('uct_myneed/supplyNeed',$v->needid)}} @elseif($v->userid == session('userId') && $v->flag == 1) {{url('uct_myneed/examineNeed',$v->needid)}} @else {{url('uct_myneed/needDetail',$v->needid)}} @endif" class="supply-list-link">
                                    <img src="@if($v->needtype == '专家')  {{env('ImagePath').$v->extimg}} @else {{env('ImagePath').$v->entimg}}  @endif" class="supp-list-img" />
                                    <span class="supp-list-time">{{date('Y-m-d',strtotime($v->needtime))}}</span>
                                    <div class="supp-list-brief">
                                        <span class="supp-list-name">【{{$v->needtype}}】@if($v->needtype == '专家'){{$v->expertname}} @else {{$v->enterprisename}}@endif</span>
                                        <span class="supp-list-category">商情分类：<em>{{$v->domain1}} / {{$v->domain2}}</em></span>
                                        <div class="supp-list-desc">
                                            {{$v->brief}}
                                        </div>
                                    </div>
                                </a>
                                <div class="supp-list-icon">
                                    @if($v->level) <span id="vipshang">VIP商情</span> @endif
                                    <a href="{{url('supply/detail',$v->needid)}}#reply" class="review" title="留言"><i class="iconfont icon-pinglun1"></i> {{$v->messcount}}</a>
                                    <a href="javascript:;" class="collect @if(in_array($v->needid,$collectids)) red @endif" index="{{$v->needid}}" title="@if(in_array($v->needid,$collectids))已收藏 @else 收藏@endif"><i class="iconfont icon-likeo"></i> <span>{{$v->collcount}}</span></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="pages myinfo-page">
                            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                        </div>
                    </div>
                    <div class="myask-tab-box"></div>
                    <div class="myask-tab-box"></div>
                </div>
            </div>

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
        $('.myask-tabar-a').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            var ind = $(this).index();

            // $('.myask-tab-box').eq(ind).show().siblings().hide();

        });
    })

    function putneed (){
        $.post('{{url('myneed/verifyputneed')}}',{'role':'企业'},function (data) {
            if(data.type == 3){
                layer.msg(data.msg,{'icon':data.icon});
            } else if(data.type == 2){
                layer.confirm(data.msg, {
                    btn: ['去认证','暂不需要'], //按钮
                    skin:'layui-layer-molv'
                }, function(){
                    window.location.href=data.url;
                }, function(){
                    layer.close();
                });
            } else if (data.type == 1){
                layer.alert(data.msg,{'icon':data.icon});
            } else {
                window.location = '{{asset('uct_myneed/supplyNeed')}}';
            }
        });

    }
</script>
    <script src="{{url('js/mysupply.js')}}" type="text/javascript"></script>
@endsection