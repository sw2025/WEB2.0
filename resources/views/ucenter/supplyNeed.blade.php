@extends("layouts.ucenter")
@section("content")
    <link rel="stylesheet" href="{{asset('css/events.css')}}">
    <link rel="stylesheet" href="{{asset('css/publishneed.css')}}">
    <div class="main">
        <!-- 发布需求 / start -->
        <h3 class="main-top">发布商情</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step">
                    <span class="green-circle">1</span>提交商情
                </div>
                <div class="publish-need">
                    <div class="publish-tips"><p style="color: #007fff;">提示：当前您是以企业的身份发布的商情，请确定完成企业认证后发布。<a href="javascript:;" onclick="putneed('专家')">点此以专家身份发布商情</a></p>
                    </div>
                @if(!empty($info))
                        <input type="hidden" id="refuseid" value="{{$info->needid}}">
                        <p class="wrong-reason"><span class="wrong-reason-col">拒绝原因：</span><span class="wrong-reason-col">{{$info->error}}</span></p>
                    @endif
                    <table class="invite-table">
                        <tr>
                            <td>商情分类</td>
                            <td>
                                <div class="publish-need-sel">
                                    {{--  <span class="publ-need-sel-cap">商情分类</span>--}}<a href="javascript:;" class="publ-need-sel-def">@if(!empty($info)) {{$info->domain1}}/{{$info->domain2}} @else 请选择 @endif</a>
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
                            <td>商情描述</td>
                            <td> <textarea   name="" id="content" class="publish-need-txt" cols="30" rows="10" minlength="30" maxlength="500"  placeholder="请输入商情描述30-500字">@if(!empty($info)) {{$info->brief}} @endif</textarea></td>
                        </tr>
                        <tr>
                            <td>商情级别</td>
                            <td><div class="business-level-wrapper">
                                    <div class="business-level">
                                        <a href="javascript:;" class="business-select">普通</a>
                                        <ul class="business-level-list">
                                            <li>普通</li>
                                            <li>VIP</li>
                                        </ul>
                                    </div>
                                    <i class="iconfont icon-wenhao2 info-show"></i>
                                    <div class="info-show-content">
                                        普通：<br />发布后商情展示到升维网平台，所有升维网用户可以查看<br />
                                        VIP: <br />发布后商情发送到升维网后台，升维网筛选后精准对接到平台用户
                                    </div>
                                </div></td>
                        </tr>
                        {{--<div><button class="test-btn publish-submit" type="button">提交</button></div>--}}
                    </table>
                    <div class="business-btn-wrapper"><button class="test-btn publish-submit" type="button">提交</button></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .layer_notice {
            float: left;
            overflow: hidden;
            background: #5FB878;
            padding: 10px;
        }
        .layer_notice a {
            color: #fff;
        }
    </style>
    <ul class="layer_notice" style="display: none;">
        <li><a>近期，网监部门查敏感类信息比较严格，所以商情中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写商情。</a></li>
        <li><a>感谢您的合作</a></li>
        <li><a style="margin-left: 80%;">升维网</a></li>
    </ul>
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
            var infoHtml1 = '发布后商情展示到升维网平台，所有升维网用户可查看';
            var infoHtml2 = '发布后商情发送到升维网后台，升维网筛选后精准对接到平台用户';
            $('.info-show').hover(function() {
                /*if($('.business-select').html() === '普通'){
                 $('.info-show-content').html(infoHtml1).stop().fadeToggle();
                 }else{
                 $('.info-show-content').html(infoHtml2).stop().fadeToggle();
                 }*/
                $('.info-show-content').stop().fadeToggle();
            });



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



            layer.open({
                type: 1,
                shade: false,
                title: '尊敬的用户您好', //不显示标题
                content: $('.layer_notice'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){
                    layer.msg('感谢您的配合，请文明书写', {time: 1000, icon:6});
                }
            });

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

            $('.publish-submit').on('click',function () {
                $obj =  $(this);
                $obj.html("正在提交");
                $obj.attr('disabled',true);
                var needlevel = $('.business-select').text();
                var content = $('#content').val();
                var domain = $.trim($('.publ-need-sel-def').text());
                if(domain=='请选择'){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请填写商情分类');
                    return false;
                }
                if(content == ''){
                    $obj.html("提交");
                    $obj.attr('disabled',false);
                    layer.msg('请填写完整的商情描述');
                    return false;
                }
                if(content.length <= 30 || content.length >= 500){
                    $obj.attr('disabled',false);
                    $obj.html("提交");
                    layer.msg('请输入30-500字的提交描述');
                    return false;
                }
                $.post('{{url('uct_myneed/addNeed')}}',{'needlevel':needlevel,'role':'企业','content':content,'domain':domain,'needid':$('#refuseid').val()},function (data) {
                    if (data.icon == 1){
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            window.location = '{{url('uct_myneed')}}';
                        });
                    } else {
                        //$obj.attr('disabled',false);
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            if(typeof(data.needid)=="undefined"){
                                window.location = window.location.href;
                            } else {
                                window.location = '{{url('uct_myneed/supplyNeed')}}'+'/'+data.needid;
                            }
                        });
                    }
                });
            });

        })

        function putneed (type){
            $.post('{{url('myneed/verifyputneed')}}',{'role':type},function (data) {
                if(data.type == 3){
                    layer.msg(data.msg,{'icon':data.icon});
                } else if(data.type == 2){
                    layer.confirm(data.msg, {
                        btn: ['去认证','暂不需要'], //按钮
                        skin:'layui-layer-molv'
                    }, function(){
                        window.location.href=data.url;
                    }, function(){
                        layer.close();
                    });
                } else if (data.type == 1){
                    layer.alert(data.msg,{'icon':data.icon});
                } else {
                    window.location = '{{asset('myneed/supplyNeed')}}';

                }
            });

        }
    </script>
@endsection