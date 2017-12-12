@extends("layouts.master")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/help.css')}}" />
    <div class="help-page">
        <div class="head-level" style="margin-top:20px">
            <ul class="menu-list-level" style="margin-top: 22px">
                <li class="menu-item-level"><a class="item-link active" id="help_user">用户使用帮助</a></li>
                <li class="menu-item-level"><a class="item-link" id="help_expert">专家使用帮助</a></li>
            </ul>
        </div>
        <div id="main_content" class="panel-body">
            <div class="spec-accordion help-user ui-accordion ui-widget ui-helper-reset" role="tablist">
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-1" aria-controls="ui-id-2" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>大牛家是什么？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>大牛家是一个为企业对接行业专家的服务平台。</li>
                        <li>大牛家致力于解决两个重要问题：
                            <span>让企业决策者便捷的获取资深专家的专业意见</span>
                            <span>为企业具体事务匹配上合适的顾问人员，来指导改善工作或提供咨询服务</span>
                        </li>
                        <li>为了达成我们的目标，大牛家需要完善的工作：
                            <span>持续寻找在各行业各领域实战经验丰富的专业人员加入大牛家</span>
                            <span>为认证专家提供尽可能丰富的信息展示空间</span>
                            <span>提供需求方与认证专家之间付费沟通的能力</span>
                            <span>提供寻找顾问需求发布的空间和相互对接的能力</span>
                        </li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>专家个人主页上的约谈怎样使用，能解决什么问题？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>大牛家上的约谈服务是大牛家上的专家为用户提供的有偿咨询服务。</li>
                        <li>
                            您通过大牛家产品的搜索功能，找到相关的专家，查看他们的资料并进行对比后，选择认为比较匹配的专家，在此专家的个人主页，直接选择他的约谈服务（图文约谈、电话约谈、线下约谈），确定要约谈的时间和费用，详细填写需要咨询的问题，自己的个人简介，提交此约谈请求给到专家，专家确认需求后，您再支付约谈费用，支付成功后，既可以与专家进行沟通交流！
                        </li>
                        <li>大牛家上的约谈让您带着明确的问题直接向专家提问和沟通，它可以让你以最高效的方式获取到相关行业专家的独到见解和意见，避免决策过程中的一些盲点，少走弯路！</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-5" aria-controls="ui-id-6" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>大牛家上的顾问需求发布怎样使用，能解决什么问题？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-6" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>
                            首先用户填写需要寻找的顾问要求，提交给大牛家，大牛家的工作人员将对信息进行严格审核并与发布人进行确认，审核通过后，会将需求信息推荐给匹配度较高的专家，收到通知的专家可以选择报名，同时需求信息将正式发布到需求广场，有兴趣的专家可以主动报名。专家报名后，发布方即可直接与专家进行线上或线下沟通，最终确定合作专家并与之签订合作协议。
                        </li>
                        <li>
                            企业在经营发展过程中，如果总能找到非常合适的专业顾问进行指导，能少走弯路，提高效率。大牛家的需求发布，首先可以扩大顾问选择面，其次借助大牛家的沟通功能以及其他用户的评价能够更深入的了解专家的实际能力状况，从而最终选择到相对更匹配的专业顾问！
                        </li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-7" aria-controls="ui-id-8" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>大牛家如何保障专家的专业性？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-8" aria-labelledby="ui-id-7" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>目前大牛家上的认证专家都需要有十年以上工作经验，对自己的专业领域有深入的理解和经验积累！他们都有在企业长期指导工作的经验，并取得了较为出色的成绩。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-9" aria-controls="ui-id-10" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>大牛家如何保障平台上服务质量？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-10" aria-labelledby="ui-id-9" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>首先大牛家要求平台上的认证专家有良好的服务意识，对于不能认真对待用户需求的专家，我们工作人员在确认实际情况后会及时下架。</li>
                        <li>其次，对于持续为用户提供满意服务的专家，大牛家将依据用户的综合评价给予优先推荐。</li>
                        <li>对于未能获得满意服务的用户，大牛家将及时跟进，了解问题的原因，为用户选择改善方案，对于确由大牛家平台不完善造成的不满，大牛家将予以退款。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-11" aria-controls="ui-id-12" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>在大牛家找专家约谈要收费吗？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-12" aria-labelledby="ui-id-11" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>需要收费。</li>
                        <li>大牛家推荐所有认证专家初始约谈价格为：图文约谈100元/次，电话约谈10元/分钟，线下约谈1000元/小时，当专家提供一次满意约谈后，可自行调整约谈服务价格。</li>
                        <li>相比向传统咨询公司咨询问题，在大牛家找专家约谈费用非常低，然而由于专家质量有保障，服务效果直接关系到个人品牌，真实效果反而更好！</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-13" aria-controls="ui-id-14" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>在大牛家找专家付费约谈，可以开具发票吗？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-14" aria-labelledby="ui-id-13" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>可以，大牛家可以为用户提供咨询服务费发票。</li>
                    </ul>
                </div>
            </div>
            <div class="spec-accordion help-expert ui-accordion ui-widget ui-helper-reset" style="display: none;padding-bottom:150px" role="tablist">
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-25" aria-controls="ui-id-26" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>大牛家的专家认证标准是什么？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-26" aria-labelledby="ui-id-25" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>需要有十年以上工作经验，对自己的专业领域有深入的理解和经验积累！</li>
                        <li>有在企业长期指导工作的经验，并取得了较为出色的成绩。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-27" aria-controls="ui-id-28" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>一般专家资料审核需要多长时间？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-28" aria-labelledby="ui-id-27" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>用户通过大牛家网站、微信端或客户端提交申请专家资料后，我们将在1-2个工作日内审核完毕并告知审核结果。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-29" aria-controls="ui-id-30" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>成为大牛家的认证专家要收费吗？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-30" aria-labelledby="ui-id-29" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>成为大牛家的认证专家是免费的。</li>
                        <li>认证专家通过大牛家平台为用户提供约谈服务获取的约谈费用，大牛家将收取15%的手续费，用于平台开发与完善。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-31" aria-controls="ui-id-32" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>成为大牛家的认证专家之后能做什么？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-32" aria-labelledby="ui-id-31" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>可以在自己的专长领域为用户提供有偿约谈服务。</li>
                        <li>用户发布的寻找顾问需求，认证专家可以报名并争取合作。</li>
                        <li>可以被大牛家推荐给需要顾问的企业。</li>
                    </ul>
                </div>
                <h3 class="ui-accordion-header ui-state-default ui-corner-all ui-accordion-icons" role="tab" id="ui-id-33" aria-controls="ui-id-34" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>作为大牛家的认证专家，会不会被一些无用的信息打扰？<i class="sp-icon sp-help-add ns-v2 fr icon-add">+</i></h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-34" aria-labelledby="ui-id-33" role="tabpanel" aria-hidden="true" style="display: none;">
                    <div class="line"></div>
                    <ul>
                        <li>不会，大牛家为此做了严格的保护措施。</li>
                        <li>用户购买专家的约谈需要经过专家确认同意之后才可进行。</li>
                        <li>针对电话约谈，专家将通过大牛家的回拨电话与用户进行联系，用户无法知道专家的手机号，不能拨打专家的电话。</li>
                        <li>大牛家系统将过滤无意义的约谈需求，尽可能少的打扰到专家。</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- 平台合作机构/  end -->
    <script type="text/javascript">
        $(function () {
            $('.menu-item-level').click(function () {
                var num = $(this).index();
                $(this).children().addClass('active');
                $(this).siblings().children().removeClass('active');
                $('.spec-accordion').eq(num).show();
                $('.spec-accordion').eq(num).siblings().hide();
            })
            $('.ui-accordion-header').click(function () {
                $(this).siblings('.ui-accordion-content').slideUp(300);
                $(this).siblings('.ui-accordion-header').children('.icon-add').html('+');
                if($(this).children('.icon-add').html() == '+'){
                    $(this).children('.icon-add').html('-') ;
                    $(this).next('.ui-accordion-content').stop().slideDown(300);
                }else if($(this).children('.icon-add').html() == '-'){
                    $(this).children('.icon-add').html('+');
                    $(this).next('.ui-accordion-content').stop().slideUp(300);
                }
            })
        })
    </script>
@endsection