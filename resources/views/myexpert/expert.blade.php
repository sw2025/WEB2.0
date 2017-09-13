@extends("layouts.ucenter4")
@section("content")
        <!-- 公共header / end -->
<script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
<div class="main">
    <!-- 发布需求 / start -->
    <h3 class="main-top">专家认证</h3>
    <div class="ucenter-con">
        <div class="main-right">
            <div class="card-step">
                <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                <span class="gray-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                <span class="gray-circle">3</span>认证成功
            </div>
            <div class="expert-certy">
                <div class="expert-certy-state">
                    <i class="iconfont icon-tijiaoziliao"></i>
                        <span class="expert-certy-blue">
                                    <em>资料提交</em>THE DATA SUBMITTED
                                </span>
                    <br/>
                    @if(!empty($result) && $result->configid==3)
                        <span style="color:red">
                            <em>审核失败</em>
                            拒绝理由：{{$result->remark}}
                        </span>
                    @else
                    @endif
                </div>

                <div class="datas">
                    <div class="datas-lt">
                        <div class="datas-lt-enter">
                            <div class="datas-sel zindex4">
                                <span class="datas-sel-cap">专家分类</span><a href="javascript:;" id="category"
                                                                          class="datas-sel-def">专家</a>

                                <ul class="datas-list">
                                    <li>专家</li>
                                    <li>机构</li>
                                    <li>企业家</li>
                                </ul>
                            </div>
                            <div class="datas-sel">
                                <span class="datas-sel-cap">输入姓名</span>
                                <input class="datas-sel-name" type="text" placeholder=""
                                       value="@if(!empty($result)){{$result->expertname }}@else @endif"/>
                            </div>
                            <div class="datas-sel zindex3">
                                <span class="datas-sel-cap">擅长行业</span><a href="javascript:;" class="datas-sel-def"
                                                                          id="industrys"></a>
                                <ul class="datas-list">
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
                            </div>
                            <div class="publish-need-sel datas-newchange zindex2">
                                <span class="publ-need-sel-cap">擅长领域</span><a href="javascript:;" id="industry"
                                                                              class="publ-need-sel-def">@if(!empty($info)) {{$info->domain1}}
                                    /{{$info->domain2}} @else 请选择 @endif</a>
                                <ul class="publish-need-list">
                                    @foreach($cate as $v)
                                        @if($v->level == 1)
                                            <li>
                                                <a href="javascript:;">{{$v->exdomainname}}</a>
                                                <ul class="publ-sub-list">
                                                    @foreach($cate as $small)
                                                        @if($small->parentid == $v->domainid && $small->level == 2)
                                                            <li>{{$small->domainname}}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="datas-sel zindex1">
                                <span class="datas-sel-cap">地区</span><a href="javascript:;" id="address"
                                                                        class="datas-sel-def">全国</a>
                                <ul class="datas-list zone-list">
                                    <li>全国</li>
                                    <li>北京</li>
                                    <li>上海</li>
                                    <li>天津</li>
                                    <li>重庆</li>
                                    <li>河北</li>
                                    <li>山西</li>
                                    <li>内蒙古</li>
                                    <li>辽宁</li>
                                    <li>吉林</li>
                                    <li>黑龙江</li>
                                    <li>江苏</li>
                                    <li>浙江</li>
                                    <li>安徽</li>
                                    <li>福建</li>
                                    <li>江西</li>
                                    <li>山东</li>
                                    <li>河南</li>
                                    <li>湖北</li>
                                    <li>湖南</li>
                                    <li>广东</li>
                                    <li>广西</li>
                                    <li>海南</li>
                                    <li>四川</li>
                                    <li>贵州</li>
                                    <li>云南</li>
                                    <li>西藏</li>
                                    <li>陕西</li>
                                    <li>甘肃</li>
                                    <li>青海</li>
                                    <li>宁夏</li>
                                    <li>新疆</li>
                                    <li>台湾</li>
                                    <li>香港</li>
                                    <li>澳门</li>
                                </ul>
                            </div>
                        </div>
                        <div class="datas-upload-box clearfix">
                            <div class="datas-upload-lt">
                                <img src="@if(!empty($result)){{env('ImagePath').$result->licenceimage}}@else img/photo1.jpg @endif"
                                     class="photo1" id="avatar1"/>
                                <div class="photo-upload">
                                    <div class="photo-btn-box fileinput-button">
                                        <span class="photo-btn-tip">上传专家执照</span>
                                        <input id="photo1" type="file" name="files[]" data-url="{{asset('upload')}}"
                                               index="@if(!empty($result)){{$result->licenceimage}}@endif" multiple=""
                                               accept="image/png, image/gif, image/jpg, image/jpeg">
                                    </div>
                                    <p class="datas-lt-explain">专家执照仅做认证用，不用做其它用途</p>
                                </div>
                            </div>
                            <div class="datas-upload-rt">
                                <img src="@if(!empty($result)){{env('ImagePath').$result->showimage}}@else img/photo2.jpg @endif"
                                     id="avatar2" class="photo1"/>
                                <div class="photo-upload">
                                    <div class="photo-btn-box fileinput-button">
                                        <span class="photo-btn-tip">上传专家照片</span>
                                        <input id="photo2" type="file" name="files[]" data-url="{{asset('upload')}}"
                                               multiple="" index="@if(!empty($result)){{$result->showimage}}@endif"
                                               accept="image/png, image/gif, image/jpg, image/jpeg">
                                    </div>
                                    <p class="datas-lt-explain">专家照片用于展示专家，请选择能展现专家风采的照片</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="datas-rt htxt1">
                        <textarea onkeyup="checkLength(this);" placeholder="请输入专家描述" id="brief" cols="30"
                                  rows="10">@if(!empty($result)){{$result->brief}}@endif</textarea>
                    </div>
                </div>
                <div class="bottom-btn">
                    <button class="test-btn submit-audit" type="button">提交审核</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.datas-sel-def').click(function () {
            $(this).next('ul').stop().slideToggle();
            $(this).parent().siblings().children('ul').hide();
        });
        $('.datas-list li').click(function () {
            var publishHtml = $(this).html();
            $(this).parent().prev('.datas-sel-def').html(publishHtml);
            $(this).parent().hide();
        });

        $('.publ-need-sel-def').click(function (e) {
            e.stopPropagation();
            $(this).next('ul').stop().slideToggle();
        });

        $('.publish-need-list li').hover(function () {
            $(this).children('ul').stop().show();
        }, function () {
            $(this).children('ul').stop().hide();
        });
        $('.publish-need-list li a').click(function (e) {
            e.stopPropagation();
            if ($(this).next('ul').children('li').length == 0) {
                var m = $(this).html()
                $(this).closest('.publish-need-list').prev().html(m);
            }
        })
        $(document).click(function (event) {
            $('.publish-need-list').hide();
        });
        $('.publ-sub-list li').click(function (e) {
            e.stopPropagation();
            $(this).toggleClass('on');
            $(this).closest('.publish-need-list>li').siblings().find('li').removeClass('on');
            var y = $(this).parent('ul').prev('a').html();
            var x = y + '-';
            $('.publ-sub-list li').each(function (index, el) {
                if ($(el).hasClass('on')) {
                    // x = $('.on').html();
                    x += $(el).html() + '/';
                    $('.publ-need-sel-def').html(x);

                } else {
                    $('.publ-need-sel-def').html(x);
                }

            });
        });
    })

    $(function () {
        var token = $.cookie('token');
        $('#photo1').fileupload({
            dataType: 'json',
            maxFileSize: 1 * 1024 * 1024,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    // console.log(file.name);
                    $("#avatar1").attr('src', '{{env('ImagePath')}}/images/' + file.name).show();
                    $('#photo1').attr('index', '/images/' + file.name);
                });
            }
        });
    });

    $(function () {
        var token = $.cookie('token');
        $('#photo2').fileupload({
            dataType: 'json',
            maxFileSize: 1 * 1024 * 1024,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    // console.log(file.name);
                    $("#avatar2").attr('src', '{{env('ImagePath')}}/images/' + file.name).show();
                    $('#photo2').attr('index', '/images/' + file.name);
                });
            }
        });
    });


    $(function () {
        $('.submit-audit').click(function () {
            $('.submit-audit').attr('disabled', 'disabled');
            var category = $('#category').html();
            var name = $('.datas-sel-name').val();
            var industry = $('#industry').html();
            var industrys = $("#industrys").html();
            var address = $('#address').html();
            var photo1 = $('#photo1').attr('index');
            var photo2 = $('#photo2').attr('index');
            var brief = $('#brief').val();
            console.log(name == '' || photo1 == '' || industry == '请选择');
            if (name == '' || photo1 == '' || industry == '请选择' || industrys == '' || brief == '') {
                layer.msg('请把信息填写完整');
                $('.submit-audit').attr('disabled', false);
                return false;
            } else {
                $.ajax({
                    url: "{{asset('/uct_expertData')}}",
                    data: {
                        "category": category,
                        "name": name,
                        "industry": industry,
                        "address": address,
                        "photo1": photo1,
                        "photo2": photo2,
                        "brief": brief,
                        "industrys": industrys
                    },
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        if (data.icon == 1) {
                            layer.msg(data.msg, {'time': 2000, 'icon': data.icon}, function () {
                                window.location = '{{asset('/uct_expert2')}}';
                            });
                        } else {
                            layer.msg(data.msg, {'time': 2000, 'icon': data.icon});
                            $('.submit-audit').attr('disabled', false);
                        }
                    }
                })
            }

        });
    })
</script>
@endsection