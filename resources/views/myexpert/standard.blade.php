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
                    <li><a href="uct_expcert.html"><i class="iconfont icon-renzheng1"></i>专家认证</a></li>
                    <li class="current"><a href="uct_standard.html"><i class="iconfont icon-shoufeixitong"></i>收费标准</a></li>
                    <li><a href="uct_mywork.html"><i class="iconfont icon-banjieshijian"></i>我的办事</a></li>
                    <li><a href="uct_myask.html"><i class="iconfont icon-zixun"></i>我的咨询</a></li>
                </ul>
            </div>
            <!-- 侧边栏公共部分/end -->
            <div class="main">
                <h3 class="main-top">收费标准</h3>
                <!-- 收费标准 / start -->
                <div class="ucenter-con">
                    <div class="main-right">
                        <div class="recharge-sum standards">
                            <span class="recharge-opt focus others">
                                <input class="rad-inp" checked="true" type="radio" id="rad4" name="money">
                                <label for="rad4" class="recharge-radio"><span></span>收费</label><input type="text" placeholder="请输入金额" readonly="" class="recharge-inp-sum">&nbsp;&nbsp;元/次
                            </span>
                            <span class="recharge-opt">
                                <input class="rad-inp" type="radio" id="rad1" name="money">
                                <label for="rad1" class="recharge-radio"><span></span>免费</label>
                            </span>
                        </div>
                        <div class="uct-works-tips standard-intro">
                            说明：共享单车新规发布：禁止向未满12岁儿童提供
                        </div>
                        <div class="recharge-btn-box">
                            <button class="test-btn recharge-submit" type="button">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 收费标准 / end -->
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
        
    </script>
    </body>
</html>