@extends("layouts.master")
@section("content")
<!-- 搜索框 / start -->
<div class="section">
    <div class="container list-bg">
        <form action="">
            <div class="list-search">
                <input type="text" class="list-search-inp" placeholder="请输入要搜索的供求信息关键字" />
                <button type="button" class="list-search-btn"><i class="iconfont icon-sousuo"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- 搜索框 / end -->
<!-- 筛选条件 / start -->
<div class="container list-filter">
    <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
        @if(isset($role))<a href="javascript:;" class="all-results-expert all-results-opt">{{$role}}</a>@endif
        @if(isset($supply))<a href="javascript:;" class="all-results-field all-results-opt">{{$supply}}</a>@endif
        @if(isset($address))<a href="javascript:;" class="all-results-location all-results-opt">{{$address}}</a>@endif
    </div>
    <div class="experts-classify filter-row clearfix">
        <span class="left-cap">发布类别：</span>
        <a href="javascript:;" {{$role or 'class=active'}} >全部</a>
        <a href="javascript:;" @if(isset($role) && $role == '专家') class=active @endif>专家</a>
        <a href="javascript:;" @if(isset($role) && $role == '企业') class=active @endif>企业</a>
    </div>
    <div class="serve-field filter-row clearfix">
        <span class="left-cap">需求领域：</span>
        <a href="javascript:;" class="serve-all @if(empty($domain1)) active @endif">全部</a>
        @foreach($cate as $big)
            @if($big->level == 1)
            <div class="serve-field-list">
                <a href="javascript:;" class="serve-field-list-deft @if(isset($domain1) && $domain1 != $big->domainname) active @endif">{{$big->domainname}}</a>
                <ul class="serve-field-list-show">
                    @foreach($cate as $small)
                       @if($small->level == 2 && $small->parentid == $big->domainid)
                        <li>{{$small->domainname}}</li>
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
            <a href="javascript:;" @if(empty($address)) class="active" @endif>全部</a>
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
<div class="container">
    <div class="row">
        <!-- 排序 / start -->
        <div class="sort">
            <a href="javascript:;" class="list-time active">发布时间<span class="list-order-icon"><i class="iconfont white-color icon-triangle-copy"></i><i class="iconfont blue-color icon-sanjiaoxing"></i></span></a>
            <a href="javascript:;" class="list-collect">收藏数<span class="list-order-icon"><i class="iconfont icon-triangle-copy"></i><i class="iconfont icon-sanjiaoxing"></i></span></a>
            <a href="javascript:;" class="list-reviews">留言数<span class="list-order-icon"><i class="iconfont icon-triangle-copy"></i><i class="iconfont icon-sanjiaoxing"></i></span></a>
        </div>
        <!-- 排序 / end -->
        <!-- 供求列表/start -->

        <ul class="supply-list clearfix">
            @foreach($datas as $v)
            <li class="col-md-6">
                <a href="{{url('supply/detail',$v->needid)}}" class="supply-list-link">
                    <img src="@if(empty($v->entimg)) {{asset($v->extimg)}} @else {{asset($v->entimg)}}  @endif " class="supp-list-img" />
                    <span class="supp-list-time">{{$v->needtime}}</span>
                    <div class="supp-list-brief">
                        <span class="supp-list-name">供求信息</span>
                        <span class="supp-list-category">需求分类：<em>{{$v->domain1}} / {{$v->domain2}}</em></span>
                        <div class="supp-list-desc">
                            {{$v->brief}}
                        </div>
                    </div>
                </a>
                <div class="supp-list-icon">
                    <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                    <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                </div>
            </li>
            @endforeach
        </ul>


        <!-- 供求列表/end -->
        <!-- 分页 -->
        <div class="pages">
            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
        </div>
    </div>
</div>
<!-- 公共footer / end -->

<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("{{$datas->lastpage()}}");
    })
</script>
<script src="{{url('js/supply.js')}}" type="text/javascript"></script>
@endsection
