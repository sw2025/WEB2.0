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
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">项目评议</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">约见投资人</a>
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">线下路演</a>
    </div>
    <div class="sw-pro-content">
        <div class="sw-pro-tabcon show">
            <div class="sw-pro-para">
                        只需要填写表单，当您提交项目后，升维网可以获得帮你进行线下路演，通过投资人多个维度的论证点评与反馈，让您的创业之路不再迷茫。
            </div>
            <div class="sw-pro-form">

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目名称</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" placeholder="输入项目名称"disabled class="project-name" value="{{$lineShowData->title or ''}}">
                        <span class="sw-error"></span>
                    </div>
                </div>


                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>项目概述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea disabled placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$lineShowData->describe or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div><
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>项目备注</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="备注，不超过1000字" disabled maxlength="1000" class="sw-remarks" >{{$lineShowData->remarks or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>


                <form name="form1" id="form1">
                    <div class="sw-pro-row clearfix">
                        <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>商业计划书</div>
                        <div class="swcol-md-8 sw-pro-rowcon">
                            <div class="sw-upload-wrapper">
                                <span class="sw-upload-cap">{{$lineShowData->bpname or '上传文件'}}</span>
                                <input class="sw-upload-btn" disabled type="file" name="files[]" id='bpurl' data-url="https://www.sw2025.com/upload" {{--index="/images/15078635376874.png"--}} multiple="" accept="" index="@if(!empty($lineShowData)) 1 @endif">
                            </div>
                            <span class="sw-upload-exp">请上传小于7.5M的PDF文件</span>
                            <div class="sw-upload-det">填写具体的媒体报道、产品描述、核心竞争力等，让投资人更了解你<i class="iconfont icon-arrows"></i></div>
                        </div>
                    </div>
                </form>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled placeholder="输入公司全名" class="sw-entername" value="{{$lineShowData->enterprisename or ''}} "></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" disabled placeholder="输入您所在职位" class="sw-enterjob" value="{{$lineShowData->job or ''}} "></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">{{$lineShowData->industry or '选择行业'}} </a>
                        <span class="sw-error"></span>
                    </div>
                </div>


                <div class="sw-btn-wrapper">
                    @if(!empty($lineShowData))
                        @if($lineShowData->state==1)
                            <input type="hidden" value="" id="lineshowid">
                            <button class="sw-btn-submit" type="button" id="delete" style="margin-right: 10%;" >取消线下路演项目提交</button>
                            <button class="sw-btn-submit" type="button" id="submit">等待</button>
                        @else
                            <button class="sw-btn-submit" type="button" id="submit">已取消</button>
                        @endif
                    @else
                        <input type="hidden" value="" id="lineshowid">
                        <button class="sw-btn-submit" type="button" id="submit">申请项目评议</button>
                    @endif

                </div>
            </div>
        </div>
        <div class="sw-pro-tabcon">222</div>
        <div class="sw-pro-tabcon">333</div>
    </div>
</div>
    <script>

        $('#delete').on('click',function () {
            var lineshowid = {{$lineShowData->lineshowid}};
            $.post('{{url('cancelLineShow')}}',{'lineshowid':lineshowid},function (data) {
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

