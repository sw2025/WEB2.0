<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>升维</title>
        <link rel="stylesheet" type="text/css" href="iconfont/iconfont.css" />
        <link rel="stylesheet" type="text/css" href="css/global.css" />
        <link rel="stylesheet" type="text/css" href="css/public.css" />
        <link rel="stylesheet" type="text/css" href="css/ucenter.css" />
        <!-- js / start -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/layer/layer.js"></script>
        <script type="text/javascript" src="js/public.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/utils/html5shiv.js?1401441990"></script>
        <script type="text/javascript" src="js/utils/respond.min.js?1401441990"></script>
        <![endif]-->
    </head>
    <body>
    <!-- 公共header / start -->
    <div class="header">
        <div class="container clearfix">
            <div class="navbar-header clearfix">
                <a href="index.html" class="navbar-brand navbar-link">
                    <img src="img/logo.png" alt="首页">
                </a>
                <button class="navbar-toggle"><i class="iconfont icon-daohang"></i></button>
            </div>
            <div class="bars">
                <!-- 未登录 -->
                <span class="before-login" style="display:none;">
                    <a href="javascript:;" class="register header-link"><i class="iconfont icon-bianji"></i>注册</a>
                    <a href="javascript:;" class="login header-link"><i class="iconfont icon-suo"></i>登录</a>
                </span>
                <!-- 登录后 -->
                <span class="after-login" style="display:block;">
                    <a href="javascript:;" class="quit header-link">退出</a>
                    <a href="javascript:;" class="log-username header-link"><i class="iconfont icon-touxiang"></i>路漫漫其修远兮</a>
                </span>
                <div class="searchbar">
                    <a href="javascript:;" class="search-cli"><i class="iconfont icon-sousuo"></i></a>
                    <div class="search-sear">
                        <form name="">
                            <div class="select-box">
                                <div class="select-showbox"><span></span><i class="iconfont icon-xiangxiajiantou"></i></div>
                                <ul class="select-option">
                                    <li>搜专家</li>
                                    <li>搜供求</li>
                                </ul>
                            </div> 
                            <input class="search-text" name="keyboard" placeholder="请输入关键字">
                            <span class="search-bar"><button type="button" class="search-btn"><i class="iconfont icon-sousuo"></i></button></span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="navbar-nav clearfix">
                <ul class="nav">
                    <li class="active"><a href="javascript:;">首页</a></li>
                    <li><a href="javascript:;">服务介绍</a></li>
                    <li><a href="javascript:;">专家资源</a></li>
                    <li><a href="javascript:;">供求信息</a></li>
                    <li><a href="javascript:;">关于我们</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 公共header / end -->
    <div class="ucenter">
        <div class="wrap clearfix">
            <!-- 侧边栏公共部分/start -->
            <div class="aside">
                <h2 class="aside-tit"><i class="iconfont icon-tongyong"></i>通用信息</h2>
                <ul class="common-info">
                    <li><a href="uct_basic.html"><i class="iconfont icon-3jibenziliao"></i>基本资料</a></li>
                    <li><a href="uct_recharge.html"><i class="iconfont icon-chongzhi"></i>充值提现</a></li>
                    <li><a href="uct_myinfo.html"><i class="iconfont icon-wodexinxi"></i>我的信息</a></li>
                    <li><a href="uct_myneed.html"><i class="iconfont icon-xuqiu"></i>我的需求</a></li>
                </ul>
                <h2 class="aside-tit"><i class="iconfont icon-gongsi"></i>我是企业</h2>
                <ul class="common-info">
                    <li><a href="uct_member.html"><i class="iconfont icon-renzheng2"></i>会员认证</a></li>
                    <li><a href="uct_works.html"><i class="iconfont icon-banshizhinan"></i>办事服务</a></li>
                    <li><a href="uct_video.html"><i class="iconfont icon-shipin"></i>视频咨询</a></li>
                    <li><a href="uct_resource.html"><i class="iconfont icon-ziyuanku2"></i>专家资源</a></li>
                </ul>
                <h2 class="aside-tit"><i class="iconfont icon-iconfonticon"></i>我是专家</h2>
                <ul class="common-info">
                    <li class="current"><a href="uct_expcert.html"><i class="iconfont icon-renzheng1"></i>专家认证</a></li>
                    <li><a href="uct_standard.html"><i class="iconfont icon-shoufeixitong"></i>收费标准</a></li>
                    <li><a href="uct_mywork.html"><i class="iconfont icon-banjieshijian"></i>我的办事</a></li>
                    <li><a href="uct_myask.html"><i class="iconfont icon-zixun"></i>我的咨询</a></li>
                </ul>
            </div>
            <!-- 侧边栏公共部分/end -->
            <div class="main">
                <!-- 专家认证3 / start -->
                <h3 class="main-top">专家认证</h3>
                <div class="ucenter-con">
                    <div class="main-right">
                        <div class="card-step">
                            <span class="gray-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                            <span class="gray-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">3</span>认证成功
                        </div>
                        <div class="expert-certy">
                            <div class="expert-certy-state success-state">
                                <i class="iconfont icon-chenggong"></i>
                                <span class="publish-need-blue">
                                    <em>认证成功</em>AUTHENTICATION SUCCESS
                                </span>
                            </div>
                            <div class="datas datas-audit">
                                <div class="datas-lt">
                                    <div class="datas-lt-enter">
                                        <div class="datas-sel zindex1">
                                            <span class="datas-sel-cap">专家分类</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->category}}</a>

                                        </div>
                                        <div class="datas-sel">
                                            <span class="datas-sel-cap">姓名</span>
                                            <input class="datas-sel-name" readonly="readonly" type="text" value="{{$data->expertname}}" />
                                        </div>
                                        <div class="datas-sel zindex2">
                                            <span class="datas-sel-cap">所在行业</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->domain1.'/'.$data->domain2}}</a>

                                        </div>
                                        <div class="datas-sel zindex3">
                                            <span class="datas-sel-cap">地区</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->address}}</a>

                                        </div>
                                    </div>
                                    <div class="datas-upload-box clearfix">
                                        <div class="datas-upload-lt">
                                            <img src="img/photo1.jpg" class="photo1" />
                                            
                                        </div>
                                        <div class="datas-upload-rt">
                                            <img src="img/photo2.jpg" class="photo1" />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="datas-rt">
                                    <textarea placeholder="请输入专家描述" readonly="readonly" cols="30" rows="10">{{$data->brief}}</textarea>
                                </div>
                            </div>
                            <div class="bottom-btn"><button class="test-btn " type="button">重新认证</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 专家认证3 / end -->
    <!-- 公共footer / end -->
    <div class="footer">
        <div class="container clearfix">
            <!-- <div class="row"> -->
                <div class="col-md-6 two-pic">
                    <!-- <div class="container-fluid"> -->
                        <div class="weixin"><span class="two-code"><img src="img/weixin.jpg" /></span>关注升维公众号</div>
                        <div class="app"><span class="two-code"><img src="img/app.jpg"  /></span>下载升维APP</div>
                    <!-- </div> -->
                </div>
                <div class="col-md-6 contacts">
                    <p class="footer-title">联系升维</p>
                    <p class="contact-pub contact-telephone"><i class="iconfont icon-dianhua"></i>Tel：400-898-8557</p>
                    <p class="contact-pub contact-email"><i class="iconfont icon-youxiang"></i>Mail：北京市海淀区中关村大街</p>
                    <p class="contact-pub contact-addr"><i class="iconfont icon-dizhi"></i>Add：北京市海淀区中关村大街15-15号创业公社 · 中关村</p>
                    <p class="copyright">京ICP备 XXXXXXXXX<span></span>copyright &copy; XXXX 2017</p>
                </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- 公共footer / end -->
    <script type="text/javascript">
        $(function(){  
            
        })  
    </script>
    </body>
</html>