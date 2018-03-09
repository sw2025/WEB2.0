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
                        <input type="text" placeholder="输入项目名称" class="project-name" value="{{$showinfo->title or ''}}">
                        <span class="sw-error"></span>
                    </div>
                </div>


                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>项目概述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$showinfo->brief or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div><
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>项目备注</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="备注，不超过1000字" maxlength="1000" class="sw-remarks" >{{$showinfo->brief or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>


                <form name="form1" id="form1">
                    <div class="sw-pro-row clearfix">
                        <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>商业计划书</div>
                        <div class="swcol-md-8 sw-pro-rowcon">
                            <div class="sw-upload-wrapper">
                                <span class="sw-upload-cap">{{$showinfo->bpname or '上传文件'}}</span>
                                <input class="sw-upload-btn" type="file" name="files[]" id='bpurl' data-url="https://www.sw2025.com/upload" {{--index="/images/15078635376874.png"--}} multiple="" accept="" index="@if(!empty($showinfo)) 1 @endif">
                            </div>
                            <span class="sw-upload-exp">请上传小于7.5M的PDF文件</span>
                            <div class="sw-upload-det">填写具体的媒体报道、产品描述、核心竞争力等，让投资人更了解你<i class="iconfont icon-arrows"></i></div>
                        </div>
                    </div>
                </form>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入公司全名" class="sw-entername" value="@if(!empty($basedata['enterprisename'])){{$basedata['enterprisename']}} @elseif(!empty($entinfo)) {{$entinfo->enterprisename}} @else @endif "></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入您所在职位" class="sw-enterjob" value="@if(!empty($basedata['job'])){{$basedata['job']}} @elseif(!empty($entinfo)) {{$entinfo->job}} @else @endif "></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">@if(!empty($basedata['industry'])){{$basedata['industry']}} @elseif(!empty($entinfo)) {{$entinfo->industry}} @else选择行业@endif </a>
                        <ul class="sw-select-list sw-field-list">
                            <li>IT|通信|电子|互联网</li>
                            <li>金融业</li>
                            <li>房地产|建筑业</li>
                            <li>商业服务</li>
                            <li>贸易|批发|零售|租赁业</li>
                            <li>文体教育|工艺美术</li>
                            <li>生产|加工|制造</li>
                            <li>交通|运输|物流|仓储</li>
                            <li>服务业</li>
                            <li>文化|传媒|娱乐|体育</li>
                            <li>能源|矿产|环保</li>
                            <li>政府|非盈利机构</li>
                            <li>农|林|牧|渔|其他</li>
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>


                <div class="sw-btn-wrapper">
                    @if(!empty($showinfo))
                        <input type="hidden" value="" id="lineshowid">
                        <button class="sw-btn-submit" type="button" id="" style="margin-right: 10%;" onclick=window.location="{{url('/showIndex/')}}">重新发起项目评议 </button>
                        <button class="sw-btn-submit" type="button" id="submit">修改项目评议</button>
                    @else
                        <input type="hidden" value="" id="lineshowid">
                        <button class="sw-btn-submit" type="button" id="submit">申请线下路演</button>
                    @endif

                </div>
            </div>
        </div>
        <div class="sw-pro-tabcon">222</div>
        <div class="sw-pro-tabcon">333</div>
    </div>

</div>

    <script>
        var ids = new Array;
        var images = new Array;
        /**
         * 上传文件onchang事件
         */
        $('.sw-upload-btn').on('change',function (e) {
            var path =  $('.sw-upload-btn').val();
            var test1 = path.lastIndexOf("/");  //对路径进行截取
            var test2 = path.lastIndexOf("\\");  //对路径进行截取
            var test= Math.max(test1, test2)
            if(test<0){
                var value2 = path;
            }else{
                var value2 = path.substring(test + 1); //赋值文件名
            }
            $(this).attr('index',path);
            $('.sw-upload-cap').text(value2);
        });

        /**
         * 提交onclick事件
         */
        $('#submit').on('click',function () {
            var projectname = $('.project-name').val();  //项目名称
            var projecttxt = $('.sw-project-txt').val();  //项目概述
            var remarks = $('.sw-remarks').val();
            var entername = $('.sw-entername').val(); //企业名称
            var enterjob = $('.sw-enterjob').val(); //身份
            var industry = $('.sw-industry').text(); //企业行业

            var upload= $('.sw-upload-btn').attr('index');    //上传文件
            var lineshowid = $('#lineshowid').val();

            if(projectname == '' ||  projecttxt == '' || entername == '' || enterjob == '' || upload == ''){
                layer.alert('请填写完整信息');
                return false;
            }

            if(industry == '选择行业'){
                layer.alert('请填写行业信息');
                return false;
            }

            var fileObj = document.getElementById("bpurl").files[0]; // js 获取文件对象
            var formFile = new FormData();
            formFile.append("projectname", projectname);
            formFile.append("projecttxt", projecttxt);
            formFile.append("remarks", remarks);
            formFile.append("entername", entername);
            formFile.append("enterjob", enterjob);
            formFile.append("industry", industry);

            formFile.append("file", fileObj); //加入文件对象

            formFile.append("lineshowid", lineshowid); //加入文件对象
            formFile.append("upload", upload); //加入文件对象
            if($.trim(upload)!='1'){
                if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                    layer.alert('请选择正确的文件');
                    return false;
                }
            }


            $(this).attr('disabled',true);
            $(this).text('正在提交');
            $.ajax({
                url: "{{url('submitLineShow')}}",
                data: formFile,
                type: "Post",
                dataType: "json",
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                success: function (data) {
                    if(data.icon==1){
                        layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                            window.location = data.url;
                        });
                    } else {
                        layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                            window.location = window.location.href;
                        });
                    }
                },
            });
        });

    </script>


@endsection

