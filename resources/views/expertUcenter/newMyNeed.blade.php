@extends('layouts.ucenter4')
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/experts.css')}}" />
    <script type="text/javascript" src="{{asset('js/list.js')}}"></script>
    <script type="text/javascript" src="{{asset('iconfont/iconfont.js')}}"></script>
    <div class="ucenter-con">
                <!-- 选择start -->
                <div class="v-myneed-top">
                    <a href="{{asset('myneed/supplyNeed')}}" class="v-release-btn">发布需求</a>
                    <div class="v-condition">
                        <a href="javascript:;" class="v-condition-link active">已发布<span class="v-count">100</span></a>
                        <a href="javascript:;" class="v-condition-link v-c-link1">待审核<span class="v-count">100</span></a>
                        <a href="javascript:;" class="v-condition-link v-c-link2">审核失败<span class="v-count">100</span></a>
                    </div>
                </div>
                <!-- 选择  end -->
                <div class="uct-list-filter">
                    <div class="uct-search">
                        <div class="uct-list-search">
                            <input type="text" class="uct-list-search-inp placeholder" placeholder="请输入要搜索的供求信息关键字">
                            <button type="button" class="uct-list-search-btn"><i class="iconfont icon-sousuo"></i></button>
                        </div>
                    </div>
                    <!-- 筛选条件 start -->
                    <div class="uct-search-result">
                        <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span></div>
                        <div class="my-trace filter-row clearfix">
                            <span class="left-cap">我的足迹：</span>
                            <a href="javascript:;" class="active">不限</a>
                            <a href="javascript:;">已收藏</a>
                            <a href="javascript:;">已留言</a>
                        </div>
                        <div class="experts-classify filter-row clearfix">
                            <span class="left-cap">发布类别：</span>
                            <a href="javascript:;" class="active">不限</a>
                            <a href="javascript:;">专家</a>
                            <a href="javascript:;">企业</a>
                        </div>
                        <div class="serve-field filter-row clearfix">
                            <span class="left-cap">需求领域：</span>
                            <a href="javascript:;" class="serve-all active">不限</a>
                            <div class="serve-field-list">
                                <a href="javascript:;" class="serve-field-list-deft">销售类</a>
                                <ul class="serve-field-list-show">
                                    <li>销售1</li>
                                    <li>销售2</li>
                                </ul>
                            </div>
                            <div class="serve-field-list">
                                <a href="javascript:;" class="serve-field-list-deft">销售类</a>
                                <ul class="serve-field-list-show">
                                    <li>销售1</li>
                                    <li>销售2</li>
                                </ul>
                            </div>
                            <div class="serve-field-list">
                                <a href="javascript:;" class="serve-field-list-deft">销售类</a>
                                <ul class="serve-field-list-show">
                                    <li>销售1</li>
                                    <li>销售2</li>
                                </ul>
                            </div>
                            <div class="serve-field-list">
                                <a href="javascript:;" class="serve-field-list-deft">销售类</a>
                                <ul class="serve-field-list-show">
                                    <li>销售1</li>
                                    <li>销售2</li>
                                </ul>
                            </div>
                        </div>
                        <div class="location filter-row clearfix">
                            <span class="left-cap">所在地区：</span>
                            <div class="location-province">
                                <a href="javascript:;" class="active">不限</a>
                                <a href="javascript:;">北京</a>
                                <a href="javascript:;">上海</a>
                                <a href="javascript:;">天津</a>
                                <a href="javascript:;">重庆</a>
                                <a href="javascript:;">河北</a>
                                <a href="javascript:;">山西</a>
                                <a href="javascript:;">内蒙</a>
                                <a href="javascript:;">辽宁</a>
                                <a href="javascript:;">吉林</a>
                                <a href="javascript:;">黑龙江</a>
                                <a href="javascript:;">江苏</a>
                                <a href="javascript:;">浙江</a>
                                <a href="javascript:;">安徽</a>
                                <a href="javascript:;">福建</a>
                                <a href="javascript:;">江西</a>
                                <a href="javascript:;">山东</a>
                                <a href="javascript:;">河南</a>
                                <a href="javascript:;">湖北</a>
                                <a href="javascript:;">湖南</a>
                                <a href="javascript:;">广东</a>
                                <a href="javascript:;">广西</a>
                                <a href="javascript:;">海南</a>
                                <a href="javascript:;">四川</a>
                                <a href="javascript:;">贵州</a>
                                <a href="javascript:;">云南</a>
                                <a href="javascript:;">西藏</a>
                                <a href="javascript:;">陕西</a>
                                <a href="javascript:;">甘肃</a>
                                <a href="javascript:;">青海</a>
                                <a href="javascript:;">宁夏</a>
                                <a href="javascript:;">新疆</a>
                                <a href="javascript:;">台湾</a>
                                <a href="javascript:;">香港</a>
                                <a href="javascript:;">澳门</a>
                            </div>
                        </div>
                    </div>
                    <!-- 筛选条件 end -->
                </div>
                <div class="main-right uct-oh">
                    <div class="myask-tab-box">
                        <ul class="supply-list clearfix">
                            <li class="col-md-6">
                                <a href="uct_myneedetail.html" class="supply-list-link">
                                    <img src="img/avatar1.jpg" class="supp-list-img" />
                                    <span class="supp-list-time">2017-08-04</span>
                                    <div class="supp-list-brief">
                                        <span class="supp-list-name">供求信息</span>
                                        <span class="supp-list-category">需求分类：<em>销售类</em></span>
                                        <div class="supp-list-desc">
                                            7月8日消息 一直有消息称魅族将首发Helio X30，现在这则消息得到联发科官方的确认。
                                            联发科昨天公布了6月份的营收数据，联发科营收为新台币218.94亿元（约合人民币48.8亿元），相较五月份增长18.75%，较2016年同期降低11.79%，但这是2017年以来联发科的最高数据。
                                        </div>
                                    </div>
                                </a>
                                <div class="supp-list-icon">
                                    <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                    <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <a href="uct_myneedetail.html" class="supply-list-link">
                                    <img src="img/avatar1.jpg" class="supp-list-img" />
                                    <span class="supp-list-time">2017-08-04</span>
                                    <div class="supp-list-brief">
                                        <span class="supp-list-name">供求信息</span>
                                        <span class="supp-list-category">需求分类：<em>销售类</em></span>
                                        <div class="supp-list-desc">
                                            7月8日消息 一直有消息称魅族将首发Helio X30，现在这则消息得到联发科官方的确认。
                                            联发科昨天公布了6月份的营收数据，联发科营收为新台币218.94亿元（约合人民币48.8亿元），相较五月份增长18.75%，较2016年同期降低11.79%，但这是2017年以来联发科的最高数据。
                                        </div>
                                    </div>
                                </a>
                                <div class="supp-list-icon">
                                    <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                    <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <a href="uct_myneedetail.html" class="supply-list-link">
                                    <img src="img/avatar1.jpg" class="supp-list-img" />
                                    <span class="supp-list-time">2017-08-04</span>
                                    <div class="supp-list-brief">
                                        <span class="supp-list-name">供求信息</span>
                                        <span class="supp-list-category">需求分类：<em>销售类</em></span>
                                        <div class="supp-list-desc">
                                            7月8日消息 一直有消息称魅族将首发Helio X30，现在这则消息得到联发科官方的确认。
                                            联发科昨天公布了6月份的营收数据，联发科营收为新台币218.94亿元（约合人民币48.8亿元），相较五月份增长18.75%，较2016年同期降低11.79%，但这是2017年以来联发科的最高数据。
                                        </div>
                                    </div>
                                </a>
                                <div class="supp-list-icon">
                                    <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                    <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <a href="uct_myneedetail.html" class="supply-list-link">
                                    <img src="img/avatar1.jpg" class="supp-list-img" />
                                    <span class="supp-list-time">2017-08-04</span>
                                    <div class="supp-list-brief">
                                        <span class="supp-list-name">供求信息</span>
                                        <span class="supp-list-category">需求分类：<em>销售类</em></span>
                                        <div class="supp-list-desc">
                                            7月8日消息 一直有消息称魅族将首发Helio X30，现在这则消息得到联发科官方的确认。
                                            联发科昨天公布了6月份的营收数据，联发科营收为新台币218.94亿元（约合人民币48.8亿元），相较五月份增长18.75%，较2016年同期降低11.79%，但这是2017年以来联发科的最高数据。
                                        </div>
                                    </div>
                                </a>
                                <div class="supp-list-icon">
                                    <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                    <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="pages myinfo-page">
                            <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                        </div>
                    </div>
                    <div class="myask-tab-box"></div>
                    <div class="myask-tab-box"></div>
                </div>
            </div>

<script type="text/javascript">
    $(function(){
        $("#Pagination").pagination("15");
        $('.v-condition-link').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    })
</script>
@endsection