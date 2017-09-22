@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/laydate/laydate.js')}}"></script>
    <div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">企业办事服务</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <div class="publish-need uct-works">
                    <div class="expert-certy-state">
                        <span class="uct-works-icon"><i class="iconfont icon-shenqing"></i></span>
                                <span class="expert-certy-blue">
                                    <em>办事申请</em>IS APPLYING
                                </span>
                    </div>

                    {{--<div class="datas-sel mt20" style="margin-top: 20px;z-index: 5">
                        <span class="datas-sel-cap padd12">问题行业</span>
                        <a href="javascript:;" class="datas-sel-def" id="industrys" >请选择</a>
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
                    </div>--}}

                    <div class="publish-need-sel zindex3" style="margin-top: 20px;">
                        <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def" id="select1">请选择</a>
                        <ul class="publish-need-list" style="display: none;">
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
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <textarea name="" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述" ></textarea>
                    <div class="uct-works-exp">
                        <span>专家</span>
                        <a href="javascript:;" class="system-btn uct-works-btn" id="random" style="padding:0 10px;">系统分配专家</a>
                        <a href="javascript:;" class="uct-works-btn" id="appoint">指定专家</a>
                    </div>
                    <div class="uct-works-expava">
                    </div>
                    <div class="uct-works-tips">
                        <b>提示</b><br />
                        尊敬的用户您好
                        <p class="uct-works-tips-para light-color">近期，网监部门查敏感类信息比较严格，所以内容中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写办事内容。</p>
                    </div>
                    <div class="uct-works-con">
                        <button class="test-btn submit-audit" type="button">提交审核</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .layer_notice {
            float: left;
            overflow: hidden;
            background: #1e8e8e;
            padding: 10px;
        }
        .layer_image {
            float: left;
            overflow: hidden;
            background: #1e8e8e;
            padding: 10px;
        }
        .layer_notice a {
            color: #fff;
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
    </style>
    <ul class="layer_notice" style="display: none;">
        <li><a>近期，网监部门查敏感类信息比较严格，所以内容中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写办事内容。</a></li>
        <li><a>感谢您的合作</a></li>
        <li><a style="margin-left: 80%;">升维网</a></li>
    </ul>
    <ul class="layer_image" style="display: none;">
        <li>
        </li>
    </ul>
    <script type="text/javascript">
        $(function(){

           /* layer.open({
                type: 1,
                shade: false,
                title: '尊敬的用户您好', //不显示标题
                content: $('.layer_notice'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
            });*/
            $('.datas-sel-def').click(function () {
                $(this).next('ul').stop().slideToggle();
                $(this).parent().siblings().children('ul').hide();
            });
            $('.datas-list li').click(function () {
                var publishHtml = $(this).html();
                $(this).parent().prev('.datas-sel-def').html(publishHtml);
                $(this).parent().hide();
            });
            if($.cookie("domain")!="请选择" && $.cookie("domain") != ''){
                $(".publ-need-sel-def").text($.cookie("domain"));
            }
            /*if($.cookie("industry")!="请选择" && $.cookie("industry") != ''){
                $("#industrys").text($.cookie("industry"));
            }*/
            if($.cookie("describe")){
                $(".uct-works-txt").val($.cookie("describe"));
            }
            if($.cookie("reselect")){
                $(".uct-works-expava").show();
                var expertChecked=$.cookie('reselect').split(",");
                for(var i=0; i<expertChecked.length; i++) {
                    var checked=expertChecked[i];
                    var end=checked.indexOf("/");
                    var id=checked.substring(0,end);
                    var img=checked.substring(end);
                    var str="<input type='hidden' name=expertId[] value="+id+"><img src={{env('ImagePath')}}"+img+" class='uct-works-exp-img' id="+id+" />"
                    $(".uct-works-expava").append(str);
                }
                $("#appoint").addClass('active');
                $("#random").removeClass('active')
            }
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

            $('.uct-works-exp a').click(function(event) {
                if($('#select1').text().trim() == '请选择'/* || $('#industrys').text().trim() == '请选择'*/){
                    layer.msg('请选择问题分类');
                    return false;
                }
                var date = new Date();
                date.setTime(date.getTime() + (120 * 60 * 1000));
                $(this).addClass('active').siblings().removeClass('active');
                var text=$(this).text().trim();
                if(text=="系统分配专家"){
                    layer.msg('系统为您检索专家中', {
                        icon: 16
                        ,shade: 0.01
                    });
                    $(".uct-works-expava").hide();
                    $(".submit-audit").attr('disabled',true);
                    $(".submit-audit").css('background-color','#ccc');
                    $.post('{{url('matchingexpert')}}',{'domain':$('#select1').text().trim()},function (data) {
                        if(data.type == 4){
                            layer.msg(data.msg,{'icon':2},function () {
                                window.location.href="/"
                            });
                        } else if (data.type == 1){
                            layer.alert(data.msg,{'title':'尊敬的用户您好'});
                            $(".submit-audit").attr('disabled',false);
                            $(".submit-audit").css('background-color','#ed0021');
                        } else if (data.type == 2){
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['500px', '260px'],
                                shadeClose: false, //开启遮罩关闭
                                content: '<div style="padding:10px;">'+data.msg+'</div>',
                                btn: ['自选专家','继续操作','重新办事'],
                                yes: function(index, layero){
                                    if($.cookie('reselect')){
                                        var selected=$.cookie('reselect').split(",");
                                        if(selected.length==5){
                                            $(".uct-works-expava").show();
                                        }else{
                                            var domains=$(".publ-need-sel-def").text().trim();
                                            /*var industry=$("#industrys").text().trim();*/
                                            var describes=$(".uct-works-txt").val();
                                            $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                                           /* $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                                            $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                                            window.location.href="{{asset('uct_works/reselect')}}"
                                        }
                                    }else{
                                        var domains=$(".publ-need-sel-def").text().trim();
                                        /*var industry=$("#industrys").text().trim();*/
                                        var describes=$(".uct-works-txt").val();
                                        $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                                       /* $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                                        $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                                        window.location.href="{{asset('uct_works/reselect')}}";
                                    }
                                },btn2: function(index, layero){
                                    $(".submit-audit").attr('disabled',false);
                                    $(".submit-audit").css('background-color','#ed0021');
                                    layer.close(index);


                                    //按钮【按钮二】的回调
                                },btn3: function(index, layero){
                                    $.cookie("reselect","",{expires:date,path:'/',domain:'sw2025.com'});
                                    $.cookie("domain","",{expires:date,path:'/',domain:'sw2025.com'});
                                    $.cookie("describe","",{expires:date,path:'/',domain:'sw2025.com'});
                                   /* $.cookie("industry","",{expires:date,path:'/',domain:'sw2025.com'});*/
                                    window.location.href="{{url('uct_works/applyWork')}}";

                                    //按钮【按钮三】的回调
                                }
                            });

                        } else if (data.type == 3){
                            layer.confirm(data.msg, {
                                btn: ['自选专家','取消该办事'] //按钮
                            }, function(){
                                if($.cookie('reselect')){
                                    var selected=$.cookie('reselect').split(",");
                                    if(selected.length==5){
                                        $(".uct-works-expava").show();
                                    }else{
                                        var domains=$(".publ-need-sel-def").text().trim();
                                        /*var industry=$("#industrys").text().trim();*/
                                        var describes=$(".uct-works-txt").val();
                                        $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                                       /* $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                                        $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                                        window.location.href="{{asset('uct_works/reselect')}}"
                                        return false;
                                    }
                                }else{
                                    var domains=$(".publ-need-sel-def").text().trim();
                                    /*var industry=$("#industrys").text().trim();*/
                                    var describes=$(".uct-works-txt").val();
                                    $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                                    /*$.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                                    $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});

                                    window.location.href="{{asset('uct_works/reselect')}}"  ;

                                    return false;
                                }
                            }, function(){
                                $.cookie("reselect","",{expires:date,path:'/',domain:'sw2025.com'});
                                $.cookie("domain","",{expires:date,path:'/',domain:'sw2025.com'});
                                $.cookie("describe","",{expires:date,path:'/',domain:'sw2025.com'});
                               /* $.cookie("industry","",{expires:date,path:'/',domain:'sw2025.com'});*/
                                window.location.href="{{url('uct_works/applyWork')}}"
                                return false;

                            });
                        }
                    });
                }else{
                    if($.cookie('reselect')){
                        var selected=$.cookie('reselect').split(",");
                        if(selected.length==5){
                            $(".uct-works-expava").show();
                        }else{
                            var domains=$(".publ-need-sel-def").text().trim();
                           /* var industry=$("#industrys").text().trim();*/
                            var describes=$(".uct-works-txt").val();
                            $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                           /* $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                            $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                            window.location.href="{{asset('uct_works/reselect')}}"
                        }
                    }else{
                        var domains=$(".publ-need-sel-def").text().trim();
                       /* var industry=$("#industrys").text().trim();*/
                        var describes=$(".uct-works-txt").val();
                        $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                        /*$.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});*/
                        $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                        window.location.href="{{asset('uct_works/reselect')}}"
                    }
                }
            });
        })
        $(".submit-audit").on("click",function(){
            var that=this;
            var domain=$(".publ-need-sel-def").text().trim();
           /* var industry=$("#industrys").text().trim();*/
            var describe=$(".uct-works-txt").val();
            var isAppoint=($.cookie("isAppoint"))?$.cookie("isAppoint"):1;
            var expertIds= $("input[name='expertId[]']").map(function(){return $(this).val()}).get().join(",");
            if(describe.length>30 && describe.length<500){
            }else{
                $(this).attr('disabled',false);
                $(this).html('提交认证');
                layer.msg('企业简介字数不符',{'icon':5});
                return false;
            }
            if($("#random").hasClass('active')){
                var state=1;
            }else{
                var state=0;
            }
           /* if(industry=="请选择"){
                layer.tips("问题行业不能为空", '.datas-sel-def', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }*/

            if(domain=="请选择"){
                layer.tips("问题分类不能为空", '.publ-need-sel-def', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }

            if(!describe){
                layer.tips("问题描述不能为空", '.uct-works-txt', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }
            if(!$('.uct-works-exp a').hasClass('active')){
                layer.tips("请选择系统匹配还是自选专家", '.uct-works-exp', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }
            $(this).attr('disabled',true);
            $(this).html('正在提交');
            $.ajax({
                url:"{{asset('saveEvent')}}",
                data:{"domain":domain,"describe":describe,"isAppoint":isAppoint,"expertIds":expertIds,"state":state},
                dateType:"json",
                type:"POST",
                success:function(res){
                    var date = new Date();
                    date.setTime(date.getTime() + (120 * 60 * 1000));
                    if(res['icon'] == 1){
                        $.cookie("reselect","",{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("domain","",{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("describe","",{expires:date,path:'/',domain:'sw2025.com'});
                        /*$.cookie("industry","",{expires:date,path:'/',domain:'sw2025.com'});*/
                        if(state == 0){
                            layer.msg(res.msg,{'icon':6},function () {
                                window.location = '{{url('uct_works')}}';
                            });
                        } else {
                            var str = '';
                            var obj = res.expertsinfo;
                            for(var i=0;i<obj.length;i++){
                                str += '<a href={{url("expert/detail")}}/'+obj[i]['expertid']+' target="_blank"><img src="{{env('ImagePath')}}'+obj[i]['showimage']+'"><span>'+obj[i]['expertname']+'</span></a>';
                            }
                            $('.layer_image li').append(str);
                            layer.open({
                                type: 1,
                                shade: false,
                                area: ['695px', '210px'], //宽高
                                title: res.msg+',以下的是专家的相关信息', //不显示标题
                                content: $('.layer_image'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                                cancel: function(){
                                    window.location = '{{url('uct_works')}}';
                                }
                            });
                        }

                    }else{
                        $(".publ-need-sel-def").text(domain);
                        /*$("#industrys").text(describe);*/
                        $(".uct-works-txt").val(describe);
                        layer.alert(res.msg+' 申请失败,请重新申请', {
                            btn: ['确定'] //按钮
                        },function () {
                            window.location.href=window.location.href;
                        });
                    }
                }
            })

        })
    </script>
@endsection