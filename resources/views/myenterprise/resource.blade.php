@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" type="text/css" href="css/list.css" />
    <script type="text/javascript" src="js/list.js"></script>
    <div class="main">
            <!-- 专家资源 / start -->
            <h3 class="main-top">专家资源</h3>
            <div class="ucenter-con">
                <div class="myrequire-bg">
                    <div class="three-icon resource-icon">
                        <a href="javascript:;" class="icon-row active resource-icon-row"><i class="iconfont icon-shoucang"></i><span>收藏</span><em>10</em></a>
                        <a href="javascript:;" class="icon-row"><i class="iconfont icon-liuyan1"></i><span>留言</span><em>20</em></a>
                    </div>
                    <div class="publish-intro resource-intro">
                        <span class="introduce-cap">专家资源库介绍</span>
                        <div class="introduce-con">关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报关于小李同志本次任务工作情况汇报</div>
                    </div>
                </div>
                <div class="uct-list-filter">
                    <div class="uct-search">
                        <div class="uct-list-search">
                            <input type="text" class="uct-list-search-inp placeholder" placeholder="请输入专家姓名／机构名称／企业家姓名">
                            <button type="button" class="uct-list-search-btn"><i class="iconfont icon-sousuo"></i></button>
                        </div>
                    </div>
                    <!-- 筛选条件 start -->
                    <div class="uct-search-result">
                        <div class="all-results filter-row clearfix"><span class="left-cap">全部结果：</span></div>
                        <div class="experts-classify filter-row clearfix">
                            <span class="left-cap">专家分类：</span>
                            <a href="javascript:;" class="active">全部</a>
                            <a href="javascript:;">知名专家</a>
                            <a href="javascript:;">知名机构</a>
                            <a href="javascript:;">知名企业家</a>
                        </div>
                        <div class="video-consult filter-row clearfix">
                            <span class="left-cap">视频咨询：</span>
                            <a href="javascript:;" class="active">全部</a>
                            <a href="javascript:;">收费</a>
                            <a href="javascript:;">免费</a>
                        </div>
                        <div class="serve-field filter-row clearfix">
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
                                <a href="javascript:;" class="active">全部</a>
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
                <!-- 排序 start -->
                <div class="sort uct-sort">
                    <a href="javascript:;" class="list-time active">认证时间<span class="list-order-icon"><i class="iconfont white-color icon-triangle-copy"></i><i class="iconfont blue-color icon-sanjiaoxing"></i></span></a>
                    <a href="javascript:;" class="list-collect">收藏数<span class="list-order-icon"><i class="iconfont icon-triangle-copy"></i><i class="iconfont icon-sanjiaoxing"></i></span></a>
                    <a href="javascript:;" class="list-reviews">留言数<span class="list-order-icon"><i class="iconfont icon-triangle-copy"></i><i class="iconfont icon-sanjiaoxing"></i></span></a>
                </div>
                <!-- 排序 end -->
                <div class="main-right uct-oh">
                    <ul class="supply-list clearfix">
                        <li class="col-md-6">
                            <a href="{{asset('uct_resource/resDetail')}}" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="{{asset('img/avatar1.jpg')}}" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">某专家</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>免费</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>销售</em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    1996年，科比被当时的夏洛特黄蜂以首轮第13顺位选中，随即他被交易到湖人。在漫长的职业生涯里，科比帮助比被当时的...
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <a href="uct_resdetail.html" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="img/avatar1.jpg" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">某专家</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>免费</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>销售</em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    1996年，科比被当时的夏洛特黄蜂以首轮第13顺位选中，随即他被交易到湖人。在漫长的职业生涯里，科比帮助比被当时的...
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <a href="uct_resdetail.html" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="img/avatar1.jpg" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">某专家</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>免费</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>销售</em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    1996年，科比被当时的夏洛特黄蜂以首轮第13顺位选中，随即他被交易到湖人。在漫长的职业生涯里，科比帮助比被当时的...
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <a href="uct_resdetail.html" class="expert-list-link">
                                <div class="exp-list-top">
                                    <span class="exp-list-img"><img src="img/avatar1.jpg" /></span>
                                    <div class="exp-list-brief">
                                        <span class="exp-list-name">某专家</span>
                                        <span class="exp-list-video"><i class="iconfont icon-shipin"></i>视频咨询：<em>免费</em></span>
                                        <span class="exp-list-best"><i class="iconfont icon-shanchang"></i>擅长领域：<em>销售</em></span>
                                    </div>
                                    <div class="exp-list-lab">
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                        <span class="exp-lab-a">不知道</span>
                                    </div>
                                </div>
                                <div class="exp-list-desc">
                                    1996年，科比被当时的夏洛特黄蜂以首轮第13顺位选中，随即他被交易到湖人。在漫长的职业生涯里，科比帮助比被当时的...
                                </div>
                            </a>
                            <div class="exp-list-icon">
                                <a href="javascript:;" class="review" title="留言"><i class="iconfont icon-pinglun1"></i></a>
                                <a href="javascript:;" class="collect" title="收藏"><i class="iconfont icon-likeo"></i></a>
                            </div>
                        </li>
                    </ul>
                    <div class="pages myinfo-page">
                        <div id="Pagination"></div><span class="page-sum">共<strong class="allPage">15</strong>页</span>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
    $(function(){
        $(function(){
            $("#Pagination").pagination("15");
        })
    })
</script>
@endsection