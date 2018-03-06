@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/project.css')}}">
    <script type="text/javascript" src="{{asset('js/project.js')}}"></script>


    <!-- banner -->
<div class="junior-banner">
    <div class="swcontainer">
        <div class="jun-banner-cap">
            <a href="#" class="jun-banner-btn">创业孵化</a>
            <span class="jun-banner-intro">在线提交创业项目</span>
            <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
        </div>
    </div>
</div>
<!-- 主体 -->
<div class="sw-project swcontainer">
    <div class="sw-pro-tab clearfix">
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">项目评议</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">约见投资人</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">创业加速包</a>
    </div>
    <div class="sw-pro-content">
        <div class="sw-pro-tabcon show">
            <div class="sw-pro-para">
                的手机号飞机撒都会觉得双方就开始的撒垃圾罚款第三方的手机号飞机撒都会觉得双方就开始的撒垃圾罚款第三方的手机号飞机撒都会觉得双方就开始的撒垃圾罚款第三方的手机号飞机撒都会觉得双方就开始的撒垃圾罚款第三方的手机号飞机撒都会觉得双
            </div>
            <div class="sw-pro-form">
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目名称</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" value="{{$showinfo->title}}" disabled class="project-name">
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled value="公司全名"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>一句话简介</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" value="概括产品与服务" disabled class="sw-one-word">
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>所属领域</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-field">领域1</a>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>{{$showinfo->domain1 or '所属领域'}}</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-domain">选择领域</a>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目类型</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-type">类型1</a>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">项目概述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea maxlength="1000" class="sw-project-txt" disabled>产品描述、用户群体、项目愿景、竞争对手等方面详细描述</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>你的角色</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-role">企业</a>
                    </div>
                </div>
                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">商业计划书</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <div class="sw-upload-wrapper">
                            <span class="sw-upload-cap">上传文件</span>
                            <input class="sw-upload-btn" type="file" name="files[]" data-url="https://www.sw2025.com/upload" index="/images/15078635376874.png" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg" disabled>
                        </div>
                        <span class="sw-upload-exp">请上传小于7.5M的PDF文件</span>
                        <div class="sw-upload-det">填写具体的媒体报道、产品描述、核心竞争力等，让投资人更了解你<i class="iconfont icon-arrows"></i></div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">选择大V</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-choose-expert swon">
                            <input type="radio" id="system" name="choice">
                            <label for="system" class="radio-label"><span></span><em>系统匹配</em></label>
                        </div>
                        <div class="sw-choose-expert">
                            <input type="radio" id="hand" name="choice">
                            <label for="hand" class="radio-label"><span></span><em>手动选择</em></label>
                        </div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">需要几个大V评议</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-refer">
                        <!-- 系统匹配时显示的内容 -->
                        <div class="sw-need-con">
                            <div class="sw-radio-wrapper swon">
                                <input type="radio" id="threePer" name="person">
                                <label for="threePer" class="radio-label"><span></span><em>3人</em></label>
                            </div>
                            <div class="sw-radio-wrapper">
                                <input type="radio" id="fivePer" name="person">
                                <label for="fivePer" class="radio-label"><span></span><em>5人</em></label>
                            </div>
                        </div>
                        <!-- 手动选择时显示的专家内容 -->
                        <div class="sw-need-con sw-mine">
                            <div class="expert-img-wrapper">
                                <img src="{{asset('img/person1.jpg')}}" alt="">
                                <span title="专家名称一">专一</span>
                            </div>
                            <div class="expert-img-wrapper">
                                <img src="{{asset('img/person1.jpg')}}" alt="">
                                <span title="专家名称一">专家名称一</span>
                            </div>
                            <!--<a href="selectExpert.html" class="sw-choose-link">选择大V</a>-->
                        </div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">支付方式</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-radio-wrapper swon">
                            <input type="radio" id="payWX" name="pay">
                            <label for="payWX" class="radio-label">
                                <span></span><i class="iconfont icon-weixin"></i><em>微信支付</em>
                            </label>
                        </div>
                        <div class="sw-radio-wrapper">
                            <input type="radio" id="payZFB" name="pay">
                            <label for="payZFB" class="radio-label">
                                <span></span><i class="iconfont icon-zhifubao"></i><em>支付宝支付</em>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">支付金额</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-pay-money">100元</div>
                </div>
                <div class="sw-btn-wrapper">
                    <a class="sw-btn-change" href="#">再改改</a>
                    <a class="sw-btn-pay" href="#">去支付</a>
                </div>
            </div>
        </div>
        <div class="sw-pro-tabcon">222</div>
        <div class="sw-pro-tabcon">333</div>
    </div>

</div>
    <script>
        $(function () {
            $('.sw-num').html($('.sw-project-txt').val().length)
        })
    </script>
@endsection
