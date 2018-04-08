@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/project.css')}}">
    <script type="text/javascript" src="{{asset('js/project.js')}}"></script>
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
{{--<div class="junior-banner">
    <div class="swcontainer">
        <div class="jun-banner-cap">
            <a href="#" class="jun-banner-btn">企业转型升级</a>
            <span class="jun-banner-intro">在线提交创业项目</span>
            <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
        </div>
    </div>
</div>--}}
    <div class="junior-banner">
        <div class="swcontainer">
            <div class="jun-banner-cap">
                <a href="#" class="jun-banner-btn">找投资</a>
                <span class="jun-banner-intro">免费提交创业项目</span>
                <p>获得投资人兴趣意向<br>提高投资几率</p>
            </div>
        </div>
    </div>
<!-- 主体 -->
<div class="sw-project swcontainer">
    <div class="sw-pro-tab clearfix">
        <a href="" class="active swcol-md-12 swcol-xs-12">提交项目</a>

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
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>一句话简介</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" value="{{$showinfo->oneword or ''}}" disabled class="sw-one-word">
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目领域</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-domain">{{$showinfo->domain1}}</a>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>投资阶段</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-stage">{{$showinfo->preference or ''}}</a>
                    </div>
                </div>
               {{-- <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目类型</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-type">类型1</a>
                    </div>
                </div>--}}
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">项目概述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea maxlength="1000" class="sw-project-txt" disabled>{{$showinfo->brief or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>

                <div class="sw-pro-row clearfix forbidden">
                    <div class="swcol-md-4 sw-pro-label">商业计划书</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <div class="sw-upload-wrapper">
                            <span class="sw-upload-cap">{{$showinfo->bpname or '上传文件'}}</span>
                            <input class="sw-upload-btn" type="file" name="files[]" data-url="https://www.sw2025.com/upload" index="/images/15078635376874.png" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg" disabled>
                        </div>
                        <span class="sw-upload-exp">请上传小于7.5M的PDF文件</span>
                        <div class="sw-upload-det">填写具体的媒体报道、产品描述、核心竞争力等，让投资人更了解你<i class="iconfont icon-arrows"></i></div>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled value="{{$basedata['enterprisename'] or ''}}"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled class="sw-enterjob" value="{{$basedata['job'] or ''}}"></div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">{{$basedata['industry'] or ''}}</a>
                    </div>
                </div>
                    <div class="sw-btn-wrapper">
                        <a class="sw-btn-pay" href="javascript:;" onclick="window.location='{{url("submitIndex",$showinfo->showid)}}'">返回修改项目</a>
                        <a class="sw-btn-change" id="delete">取消提交</a>
                    </div>
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
        $('#delete').on('click',function () {
            var showid = {{$showinfo->showid}};
            $.post('{{url('deteleSubmit')}}',{'showid':showid},function (data) {
                if(data.state == 2){
                    layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                        window.location = data.url;
                    });
                }else{
                    layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                        window.location = window.location.href;
                    });
                }
            })
        });
    </script>
@endsection
