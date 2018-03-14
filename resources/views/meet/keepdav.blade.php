@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/project.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/payJudge.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery/jquery.qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/pingpp.js')}}"></script>
    <style>

        .changeWeixin img{
            margin:0 auto;
        }
    </style>
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
        <a href="javascript:;" class=" swcol-md-4 swcol-xs-12">xx</a>
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">约见大V</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">xx</a>
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
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled id="name" class="sw-name" value="{{$expertData->expertname}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>总共咨询费用</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled id="linefee" class="sw-linefee" value="{{$meetData->price or ''}}元"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见时长</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" disabled id="linefee" class="sw-linefee" value="{{$meetData->timelot}}小时">
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix linefee">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见时间</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" class="sw-time" disabled value="{{$basedata['time'] or ''}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>问题描述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea disabled placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$meetData->contents}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>



                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>备注</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled class="sw-one-word" value="{{$basedata['oneword']}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled placeholder="输入公司全名" class="sw-entername" value="{{$basedata['enterprisename'] or ''}}"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled placeholder="输入您所在职位" class="sw-enterjob" value="{{$basedata['job']}}"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">{{$basedata['industry']}}</a>
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">支付方式</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-radio-wrapper @if(empty($basedata) ||  $basedata['paytype'] == '微信支付') swon @endif">
                            <input type="radio"  id="payWX" name="pay" disabled>
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
                @if($meetData->configid == 1)
                    <div class="sw-btn-wrapper">
                        <a class="sw-btn-change" href="{{url('/meetIndex',$meetid)}}">再改改</a>
                        <a class="sw-btn-pay" href="javascript:;" id="gotopay">去支付</a>
                    </div>
                @else
                    <div class="sw-btn-wrapper">
                        <a class="sw-btn-pay" href="javascript:;" id="">已完成支付</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="sw-pro-tabcon">222</div>

        <div class="sw-pro-tabcon">333</div>
    </div>

</div>
    <div class="layer-pop" style="position:fixed;background: rgba(0,0,0,0.3);top: 0;left: 0;width: 100%;height: 100%;z-index: 19891016;display: none;">
        <div class="popWx" style="position: absolute;top: 10%;width: 285px;border: 2px solid #ccc;left: 50%;top: 50%;margin: -160px 0 0 -145px;background: #fff;text-align: center;border-radius: 3px;font-size: 14px;padding: 30px 0 27px;">
            <div class="changeWeixin">
                <div class="popWeixin" id="code">
                </div>
            </div>
            <span class="weixinLittle"></span>
            <div class="weixinTips" style="display: none"><strong>扫瞄二维码完成支付</strong><br>支付完成后请关闭二维码</div>
            <a href="javascript:;" class="closePop" title="关闭" style="position: absolute;top: 0;right: 0;"><i class="iconfont icon-chahao"></i></a>
        </div>
    </div>

    <script>
        $(function () {
            $('.sw-num').html($('.sw-project-txt').val().length)
        })
        $('.closePop').on('click',function () {
            window.location = window.location.href;
        });
        $('#gotopay').on('click',function () {
            var that = $(this);
            that.attr('disabled',true);
            var meetid={{$meetid}};
            $.post("{{url('payJudge')}}",{'type':'meet','id':meetid},function (data) {
                if(data.icon==2){
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['360px', '160px'],
                        title: false, //不显示标题
                        shadeClose: false, //开启遮罩关闭
                        content: '<div style="padding:15px;background: #3d921d;color: #fff;"><span style="font-size:18px;">系统检测到您还未登陆/注册</span><br /><br />登陆/注册完跳转到支付页面就可以成功发起项目了~</div>',
                        btn: ['去登陆','去注册','再想想'],
                        yes: function(index, layero){
                            window.location.href="{{asset('/login')}}?type="+data.type+'&id='+data.id;
                        },btn2: function(index, layero){
                            window.location.href="{{asset('/register')}}?type="+data.type+'&id='+data.id;
                        },btn3: function(index, layero){
                            layer.close(index);
                        }
                    });
                } else if(data.icon==1){
                    callPingPay(data.data);
                } else if(data.icon==3) {
                    layer.msg(data.msg);
                    that.attr('disabled',false);
                } else {
                    window.location = window.location.href;
                }

            });
        });
    </script>

@endsection

