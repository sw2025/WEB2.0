 @extends("layouts.ucenter4")
@section("content")
    <style type="text/css">

        .business-level-wrapper{width: 352px;margin: 10px auto 0;font-size: 0;text-align: left;position: relative;}
        .business-level{display: inline-block;vertical-align: top;position: relative;width: 280px;font-size: 14px;border: 1px solid #ccc;border-radius: 3px;height: 34px;line-height: 34px;}
        .business-level-wrapper .icon-wenhao2{display: inline-block;vertical-align: top;font-size: 26px;cursor: pointer;margin-left: 3px;color:#00a7ed;width: 48px;overflow: hidden;}
        .business-select{position: relative;display: block;position: relative;margin-left: 108px;color: #666;text-decoration: none;}
        .business-select:before{position: absolute;right: 10px;top: 2px;content:"\ea81";font-family: 'iconfont';}
        .business-level-list{background: #fff;position: absolute;top: 36px;left: 0;text-align: center;width: 100%;box-shadow: 0 0 8px #ccc;border: 1px solid rgba(0, 0, 0, 0.15);display: none;}
        .business-level-list li:hover{cursor: pointer;background:#f8f8f8;}
        .info-show-content{position: absolute;right: -165px;top: 40px;width:385px;line-height: 16px;font-size: 12px;width: 180px;display: none;color:#ed1600;}
        .business-btn-wrapper{padding-top: 30px;}
    </style>
    <div class="main">
        <!-- 发布需求 / start -->
        <h3 class="main-top">发布商情</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step">
                    <span class="green-circle">1</span>提交商情
                </div>
                <div class="publish-need">
                    <div style="margin-top: 10px;"><p style="color: #007fff;">提示：当前您是以专家的身份发布的商情，请确定完成专家认证后发布。<a href="javascript:;" onclick="putneed('企业')">点此以企业身份发布商情</a></p>
                    </div>
                    @if(!empty($info))
                        <input type="hidden" id="refuseid" value="{{$info->needid}}">
                        <p class="wrong-reason" style="text-align:left;width:350px;margin:0 auto;padding-top:30px;"><span style="color: #e3643d">拒绝原因：</span><span style="color: #e3643d">{{$info->error}}</span></p>
                    @endif
                    <div class="publish-need-sel">
                        <span class="publ-need-sel-cap">商情分类</span><a href="javascript:;" class="publ-need-sel-def">@if(!empty($info)) {{$info->domain1}}/{{$info->domain2}} @else 请选择 @endif</a>
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
                    <div>
                        <textarea   name="" id="content" class="publish-need-txt new-txt" cols="30" rows="10" minlength="30" maxlength="500"  placeholder="请输入商情描述30-500字">@if(!empty($info)) {{$info->brief}} @endif</textarea>

                        <div class="business-level-wrapper">
                            <div class="business-level">
                                <span class="publ-need-sel-cap">商情级别</span>
                                <a href="javascript:;" class="business-select">普通</a>
                                <ul class="business-level-list">
                                    <li>普通</li>
                                    <li>VIP</li>
                                </ul>
                            </div>
                            <i class="iconfont icon-wenhao2 info-show"></i>
                            <div class="info-show-content">
                                普通：发布后商情展示到升维网平台，所有升维网用户可以查看<br />
                                VIP: 发布后商情发送到升维网后台，升维网筛选后精准对接到平台用户
                            </div>
                        </div>
                        <div class="business-btn-wrapper"><button class="test-btn publish-submit" type="button">提交</button></div>
                    </div>
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
                $obj.attr('disabled',true);
                var content = $('#content').val();
                var domain =  $('.publ-need-sel-def').text();
                var needlevel = $('.business-select').text();
                if(content == '' || domain == '请选择'){
                    $obj.attr('disabled',false);
                    layer.msg('请填写完整的需求描述');
                    return false;
                }
                if(content.length <= 30 || content.length >= 500){
                    $obj.attr('disabled',false);
                    layer.msg('请输入30-500字的需求描述');
                    return false;
                }
                $.post('{{url('uct_myneed/addNeed')}}',{'needlevel':needlevel,'role':'专家','content':content,'domain':domain,'needid':$('#refuseid').val()},function (data) {
                    if (data.icon == 1){
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            window.location = '{{url('myneed')}}';
                        });
                    } else {
                        //$obj.attr('disabled',false);
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            if(typeof(data.needid)=="undefined"){
                                window.location = window.location.href;
                            } else {
                                window.location = '{{url('myneed/supplyNeed')}}'+'/'+data.needid;
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
                    window.location = '{{asset('uct_myneed/supplyNeed')}}';

                }
            });

        }
    </script>
@endsection