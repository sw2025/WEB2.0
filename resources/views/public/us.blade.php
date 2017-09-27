@extends("layouts.master")
@section("content")
    <link rel="stylesheet" type="text/css" href="css/about.css" />
    <!-- banner / start -->
    <div class="serve-banner banner-us"></div>
    <!-- banner / end -->
    <!-- 主体 / start -->
    <div class="serve-stage stage-us container">
        <div class="serve-supply-top">
            <div class="serve-supply-tit">
                <h2 class="serve-tit">
                    关于我们
                    <span class="serve-line line2"></span>
                </h2>
            </div>
            <div class="serve-tit-eng">ABOUT US</div>
            <span class="bg-line"></span>
        </div>
        <div class="who">
            <span class="us-cap">我们是谁</span>
            <div class="about-desc">
                升维网（www.sw2025.com）技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；是为广大中小企业提供资源精准对接，以解决实际问题为导向，为广大中小型企业的转型升级提供一站式服务的大型平台。我们以帮助企业精准对接资源为目标，以为企业办实事、解难题为导向，通过升维网平台的运作，帮助广大企业有组织、系统、高效地利用外部资源，并将这些资源转化成企业的核心竞争力。
            </div>
        </div>
    </div>
    <!-- 核心成员介绍/start -->
    <div class="white-bg">
        <div class="container core core2">
            <span class="us-cap">团队核心成员介绍</span>
            <div class="core-con core-con2">
                <ul class="core-list2">
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/wushaozhong.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>吴少中</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/wushaozhong.jpg" class="core-img2" />
                            <p class="core-desc" style='height: 130px;'>经济学博士，资深金融投资专家，长期从事金融投资管理工作。认为企业转型升级的关键，在于如何高效率使用外部资源。企业使用外部资源的核心又在于如何消除隐藏信息不对称之下的知识不对称和组织不对称。而这正是升维网的价值所在。</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>王亮</strong>
                                <span class="job2">市场总监</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/huangyangyang.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>黄洋洋</strong>
                                <span class="job2">行政总监</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/huangyangyang.jpg" class="core-img2" />
                            <p class="core-desc">知名高校行政管理专业硕士。曾在多家大型上市公司担任行政管理职位，具有丰富的行政管理经验及较强的综合协调能力。精通韩语 英语 等多门外语</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>骆朋飞</strong>
                                <span class="job2">高级经理</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc" style="height:130px;">曾在多家大型上市公司担任商务管理职位，具有证券公司、公募基金、私募基金、资产管理机构等核心人脉资源，精通各种面向企业用户的产品拓展方式，市场拓展能力等。基于企业服务发展整体战略， 结合公司目前发展战略，探索，挖掘可持续发展的新机会。</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/jiangzhengyi.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>蒋政义</strong>
                                <span class="job2">运营经理</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/jiangzhengyi.jpg" class="core-img2" />
                            <p class="core-desc" style='height: 130px;'>负责升维网运维微信广告、百度推广等平台，策划、执行广告方案；负责百度搜索引擎的竞价工作，搜索关键词的优化调整；负责公司网站的SEO优化工作，提高公司网站在百度的自然搜索排名；定期撰写公司网络营销的数据分析，推广效果分析。</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/wangning.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>王宁</strong>
                                <span class="job2">技术经理</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/wangning.jpg" class="core-img2" />
                            <p class="core-desc" style="height: 130px;">曾负责多家公司网站及网站后台管理系统搭建,调研相关平台架构设计和研发;负责系统的高可用，完成重要业务模块及核心代码实现;高性能Web应用架构设计和优化;主导开发小组成员的Code Review工作，并能提供性能优化、安全性建议</p>
                        </div>
                    </li>

                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                    <li class="core-item">
                        <img src="{{env('ImagePath')}}/images/luopengfei2.jpg" class="core-pic" title="" />
                        <div class="core-hover">
                            <div class="core-top">
                                <strong>胖大海</strong>
                                <span class="job2">CEO</span>
                            </div>
                            <img src="{{env('ImagePath')}}/images/luopengfei3.jpg" class="core-img2" />
                            <p class="core-desc">技术推广、技术转让、技术咨询；基础软件服务；应用软件服务；企业策划、设计；市场调查；企业管理咨询。（企业依法自主选择经营项目，开展经营活动；</p>
                        </div>
                    </li>
                </ul>
                <span class="arrow-line"></span>
                <div class="core-arrow">
                    <a href="javascript:;" class="core-left core-icon"><i class="iconfont icon-arrow-circle-o-left"></i></a>
                    <a href="javascript:;" class="core-right core-icon"><i class="iconfont icon-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- 核心成员介绍/end -->
    <!-- 企业背景/start -->
    <div class="enterpsbg">
        <div class="container">
            <span class="enbg-tit">企业背景</span>
            <p class="enbg-jun-tit">升维网</p>
            <div class="enbg-con">升维网由中通财富投资发起，联合中企港资本集团、北大孵化器、清华科技园、鼎晖投资、信达资产、华融资产、长江证券、中投证券、平安银行、华夏银行等金融投资机构以及联合中科院、清华大学、北京大学等著名机构所属研究所，室等科研机构，为企业转型打造强大的资源支撑平台。</div>
            <p class="enbg-jun-tit"></p>
            <div class="enbg-con">为了增强对企业的个性化和深度服务，升维网还集合一大批资深专家打造了“企业战略与科技高端智库”和“企业投融资智库”，以提哦噶升维网平台的价值</div>
        </div>
    </div>
    <!-- 企业背景/end -->
    <!-- 平台合作机构/start -->
    <div class="white-bg">
        <div class="container institution">
            <span class="us-cap">平台合作机构</span>
            <div class="brands">
                <img src="{{env('ImagePath')}}/images/partner08.png" style="height:82px; width:214px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner01.png" style="height:82px; width:157px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner02.png" style="height:82px; width:161px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner10.png" style="height:82px; width:160px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner09.png" style="height:82px; width:229px;float: left;margin:2px 3px;" alt="" />

                <img src="{{env('ImagePath')}}/images/partner03.png" style="height:82px; width:495px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner05.png" style="height:82px; width:404px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner04.png" style="height:82px; width:195px;float: left;margin:2px 3px;" alt="" />

                <img src="{{env('ImagePath')}}/images/partner06.gif" style="height:82px; width:381px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner11.png" style="height:82px; width:359px;float: left;margin:2px 3px;" alt="" />
                <img src="{{env('ImagePath')}}/images/partner07.png" style="height:82px; width:257;float: left;margin:2px 3px;" alt="" />

            </div>
        </div>
    </div>
    <!-- 平台合作机构/  end -->
    <script type="text/javascript">
        $(function(){
            var len = $('.core-list2 li').length;
            var wid1 = $('.core-item').width();
            var wid = $('.core-item').width() * len;
            $('.core-list2').width(wid);
            if($(window).width() < 1200){
                $('.core-list2 li').hover(function() {
                    var $this = $(this);
                    $this.stop().animate({'width': '250px'}, 800);
                    $this.siblings().stop().animate({'width': '120px'}, 800);
                    $this.children('.core-hover').stop().animate({'top': 0}, 800);
                    $this.siblings().children('.core-hover').stop().animate({'top': '-100%'}, 800);
                }, function() {
                    var $this = $(this);
                    $this.children('.core-hover').stop().animate({'top': '-100%'}, 800);
                    $this.siblings().stop().animate({'width': wid1+'px'}, 800);
                    $this.stop().animate({'width': wid1+'px'}, 800);
                });
            }else{
                $('.core-list2 li').hover(function() {
                    var $this = $(this);
                    $this.stop().animate({'width': '270px'}, 800);
                    $this.siblings().stop().animate({'width': '150px'}, 800);
                    $this.children('.core-hover').stop().animate({'top': 0}, 800);
                    $this.siblings().children('.core-hover').stop().animate({'top': '-100%'}, 800);
                }, function() {
                    var $this = $(this);
                    $this.children('.core-hover').stop().animate({'top': '-100%'}, 800);
                    $this.siblings().stop().animate({'width': wid1+'px'}, 800);
                    $this.stop().animate({'width': wid1+'px'}, 800);
                });
            }

            var num = 0;
            $('.core-right').click(function(e) {
                num++;
                if(num > len-7){
                    num = len-7;
                }
                console.log(num)
                var move = num * -wid1;
                $('.core-list2').stop().animate({'left':move + 'px'},500)
            });
            $('.core-left').click(function(e) {
                num--;
                if(num <= 0){
                    num = 0;
                }
                console.log(num)
                var move = num * -wid1;
                $('.core-list2').stop().animate({'left': move + 'px'},500);
            });
        })
    </script>
@endsection