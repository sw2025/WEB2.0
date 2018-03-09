@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/project.css')}}">
    <script type="text/javascript" src="{{asset('js/project.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>

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
        <a href="javascript:;" class=" swcol-md-4 swcol-xs-12">项目评议</a>
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">约见投资人</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">创业加速包</a>
    </div>
    <div class="sw-pro-content">
        <div class="sw-pro-tabcon show">
            <div class="sw-pro-para">
                只需要几十元，当您提交问题后，可以获得约见投资人多个维度的论证点评与反馈，让您的创业之路不再迷茫。
            </div>
            <div class="sw-pro-form">

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">大V头像</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-refer">
                        <div class="sw-need-con sw-mine" style="display: block;">
                            <div class="expert-img-wrapper"><img src="{{env('ImagePath').$expertData->showimage}}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见模式</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-pattern">@if($meetData->meettype=='1')线上约见@else线下约见@endif</a>
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>专家名称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" id="name" class="sw-name" value="{{$expertData->expertname}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>资费</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" id="linefee" class="sw-linefee" value="{{$meetData->price}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见时长</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" readonly="true" id="linefee" class="sw-linefee" value="{{$meetData->timelot}}/小时">
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>问题描述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea readonly="true" placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$meetData->contents}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>



                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>备注</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" class="sw-one-word" value="{{$basedata['oneword']}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" placeholder="输入公司全名" class="sw-entername" value="{{$basedata['enterprisename'] or ''}}"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" placeholder="输入您所在职位" class="sw-enterjob" value="{{$basedata['job']}}"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">{{$basedata['industry']}}</a>
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">支付方式</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-radio-wrapper @if(empty($basedata) ||  $basedata['paytype'] == '微信支付') swon @endif">
                            <input type="radio"  id="payWX" name="pay" readonly="true">
                            <label for="payWX" class="radio-label">
                                <span></span><i class="iconfont icon-weixin"></i><em>微信支付</em>
                            </label>
                        </div>
                        <div class="sw-radio-wrapper @if(!empty($basedata) && $basedata['paytype'] == '支付宝支付') swon @endif">
                            <input type="radio" id="payZFB"  name="pay" >
                            <label for="payZFB" class="radio-label">
                                <span></span><i class="iconfont icon-zhifubao"></i><em>支付宝支付</em>
                            </label>
                        </div>
                    </div>
                </div>



                <input type="hidden" value="" id="expertid">
                <div class="sw-btn-wrapper">
                    <button class="sw-btn-submit" type="button" onclick=window.location="{{url("/meetIndex/$meetid")}}" >修改内容资料</button>
                    <button class="sw-btn-submit" type="button" id="submit">去支付</button>
                </div>
            </div>
        </div>
        <div class="sw-pro-tabcon">222</div>
        <div class="sw-pro-tabcon">333</div>
    </div>

</div>

@endsection

