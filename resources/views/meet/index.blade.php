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
        <a href={{url('/showindex')}}" class=" swcol-md-4 swcol-xs-12">项目评议</a>
        <a href="javascript:;" class="active swcol-md-4 swcol-xs-12">约见投资人</a>
        <a href="javascript:;" class="swcol-md-4 swcol-xs-12">线下路演</a>
    </div>
    <div class="sw-pro-content">
        <div class="sw-pro-tabcon show">
            <div class="sw-pro-para">
                只需要几十元，当您提交问题后，可以获得约见投资人多个维度的论证点评与反馈，让您的创业之路不再迷茫。
            </div>



                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label">选择投资人</div>
                    <div class="swcol-md-8 sw-pro-rowcon sw-refer">
                        <div class="sw-need-con sw-mine" style="display: block;">
                            @if(!empty($meetData)))
                            <div class="expert-img-wrapper"><img src="{{env('ImagePath').$expertData->showimage}}" alt=""></div>
                            @endif

                            <a href="{{url('selectExpert')}}?type=meet" class="sw-choose-link">选择大V</a>

                        </div>
                    </div>
                </div>

            <div class="sw-pro-row clearfix linefee">
                <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>专家名称</div>
                <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" id="name" class="sw-name" value="{{$expertData->expertname or  ' ' }}"></div>
            </div>

            <div class="sw-pro-row clearfix linefee">
                <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见模式</div>
                <div class="swcol-md-8 sw-pro-rowcon">
                    <a href="javascript:;" class="sw-select-default sw-pattern" >@if(!empty($meetData)) @if($meetData->meettype=='1')线上约见@else线下约见@endif @else选择模式@endif</a>
                    <ul class="sw-select-list sw-field-list">
                        <li>线下约见</li>
                        <li>线上约见</li>
                    </ul>
                    <span class="sw-error"></span>
                </div>
            </div>




                <div class="sw-pro-row clearfix linefee">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>资费</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" readonly="true" id="linefee" class="sw-linefee" fee="{{$expertData->fee or 0}}" linefee="{{$expertData->linefee or 0}}" value="@if(!empty($meetData) && $meetData->meettype)  {{$expertData->fee or 0}} @else {{$expertData->linefee or 0}} @endif"></div>
                </div>

                <div class="sw-pro-row clearfix linefee">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>约见时长</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-timelot">{{$meetData->timelot or '选择约见时长' }}</a>小时
                        <ul class="sw-select-list sw-field-list">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                        <span class="sw-error"></span>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label "><span class="need">*</span>问题描述</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-project-txt" >{{$meetData->contents or ''}}</textarea>
                        <div class="sw-count"><span class="sw-num">0</span>/1000</div>
                    </div>
                </div>



                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>备注</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <textarea placeholder="可拆分为产品描述、用户群体、项目愿景、竞争对手等方面详细描述，不超过1000字" maxlength="1000" class="sw-one-word" >{{$basedata['oneword'] or ''}}</textarea>
                    </div>
                </div>

                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>工商注册公司全称</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入公司全名" class="sw-entername" value="@if(!empty($basedata['enterprisename'])){{$basedata['enterprisename']}}@elseif(!empty($entinfo)){{$entinfo->enterprisename}}@else @endif"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>您所在职位</div>
                    <div class="swcol-md-8 sw-pro-rowcon"><input type="text" placeholder="输入您所在职位" class="sw-enterjob" value="@if(!empty($basedata['job'])){{$basedata['job']}}@elseif(!empty($entinfo)){{$entinfo->job}} @else @endif"></div>
                </div>
                <div class="sw-pro-row clearfix">
                    <div class="swcol-md-4 sw-pro-label"><span class="need">*</span>公司所在行业</div>
                    <div class="swcol-md-8 sw-pro-rowcon">
                        <a href="javascript:;" class="sw-select-default sw-industry">@if(!empty($basedata['industry'])){{$basedata['industry']}}@elseif(!empty($entinfo)) {{$entinfo->industry}}@else选择行业@endif</a>
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



          <input type="hidden" value="{{$meetData->expertid or ''}}" id="expertid">
          <div class="sw-btn-wrapper">
              @if(!empty($meetData))
                  <input type="hidden" value="{{$meetid}}" id="meetid">
                  <button class="sw-btn-submit" type="button" >返回</button>
                  <button class="sw-btn-submit" type="button" id="submit">确认修改</button>
              @else
                        <input type="hidden" value="" id="meetid">
                        <button class="sw-btn-submit" type="button" id="submit">邀请专家</button>
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
            var meettype = $('.sw-pattern').text();
            var name = $('.sw-name').val();  //专家姓名
            var linefee = parseInt($('.sw-linefee').val());  //资费
            var expertid = $('#expertid').val();  //资费
            var timelot = $('.sw-timelot').text();  //时长
            var oneword = $('.sw-one-word').val();  //备注
            var domain = $('.sw-domain').text();  //领域
            var projecttxt = $('.sw-project-txt').val();  //项目概述
            var enterjob = $('.sw-enterjob').val(); //身份
            var entername = $('.sw-entername').val(); //企业名称
            var industry = $('.sw-industry').text(); //企业行业
            var meetid = $('#meetid').val();
            //支付的方式
            var paytype = $.trim($('.sw-need-con .swon').children('label').text());

            //约见模式
            if($.trim(meettype) == '线上约见'){
                var meettype =1;
            } else {
                var meettype =0;
            }

            if(meettype == '选择模式' || oneword == '' || projecttxt == '' || entername == '' || timelot == '选择约见时长'){
                layer.alert('请填写完整信息');
                return false;
            }

            if(industry == '选择行业'){
                layer.alert('请填写行业信息');
                return false;
            }

            //var fileObj = document.getElementById("bpurl").files[0]; // js 获取文件对象
            var formFile = new FormData();
            formFile.append("meettype", meettype);
            formFile.append("type", 1);
            formFile.append("name", name);
            formFile.append("linefee", linefee);
            formFile.append("timelot", timelot);
            formFile.append("expertid", expertid);
            formFile.append("oneword", oneword);
            formFile.append("projecttxt", projecttxt);
            formFile.append("entername", entername);
            formFile.append("enterjob", enterjob);
            formFile.append("industry", industry);
            formFile.append("paytype", paytype); //加入文件对象
            formFile.append("meetid", meetid); //加入文件对象

            $(this).attr('disabled',true);
            $(this).text('正在提交');
            $.ajax({
                url: "{{url('submitMeet')}}",
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
           /* if({{$meetid}}){
                var layermsg = '提示：修改暂不支持更换选择大V方式，请您重新填写项目';
            } else {
                var layermsg = '提示：请您先选择好几位大V进行评议或者自定完大V 再填写项目';
            }
            layer.tips(layermsg, '#tipsneed', {
                tips: [1, '#e25633'],
                time: 8000
            });*/

            if($.cookie("reselect")){
                var expertChecked=$.cookie('reselect').split("@");
                expertid = expertChecked[0];
                image = expertChecked[1];
                name = expertChecked[2];
                linefee = expertChecked[3];
                fee = expertChecked[4];
                $('.sw-choose-expert').eq(0).removeClass('swon');
                $('.sw-choose-expert').eq(1).addClass('swon');
                var str = '';
                str += '<div class="expert-img-wrapper"><img src="http://images.sw2025.com'+image+'" alt=""></div>';
                $('#expertid').val(expertid);
                $('#name').val(name);
                $('#linefee').attr('linefee',linefee);
                $('#linefee').attr('fee',fee);
                $('.sw-mine').css('display','block').siblings('.sw-need-con').css('display','none');
                $('.sw-mine').prepend(str);
                $.cookie("reselect","",{path:'/',domain:'sw2025.com'});
                $.cookie("reselect","",{path:'/',domain:'swchina.com'});
            }else {
                if(!{{$meetid}}) {
                    $('.linefee').css('display', 'none');
                }
            }
        });
    </script>


@endsection

