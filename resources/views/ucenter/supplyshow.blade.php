@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" href="{{asset('css/events.css')}}">
    <link rel="stylesheet" href="{{asset('css/publishneed.css')}}">
    <div class="main">
        <!-- 发布需求 / start -->
        <h3 class="main-top">项目评议</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step">
                    <span class="green-circle">1</span>提交项目
                </div>
                <div class="publish-need">
                    <form name="form1" id="form1">
                    <table class="invite-table">
                        <tr>
                            <td>项目分类</td>
                            <td>
                                <div class="publish-need-sel">
                                    {{--  <span class="publ-need-sel-cap">项目分类</span>--}}<a href="javascript:;" class="publ-need-sel-def">@if(!empty($info)) {{$info->domain1}}/{{$info->domain2}} @else 请选择 @endif</a>
                                    <ul class="publish-need-list">
                                        @foreach($cate as $v)
                                            @if($v->level == 1)
                                                <li>
                                                    <a href="javascript:;">{{$v->domainname}}</a>
                                                    <ul class="publ-sub-list">
                                                        @foreach($cate as $small)
                                                            @if($small->parentid == $v->domainid && $small->level == 2)
                                                                <li>{{$small->domainname}}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>

                                                @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>项目标题</td>
                            <td> <input   name="" id="title" class="publish-need-txt"   placeholder="请输入项目标题"></td>
                        </tr>
                        <tr>
                            <td>项目简介</td>
                            <td> <textarea   name="" id="content" class="publish-need-txt" cols="30" rows="10" minlength="30" maxlength="500"  placeholder="请输入项目描述30-500字">@if(!empty($info)) {{$info->brief}} @endif</textarea></td>
                        </tr>
                        <tr>
                            <td>提交BP</td>
                            <td><input type="hidden" name="hidden" value="123"><input type="file" name="bpurl" id="bpurl" value="" > &ensp;&ensp; <span style="color: #666;">提示：若文件过大请等待服务器响应再提交</span></td>
                        </tr>
                        <tr>
                            <td>请选择评议人</td>
                            <td><div class="business-level-wrapper">
                                    <div class="business-level">
                                        <a href="javascript:;" class="business-select">3 位</a>
                                        <ul class="business-level-list">
                                            <li>1 位</li>
                                            <li>2 位</li>
                                            <li>3 位</li>
                                            <li>4 位</li>
                                            <li>5 位</li>
                                        </ul>
                                    </div>
                                   {{-- <i class="iconfont icon-wenhao2 info-show"></i>--}}
                                    {{--<div class="info-show-content">
                                        普通：<br />发布后项目展示到升维网平台，所有升维网用户可以查看<br />
                                        VIP: <br />发布后项目发送到升维网后台，升维网筛选后精准对接到平台用户
                                    </div>--}}
                                </div></td>
                        </tr>
                        {{--<div><button class="test-btn publish-submit" type="button">提交</button></div>--}}
                    </table></form>
                    <div class="business-btn-wrapper"><button class="test-btn publish-submit" type="button">提交</button></div>
                </div>

            </div>
        </div>
    </div>

    <div id="payhtml" style="width: 400px;display: none;">
        <div class="single open-member">
            <div class="years" style="padding: 10px 0px 0px 20px;font-size: 16px;">
                <span id="needcontetn"></span>
            </div>

            <div class="cub"></div>
        </div>
        <div class="paytype payoff-way">
            <p>请选择支付方式：</p>
                    <span class="pay-opt focus been">
                        <input class="rad-inp" type="radio"  value="wx_pub_qr">
                        <div class="opt-label"><span></span><img class="way-img" src="{{asset('img/lweixin.png')}}"><em class="way-cap">微信支付</em></div>
                    </span>
                    <span class="pay-opt">
                        <input class="rad-inp" type="radio"  value="alipay_pc_direct">
                        <div class="opt-label"><span></span><img class="way-img" src="{{asset('img/lzhifubao.png')}}"><em class="way-cap">支付宝支付</em></div>
                    </span>
        </div>
        <div style="text-align: center;padding:10px 0 0 10px;"><button type="button" class="pop-btn vip" id="vip">付费</button></div>
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
    <div id="zhifubao" style="display: none;">
    	<p>请您在5分钟内尽快完成支付 后回到本页面点击完成支付即可</p>
    	<button class="button1" >完成支付</button>
    	<button class='button2' >去支付</button>
    </div>
    <style>
        .layer_notice {
            float: left;
            overflow: hidden;
            background: #5FB878;
            padding: 10px;
        }
        #needcontetn b{
            font-size:18px;
            color: #f00;
        }
        .layer_notice a {
            color: #fff;
        }

        #zhifubao {
        	width: 500px;
        	padding: 20px;
        }
        #zhifubao p{
        	margin: 20px;
        	font-size: 22px;
        }
        #zhifubao .button1{
        	border: 1px solid #ccc;
        	width: 200px;
        	height: 50px;
        	background: #1a2799;
        	color: #fff;
        	border-radius: 40px;
        	font-size: 18px;
        	margin-right: 30px;
        }
        #zhifubao .button2{
        	border: 1px solid #ccc;
        	width: 200px;
        	height: 50px;
        	background: #0e840e;
        	color: #fff;
        	font-size: 18px;
        	border-radius: 40px;
        }

        .layer_image {
            float: left;
            overflow: hidden;
            background: #1e8e8e;
            padding: 10px;
        }
        

        .layer_image a {

            float: left;
            margin: 0 5px;
        }
        .layer_image img {
            border: 2px solid #ccc;
            width: 100px;
            height: 100px;
            border-radius: 65px;
        }
        .layer_image span {
            color:#fff;
        }
        .changeWeixin img{
            margin:0 auto;
        }
    </style>
    {{--<ul class="layer_notice" style="display: none;">
        <li><a>近期，网监部门查敏感类信息比较严格，所以项目中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写项目。</a></li>
        <li><a>感谢您的合作</a></li>
        <li><a style="margin-left: 80%;">升维网</a></li>
    </ul>--}}
    <script type="text/javascript" src="{{url('/js/jquery.qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/pingpp2.js')}}"></script>
    <script type="text/javascript">
        $(function(){

            // 点击级别
            $(document).click(function(){
                $('.business-level-list').hide();
            })
            $('.business-select').click(function(event) {
                event.stopPropagation();
                $(this).next('ul').slideToggle();
            });
            $('.business-level-list li').click(function(event) {
                event.stopPropagation();
                var selHtml = $(this).html();
                $(this).parent().prev('a').html(selHtml);
                $(this).parent().hide();
            });
            /*var infoHtml1 = '发布后项目展示到升维网平台，所有升维网用户可查看';
            var infoHtml2 = '发布后项目发送到升维网后台，升维网筛选后精准对接到平台用户';*/
           /* $('.info-show').hover(function() {
                /!*if($('.business-select').html() === '普通'){
                 $('.info-show-content').html(infoHtml1).stop().fadeToggle();
                 }else{
                 $('.info-show-content').html(infoHtml2).stop().fadeToggle();
                 }*!/
                $('.info-show-content').stop().fadeToggle();
            });*/



            /*$('.publ-need-sel-def').click(function() {
             $(this).next('ul').stop().slideToggle();
             });*/
            $('.publish-need-list li').hover(function() {
                $(this).children('ul').stop().show();
            }, function() {
                $(this).children('ul').stop().hide();
            });

            $('.publ-sub-list li').click(function() {
                var publishHtml = $(this).html();
                $('.publ-need-sel-def').html(publishHtml);
                $('.publish-need-list').hide();
            });
        })
    </script>
    <script type="text/javascript">
        $(function(){

        	var objdata;

           /* layer.open({
                type: 1,
                shade: false,
                title: '尊敬的用户您好', //不显示标题
                content: $('.layer_notice'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){
                    layer.msg('感谢您的配合，请文明书写', {time: 1000, icon:6});
                }
            });*/

            $('.publ-need-sel-def').click(function() {
                $(this).next('ul').stop().slideToggle();
            });
            $('.publish-need-list li').hover(function() {
                $(this).children('ul').stop().show();
            }, function() {
                $(this).children('ul').stop().hide();
            });

            $('.publ-sub-list li').click(function() {
                var publishHtml = $(this).html();
                var parentHtml = $(this).parent().siblings('a').text();
                $('.publ-need-sel-def').html(parentHtml+'/'+publishHtml);
                $('.publish-need-list').hide();
            });

            $('.button1').on('click',function () {
				layer.closeAll();
				$.ajax({
                    url: "{{url('uct_myshow/addShow')}}",
                    data: objdata,
                    type: "Post",
                    dataType: "json",
                    cache: false,//上传文件无需缓存
                    processData: false,//用于对data参数进行序列化处理 这里必须false
                    contentType: false, //必须
                    success: function (data) {
                        if (data.icon == 1){
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                                window.location = '{{url('uct_myshow')}}';
                            });
                        } else if (data.icon == 2) {
                            //$obj.attr('disabled',false);
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {

                                window.location = window.location.href;

                            });
                        } else if(data.icon == 4){
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                                window.location = data.url;
                            });
                        } else if(data.icon == 5){
                            paymoney(data.code,data.userid);
                            $obj.html("提交");
                            $obj.attr('disabled',false);
                        }
                    },
                });
            });

            $('.publish-submit').on('click',function () {
                $.post('{{url('myneed/verifyputneed')}}',{'role':'企业'},function (data) {
                    if(data.type == 3){
                        layer.msg(data.msg,{'icon':data.icon});
                        return false;
                    } else if(data.type == 2){
                        layer.confirm(data.msg, {
                            btn: ['去认证','暂不需要'], //按钮
                            skin:'layui-layer-molv'
                        }, function(){
                            window.location.href=data.url;
                        }, function(){
                            layer.close();
                        });
                        return false;
                    } else if (data.type == 1){
                        layer.alert(data.msg,{'icon':data.icon});
                        return false;
                    } else {

                    }
                });
                $obj =  $(this);
                $obj.html("正在提交");
                $obj.attr('disabled',true);
                var showpeoples = $('.business-select').text();
                var content = $('#content').val();
                var bpurl = $('#bpurl').val();
                var title = $('#title').val();
                var domain = $.trim($('.publ-need-sel-def').text());
                if(domain=='请选择'){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请填写项目分类');
                    return false;
                }
                if(title == ''){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请填写项目标题');
                    return false;
                }
                if(content == ''){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请填写完整的项目描述');
                    return false;
                }
                if(content.length <= 30 || content.length >= 800){
                    $obj.attr('disabled',false);
                    $obj.html("提交");
                    layer.msg('请输入30-800字的提交描述');
                    return false;
                }

                if(bpurl == ''){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请上传项目BP');
                    return false;
                }

                var fileObj = document.getElementById("bpurl").files[0]; // js 获取文件对象

                var formFile = new FormData();
                formFile.append("showpeoples", showpeoples);
                formFile.append("content", content);
                formFile.append("domain", domain);
                formFile.append("file", fileObj); //加入文件对象
                formFile.append("title", title); //加入文件对象

                if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请选择正确的文件');
                    return false;
                }
                objdata = formFile;

                $.ajax({
                    url: "{{url('uct_myshow/addShow')}}",
                    data: formFile,
                    type: "Post",
                    dataType: "json",
                    cache: false,//上传文件无需缓存
                    processData: false,//用于对data参数进行序列化处理 这里必须false
                    contentType: false, //必须
                    success: function (data) {
                        if (data.icon == 1){
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                                window.location = '{{url('uct_myshow')}}';
                            });
                        } else if (data.icon == 2) {
                            //$obj.attr('disabled',false);
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {

                                window.location = window.location.href;

                            });
                        } else if(data.icon == 4){
                            layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                                window.location = data.url;
                            });
                        } else if(data.icon == 5){
                            paymoney(data.code,data.userid);
                            $obj.html("提交");
                            $obj.attr('disabled',false);
                        }
                    },
                });


            });

            function paymoney(numbers,userid)  {
                $('#vip').attr('userid',userid);
                $('#needcontetn').html('您选择了 <b id=needpeoples>'+numbers+'</b> 位资深专家为您评议<br />您一共需要支付'+numbers+'*89='+' <b id=needpaynumbers>'+numbers*89+'</b> 元');
                layer.open({
                    type: 1,
                    shade: 0.8,
                    title: '支付窗口', //不显示标题
                    area: ['400px', '350px'],
                    isOutAnim:2,
                    content: $('#payhtml'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                    cancel: function(){

                    }
                });
            }

            $('.icon-chahao').on('click',function () {
            	$('.layer-pop').css('display','none');
            });

            $("#vip").on("click",function(){
            	layer.closeAll();
                var payType;
                var userid;
                var channel;
                var amount;
                var showCount;
                var urlType=window.location.href;

                payType="payMoney";
               // var money=$("#needpaynumbers").text();
                var money=1;
                showCount=$("#needpeoples").text();
                amount=money;
                userid=$(this).attr('userid');
                $(".payoff-way").children().each(function(){
                    if($(this).hasClass('been')){
                        channel=$(this).children(":first").attr("value");
                    }
                });

                $.ajax({
                    url:"{{url('charge')}}",
                    data:{"payType":payType,"userid":userid,"channel":channel,"amount":amount,"type":"onlineshow","showCount":showCount,"urlType":urlType,'subject':'升维网项目评议'},
                    dateType:"json",
                    type:"POST",
                    success:function(res){
                        var charge =JSON.parse(res);

                      
						
                        console.log(charge);
                        $('#code').empty();
                        if(charge.credential.wx_pub_qr){
                            var qrcode = new QRCode('code', {
                                text: charge.credential.wx_pub_qr,
                                width: 200,
                                height: 200,
                                colorDark : '#000000',
                                colorLight : '#ffffff',
                                correctLevel : QRCode.CorrectLevel.H
                            });
                            console.log(qrcode);
                            if(channel=="wx_pub_qr"){
                                $('.poplayer').show();
                                $('.layer-pop').show();
                                $(".weixinTips").show();
                            }
                            return;
                        }
                         pingpp.setUrlReturnCallback(function (err, url) {
						 // 自行处理跳转或者另外打开支付页面地址(url)
						 $('.button2').attr('onclick','window.open(\''+url+'\')');

						 	layer.open({
			                    type: 1,
			                    shade: 0.8,
			                    title: false, //不显示标题
			                    isOutAnim:2,
			                    area: ['550px', '220px'],
			                    content: $('#zhifubao'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
			                    cancel: function(){

			                    }
			                });
						}, ['alipay_pc_direct', 'alipay_wap']);
						
                        pingpp.createPayment(charge, function(result, err){
                             console.log(result);
                             console.log(err.msg);
                             console.log(err.extra);
                            if (result == "success") {
                                // 只有微信公众账号 wx_pub 支付成功的结果会在这里返回，其他的支付结果都会跳转到 extra 中对应的 URL。
                                layer.alert('支付成功');
                            } else if (result == "fail") {
                                // charge 不正确或者微信公众账号支付失败时会在此处返回
                            } else if (result == "cancel") {
                                // 微信公众账号支付取消支付
                            }
                        });
                    }
                })

            })

        })


    </script>
@endsection