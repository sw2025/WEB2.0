@extends("layouts.master")
@section("content")
    <script type="text/javascript" src="{{asset('js/project.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>

    <div class="sw-banner">
        <ul class="sw-banner-wrapper">
            <li class="img01">
                <div class="swcontainer">
                    <div class="sw-banner-content">
                        <span class="sw-banner-title">我是创业者</span>
                        <p class="sw-banner-para">
                            当我拿着BP海投无果时，<br>升维网为我精准匹配到合适的投资人<br>不到两个月，公司获得天使投资500万<br>效率决定项目生死，融资我选择升维网
                        </p>
                        <span class="sw-banner-tip">将创业项目提交至升维网，我们将对接投资机构对项目进行认真评估，<br>您将在系统中查看不同投资人对项目的评议、估值及宝贵建议！</span>
                        <div class="sw-banner-links">
                            <a href="{{url('submitIndex')}}" class="hover">直通路演(免费)</a> <a href="{{url('showIndex')}}" >VC直评</a><a href="{{url('meetIndex')}}">约见投资人</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="img02">
                <div class="swcontainer">
                    <div class="sw-banner-content">
                        <span class="sw-banner-title">我是企业家</span>
                        <p class="sw-banner-para">
                            以前企业遇到问题都自己扛
                            <br>升维网为我提供了丰富的外部资源
                            使我突破自身限制
                            <br>不定战略、找资金、拓市场不在话下
                            <br>我不是一个人在战斗
                        </p>
                        <span class="sw-banner-tip">约见升维网大V、召开线上私董会，给您对接资源上带来诸多遍历<br></span>
                        <div class="sw-banner-links">
                            <a href="{{url('daVIndex')}}" class="hover"> 约大V </a>
                            <a href="{{url('entmysector/supplysector')}}">召开私董会</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="img03">
                <div class="swcontainer">
                    <div class="sw-banner-content">
                        <span class="sw-banner-title">作为一个传统企业的老板</span>
                        <p class="sw-banner-para">
                            我深知企业转型升级的必要性
                            <br>往哪转？怎么转？
                            <br>升维网组织业界大咖给我出谋划策通过外部资源为我的企业赋能
                        </p>
                        <span class="sw-banner-tip">产品升级  效率提高<br>管理提升  业绩翻番</span>
                        <div class="sw-banner-links">
                            <a href="{{url('submitIndex')}}" class="hover">提交项目</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <ol>
            <li class="cur"></li>
            <li></li>
            <li></li>
        </ol>
    </div>
<div class="sw-preview">
    <div class="swcontainer clearfix">
        <div class="swcol-md-4 swcol-xs-12 sw-pre-item pre-item1">
            <img src="img/swicon1.png">
            <span class="pre-item-title">找投资</span>
            <p>找投资快人一步</p>
            <p class="pre-item-para">直接联系投资人得到评议<br>了解您的项目实际竞争力<br>掌握新技能，找到创业突破口</p>
        </div>
        <div class="swcol-md-4 swcol-xs-12 sw-pre-item pre-item2">
            <img src="img/swicon2.png">
            <span class="pre-item-title">企业加速</span>
            <p>开创市场销售新机会</p>
            <p class="pre-item-para">对接资本资源，加速融资<br>共享市场资源，实现协同销售<br>梳理战略部署，提升综合运营能力</p>
        </div>
        <div class="swcol-md-4 swcol-xs-12 sw-pre-item pre-item3">
            <img src="img/swicon3.png">
            <span class="pre-item-title">转型升级</span>
            <p>轻松突破发展瓶颈</p>
            <p class="pre-item-para">结合企业特点，把握转型方向<br>集中资源，实现项目优化<br>多种转型模式，加速企业发展</p>
        </div>
    </div>
</div>
<div class="sw-five clearfix">
    <div class="sw-five-item">
        <span class="five-item-title">20000+万天使投资</span>
        <p>升维网至今已为<br>创业项目募集资金达2亿元</p>
    </div>
    <div class="sw-five-item">
        <span class="five-item-title">1000+名顶尖专家</span>
        <p>共有千余名行业专家、<br>投资人、知名企业家入驻升维网</p>
    </div>
    <div class="sw-five-item">
        <span class="five-item-title">600+企业</span>
        <p>升维网已为600多家<br>企业精准对接需求</p>
    </div>
    <div class="sw-five-item">
        <span class="five-item-title">10+企业</span>
        <p>升维网已为10余家<br>大中型企业提供转型升级服务，<br>其中3家直接带来<br>年业绩增长近亿元。</p>
    </div>
    <div class="sw-five-item">
        <span class="five-item-title">10+ 双创营</span>
        <p>升维网已与多个地方高新区<br>建立合作关系，<br>共同建立双创营</p>
    </div>
</div>
<div class="swcontainer investor">
    <span class="investor-title">升维网大V</span>
    <div class="investor-wrapper">
    @foreach($datas as $v)
        <a href="{{url('/expert/detail',$v->expertid)}}" class="investor-img-wrapper">
            <img src="{{env('ImagePath').$v->showimage}}" style="width: 227px;height: 250px;" class="investor-ava">
            <div class="investor-intro">
                <span class="investor-name">{{$v->expertname}}</span>
                <span class="investor-job">职位：升维网签约大V</span>
                <span class="investor-field">投资领域：
                    @foreach(explode(',',$v->domain1) as $do2)
                        @if($do2 == '风险投资人')
                            {{$do2}}
                        @else
                           &nbsp;{{$do2}}
                        @endif

                    @endforeach</span>
               {{-- <span class="investor-project">已投资的项目20个</span>--}}
            </div>
        </a>
    @endforeach

    </div>
    <div class="investor-more"><a href="{{url('expert')}}" class="investor-more-link">更多大V>></a></div>
</div>
<div class="institution">
    <div class="swcontainer institution-wrapper">
        <span class="investor-title">投资机构</span>
        <div class="institution-brand">
            <span><img src="img/brand1.png"></span>
            <span><img src="img/brand2.png"></span>
            <span><img src="img/brand3.png"></span>
            <span><img src="img/brand4.png"></span>
            <span><img src="img/brand5.png"></span>
            <span><img src="img/brand6.png"></span>
            <span><img src="img/brand7.png"></span>
            <span><img src="img/brand8.jpg"></span>
        </div>
        <div class="investor-more"><a href="#" class="investor-more-link">更多投资机构>></a></div>
    </div>
</div>
<div class="sw-about">
    <span class="sw-about-tit">关于升维网</span>
    <p>我们为优秀商业项目提供资金、技术、对接融资机构等专业支持，<br>旨在助力优秀商业项目和企业的孵化与成长！</p>
</div>


@endsection