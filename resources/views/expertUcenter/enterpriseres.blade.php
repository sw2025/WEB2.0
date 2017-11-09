@extends("layouts.ucenter4")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/experts.css')}}" />
    <script type="text/javascript" src="js/list.js"></script>
            <!-- 企业资源 / start -->
            <div class="ucenter-con">

                <div class="uct-list-filter">
                    <div class="uct-search">
                        <div class="uct-list-search">
                            <input type="text" class="uct-list-search-inp placeholder" placeholder="请输入企业名称" value="{{$searchname or null}}">
                            <button type="button" class="uct-list-search-btn"><i class="iconfont icon-sousuo"></i></button>
                        </div>
                    </div>
                    <!-- 筛选条件 start -->
                    <div class="uct-search-result">
                        <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span>
                           {{-- @if(isset($role))<a href="javascript:;" class="all-results-expert all-results-opt">{{$role}}</a>@endif
                            @if(isset($supply))<a href="javascript:;" class="all-results-field all-results-opt">{{$supply[0].'/'.$supply[1]}}</a>@endif--}}
                            @if(isset($action))<a href="javascript:;" class="all-results-trace all-results-opt">{{$action}}</a>@endif
                            @if(isset($address))<a href="javascript:;" class="all-results-location all-results-opt">{{$address}}</a>@endif
                            @if(isset($industry))<a href="javascript:;" class="all-results-video all-results-opt">{{$industry}}</a>@endif

                        </div>
                        <div class="my-trace filter-row clearfix">
                            <span class="left-cap">我的足迹：</span>
                            <a href="javascript:;"  @if(empty($action)) class="active" @endif>全部</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已收藏') class=active @endif index="collect">已收藏</a>
                            <a href="javascript:;" @if(isset($action) && $action == '已留言') class=active @endif index="message">已留言</a>
                        </div>
                        {{--<div class="experts-classify filter-row clearfix">
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
                        </div>--}}
                        <div class="serve-field filter-row clearfix">
                            <span class="left-cap">所在行业：</span>
                            <div class="industry-province">
                                <a href="javascript:;" @if(empty($industry)) class="active" @endif>全部</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='IT|通信|电子|互联网') class="active" @endif>IT|通信|电子|互联网</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='金融业') class="active" @endif>金融业</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='房地产|建筑业') class="active" @endif>房地产|建筑业</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='商业服务') class="active" @endif>商业服务</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='贸易|批发|零售|租赁业') class="active" @endif>贸易|批发|零售|租赁业</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='文体教育|工艺美术') class="active" @endif>文体教育|工艺美术</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='生产|加工|制造') class="active" @endif>生产|加工|制造</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='交通|运输|物流|仓储') class="active" @endif>交通|运输|物流|仓储</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='服务业') class="active" @endif>服务业</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='文化|传媒|娱乐|体育') class="active" @endif>文化|传媒|娱乐|体育</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='能源|矿产|环保') class="active" @endif>能源|矿产|环保</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='政府|非盈利机构') class="active" @endif>政府|非盈利机构</a>
                                <a href="javascript:;" @if(!empty($industry) && $industry=='农|林|牧|渔|其他') class="active" @endif>农|林|牧|渔|其他</a>
                            </div>

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
                    <!-- 筛选条件 end -->
                </div>
                <!-- 排序 start -->

               {{-- <div class="sort uct-sort">
                    <a href="javascript:;" class="list-time @if(!empty($ordertime)) active @endif">认证时间<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordertime) && $ordertime == 'asc') white-color @elseif(!empty($ordertime) && $ordertime == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordertime) && $ordertime == 'asc') blue-color  @elseif(!empty($ordertime) && $ordertime == 'desc') white-color  @endif"></i></span></a>
                    <a href="javascript:;" class="list-collect @if(!empty($ordercollect)) active @endif">收藏数<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordercollect) && $ordercollect == 'asc') white-color @elseif(!empty($ordercollect) && $ordercollect == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordercollect) && $ordercollect == 'asc') blue-color  @elseif(!empty($ordercollect) && $ordercollect == 'desc') white-color  @endif"></i></span></a>
                    <a href="javascript:;" class="list-reviews @if(!empty($ordermessage)) active @endif">留言数<span class="list-order-icon"><i class="iconfont icon-triangle-copy @if(!empty($ordermessage) && $ordermessage == 'asc') white-color @elseif(!empty($ordermessage) && $ordermessage == 'desc') blue-color  @endif"></i><i class="iconfont icon-sanjiaoxing @if(!empty($ordermessage) && $ordermessage == 'asc') blue-color  @elseif(!empty($ordermessage) && $ordermessage == 'desc') white-color  @endif"></i></span></a>
                </div>--}}
                <!-- 排序 end -->
                <div class="main-right uct-oh">
                    <ul class="supply-list clearfix">
                        @foreach($datas as $v)
                        <li class="col-md-6">
                            <a href="{{url('uct_entres/detail',$v->enterpriseid)}}" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="{{env('ImagePath').$v->showimage}}" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">{{$v->enterprisename}}</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>所在行业：<em>{{$v->industry}}</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>所在地区：<em> {{$v->address}} </em></span>
                                    </div>

                                </div>
                                <div class="exp-list-desc exps-enterprise">
                                    {{$v->brief}}
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="{{url('uct_entres/detail',$v->enterpriseid)}}#reply" class="review" title="留言"><i class="iconfont icon-pinglun1"></i> {{$v->messcount}}</a>
                                <a href="javascript:;" class="collect @if(in_array($v->enterpriseid,$collectids)) red @endif" index="{{$v->enterpriseid}}" title="@if(in_array($v->enterpriseid,$collectids))已收藏 @else 收藏@endif"><i class="iconfont icon-likeo"></i> <span>{{$v->collcount}}</span></a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="pages myinfo-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">{{$datas->lastpage()}}</strong>页</span>
                    </div>
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
        })
    </script>
    <script src="{{url('js/enterpriseres.js')}}" type="text/javascript"></script>
@endsection