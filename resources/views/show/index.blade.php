@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/project.css')}}">
    <script type="text/javascript" src="{{asset('js/project.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>

    <!-- banner -->
<div class="junior-banner">
    <div class="swcontainer">
        <div class="jun-banner-cap">
            <a href="#" class="jun-banner-btn">找投资</a>
            <span class="jun-banner-intro">在线提交创业项目</span>
            <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
        </div>
    </div>
</div>
<!-- 主体 -->
<div class="sw-project swcontainer">
    <div class="sw-pro-tab clearfix">
        <a href="{{url('/submitIndex')}}" class="swcol-md-4 swcol-xs-12">直通路演</a>
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">VC直评</a>

        <a href="{{url('meetIndex')}}" class="swcol-md-4 swcol-xs-12">约见投资人</a>

    </div>
    <div class="sw-pro-content">
        <div class="sw-pro-tabcon show">
            <div class="sw-pro-para">
                只需要几十元，当您提交项目后，可以获得投资人多个维度的论证点评与反馈，让您的创业之路不再迷茫。
            </div>
            <div class="sw-pro-form">

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">选择大V</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-choose-expert @if(empty($basedata) ||  $basedata['selecttype'] == '系统匹配') swon @endif">
                            <input type="radio" id="system" name="choice" value="system">
                            <label for="system" class="radio-label"><span></span><em>系统匹配</em></label>
                        </div>
                        <div class="sw-choose-expert @if(!empty($basedata) && $basedata['selecttype'] == '手动选择') swon @endif">
                            <input type="radio" id="hand" name="choice" value="artificial">
                            <label for="hand" class="radio-label"><span></span><em id="tipsneed">手动选择</em></label>
                        </div>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">需要几个大V评议</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-refer">
                        <div class="sw-need-con" @if(empty($basedata) ||  $basedata['selecttype'] == '系统匹配') style="display: block;" @else style="display: none;" @endif>
                            <div class="sw-radio-wrapper  @if(empty($basedata) ||  ($basedata['selecttype'] == '系统匹配' && $basedata['selectnumbers'] == 3)) swon @endif">
                                <input type="radio" id="threePer" name="person">
                                <label for="threePer" class="radio-label"><span></span><em>3人</em></label>
                            </div>
                            <div class="sw-radio-wrapper" @if(!empty($basedata) &&  $basedata['selecttype'] == '系统匹配' && $basedata['selectnumbers'] == 5) swon @endif>
                                <input type="radio" id="fivePer" name="person">
                                <label for="fivePer" class="radio-label"><span></span><em>5人</em></label>
                            </div>

                        </div>
                        <div class="sw-need-con sw-mine" @if(!empty($basedata) && $basedata['selecttype'] == '手动选择') style="display: block;" @else style="display: none;" @endif>
                            @if(!empty($showimages) &&  !empty($basedata) && $basedata['selecttype'] == '手动选择')
                                @foreach($showimages as $v)
                                    <div class="expert-img-wrapper">
                                        <img src="{{env('ImagePath').$v->showimage}}" alt="">
                                        <span title="{{$v->expertname}}">{{$v->expertname}}</span>
                                    </div>
                                @endforeach

                            @else
                                <a href="{{url('selectExpert')}}?type=show" class="sw-choose-link">选择大V</a>
                            @endif

                        </div>
                    </div>
                </div>


                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目名称</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" placeholder="输入项目名称" class="project-name" value="{{$showinfo->title or ''}}">
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>一句话简介</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <input type="text" placeholder="一句话概括产品与服务，30字内" class="sw-one-word" value="{{$showinfo->oneword or ''}}">
                        <span class="sw-error"></span>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目领域</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-domain">{{$showinfo->domain1 or '选择领域'}}</a>
                        <ul class="sw-select-list sw-field-list">
                            @foreach($cate1 as $v)
                                <li style="padding: 5px;">{{$v->name}}</li>
                            @endforeach
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>投资阶段</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-stage">{{$showinfo->preference or '选择阶段'}}</a>
                        <ul class="sw-select-list sw-role-list">
                            @foreach($cate2 as $v)
                                <li style="padding: 5px;">{{$v->name}}</li>
                            @endforeach
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>
            {{--    <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>项目类型</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-type">选择项目类型</a>
                        <ul class="sw-select-list sw-type-list">
                            <li>领域1</li>
                            <li>领域领域2</li>
                            <li>领域反反复复3</li>
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>--}}
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>项目概述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$showinfo->brief or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>
             {{--  <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">投资主体</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-role">{{$basedata['role'] or '选择主体'}}</a>
                        <ul class="sw-select-list sw-role-list">
                            <li>企业</li>
                            <li>个人</li>
                            <li>其他</li>
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>--}}


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
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入公司全名" class="sw-entername" value="@if(!empty($basedata['enterprisename'])){{$basedata['enterprisename']}}@elseif(!empty($entinfo)){{$entinfo->enterprisename}}@else @endif"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入您所在职位" class="sw-enterjob" value="@if(!empty($basedata['job'])){{$basedata['job']}}@elseif(!empty($entinfo)){{$entinfo->job}}@else @endif"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">@if(!empty($basedata['industry'])){{$basedata['industry']}}@elseif(!empty($entinfo)){{$entinfo->industry}}@else选择行业@endif</a>
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


                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">支付方式</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-need-con">
                        <div class="sw-radio-wrapper @if(empty($basedata) ||  $basedata['paytype'] == '微信支付') swon @endif">
                            <input type="radio" id="payWX" name="pay">
                            <label for="payWX" class="radio-label">
                                <span></span><i class="iconfont icon-weixin"></i><em>微信支付</em>
                            </label>
                        </div>
                        <div class="sw-radio-wrapper @if(!empty($basedata) && $basedata['paytype'] == '支付宝支付') swon @endif">
                            <input type="radio" id="payZFB" name="pay">
                            <label for="payZFB" class="radio-label">
                                <span></span><i class="iconfont icon-zhifubao"></i><em>支付宝支付</em>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">每一位评议人评议价格</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-pay-money">89元</div>
                </div>
                <div class="sw-btn-wrapper">
                    @if(!empty($showinfo))
                        <input type="hidden" value="{{$showinfo->showid}}" id="showid">
                        <button class="sw-btn-submit" type="button" id="" style="margin-right: 10%;" onclick=window.location="{{url('/showIndex/')}}">重新发起项目评议 </button>
                        <button class="sw-btn-submit" type="button" id="submit">修改项目评议</button>
                    @else
                        <input type="hidden" value="" id="showid">
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
            var oneword = $('.sw-one-word').val();  //一次简介
            var domain = $('.sw-domain').text();  //领域
            var projecttxt = $('.sw-project-txt').val();  //项目概述
            /*var role = $('.sw-role').text();  //身份*/
            var stage = $('.sw-stage').text(); //融资轮次
            var entername = $('.sw-entername').val(); //企业名称
            var enterjob = $('.sw-enterjob').val(); //项目名称
            var industry = $('.sw-industry').text(); //企业行业
            var upload= $('.sw-upload-btn').attr('index');    //上传文件
            var showid = $('#showid').val();
            //选择方式
           /* var selecttype = $.trim($('.sw-need-con .swon').children('label').eq(0).text());
            if(selecttype=='系统匹配'){
                //选择评议人的数量
                var selectnumbers = $.trim($('.sw-need-con .swon').children('label').eq(1).text());
            } else {
                var selectnumbers = ids;
            }*/
            //支付的方式
           /* var paytype = $.trim($('.sw-need-con .swon').children('label').eq(2).text());*/

            if(projectname == '' || oneword == '' || projecttxt == '' || entername == '' || enterjob == '' || upload == ''){
                layer.alert('请填写完整信息');
                return false;
            }

            if(domain == '选择领域' || stage=='选择阶段' || industry == '选择行业'){
                layer.alert('请填写完整领域/投资阶段/行业信息');
                return false;
            }

            var fileObj = document.getElementById("bpurl").files[0]; // js 获取文件对象
            var formFile = new FormData();
            formFile.append("projectname", projectname);
            formFile.append("oneword", oneword);
            formFile.append("domain", domain);
            formFile.append("projecttxt", projecttxt);
            /*formFile.append("role", role);*/
            formFile.append("stage", stage);
            formFile.append("entername", entername);
            formFile.append("enterjob", enterjob);
            formFile.append("industry", industry);
            formFile.append("file", fileObj); //加入文件对象
            formFile.append("selecttype", selecttype); //加入文件对象
            formFile.append("selectnumbers", selectnumbers); //加入文件对象
            formFile.append("paytype", paytype); //加入文件对象
            formFile.append("showid", showid); //加入文件对象
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
                url: "{{url('submitShow')}}",
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
        $(function () {
            /*if({{$showid}}){
                var layermsg = '提示：修改暂不支持更换选择大V方式，请您重新填写项目';
            } else {
                var layermsg = '提示：请您先选择好几位大V进行评议或者自定完大V 再填写项目';
            }*/
            /*layer.tips(layermsg, '#tipsneed', {
                tips: [1, '#e25633'],
                time: 8000
            });*/

            if($.cookie("reselect")){
                var expertChecked=$.cookie('reselect').split(",");

                for(var i=0; i<expertChecked.length; i++) {
                    var checked=expertChecked[i];
                    var end=checked.indexOf("@");
                    var id=checked.substring(0,end);
                    var image=checked.substring(end+1);
                    ids.push(id);
                    images.push(image);
                }
                ids = ids.join(',');
                $('.sw-choose-expert').eq(0).removeClass('swon');
                $('.sw-choose-expert').eq(1).addClass('swon');
                var str = '';
                for(i=0;i<images.length;i++){
                    str += '<div class="expert-img-wrapper"><img src="http://images.sw2025.com'+images[i]+'" alt=""></div>';
                }
                $('.sw-mine').css('display','block').siblings('.sw-need-con').css('display','none');
                $('.sw-mine').prepend(str);
                $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
                $.cookie("reselect","",{path:'/',domain:'swchina.com'});
            }
        });
    </script>


@endsection

