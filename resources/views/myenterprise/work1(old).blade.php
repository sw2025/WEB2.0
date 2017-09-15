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

                        <div class="publish-need-sel industrylist">
                            <span class="publ-need-sel-cap">问题行业</span>
                            <a href="javascript:;" class="publ-need-sel-def" id="select1">请选择</a>
                            <ul class="publish-need-list industry" style="display: none;z-index: 20">
                                <li><a href="javascript:;">IT|通信|电子|互联网</a></li>
                                <li><a href="javascript:;">金融业</a></li>
                                <li><a href="javascript:;">房地产|建筑业</a></li>
                                <li><a href="javascript:;">商业服务</a></li>
                                <li><a href="javascript:;">贸易|批发|零售|租赁业</a></li>
                                <li><a href="javascript:;">文体教育|工艺美术</a></li>
                                <li><a href="javascript:;">生产|加工|制造</a></li>
                                <li><a href="javascript:;">交通|运输|物流|仓储</a></li>
                                <li><a href="javascript:;">服务业</a></li>
                                <li><a href="javascript:;">文化|传媒|娱乐|体育</a></li>
                                <li><a href="javascript:;">能源|矿产|环保</a></li>
                                <li><a href="javascript:;">政府|非盈利机构</a></li>
                                <li><a href="javascript:;">农|林|牧|渔|其他</a></li>
                            </ul>
                        </div>

                        <div class="publish-need-sel">
                            <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def" id="select2">请选择</a>
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

                        <textarea name="" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述"></textarea>
                        <div class="uct-works-exp">
                            <span>专家</span>
                            <a href="javascript:;" class="system-btn active uct-works-btn" id="random" style="padding: 0 10px;">系统分配专家</a>
                            <a href="javascript:;" class="uct-works-btn" id="appoint">自选专家</a>
                        </div>
                        <div class="uct-works-expava">
                        </div>
                        <div class="uct-works-tips">
                            <b>提示</b><br />
                            线下谈判价钱
                            <p class="uct-works-tips-para light-color">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
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
    .layer_notice a {
        color: #fff;
    }
</style>
<ul class="layer_notice" style="display: none;">
    <li><a>近期，网监部门查敏感类信息比较严格，所以内容中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写办事内容。</a></li>
    <li><a>感谢您的合作</a></li>
    <li><a style="margin-left: 80%;">升维网</a></li>
</ul>
<script type="text/javascript">
    $(function(){
        layer.open({
            type: 1,
            shade: false,
            title: '尊敬的用户您好', //不显示标题
            content: $('.layer_notice'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
        });

        $('.industrylist .industry li').on('click',function () {
            $('.industrylist').children('a').text($(this).children('a').text());
            $('.industrylist ul').css('display','none');
        });

        if($.cookie("domain")!="请选择"){
            $(".publ-need-sel-def").text($.cookie("domain"));
        }
        if($.cookie("describe")){
            $(".uct-works-txt").val($.cookie("describe"));
        }
        console.log($.cookie('domain'));
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
            if($('#select1').text().trim() == '请选择' || $('#select2').text().trim() == '请选择'){
                layer.msg('请选择问题分类和问题行业');
                return false;
            }
            var date = new Date();
            date.setTime(date.getTime() + (120 * 60 * 1000));
            $(this).addClass('active').siblings().removeClass('active');
            var text=$(this).text().trim();
            if(text=="系统分配专家"){
                $(".uct-works-expava").hide();
            }else{
                if($.cookie('reselect')){
                    var selected=$.cookie('reselect').split(",");
                    if(selected.length==5){
                        $(".uct-works-expava").show();
                    }else{
                        var domains=$(".publ-need-sel-def").text();
                        var describes=$(".uct-works-txt").val();
                        $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                        window.location.href="{{asset('uct_works/reselect')}}"
                    }
                }else{
                    var domains=$(".publ-need-sel-def").text();
                    var describes=$(".uct-works-txt").val();
                    $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('uct_works/reselect')}}"
                }
            }
        });
    })
    $(".submit-audit").on("click",function(){
        var that=this;
        var domain=$(".publ-need-sel-def").text();
        var describe=$(".uct-works-txt").val();
        var isAppoint=($.cookie("isAppoint"))?$.cookie("isAppoint"):1;
        var expertIds= $("input[name='expertId[]']").map(function(){return $(this).val()}).get().join(",");
        if($("#random").hasClass('active')){
            var state=1;
        }else{
            var state=0;
        }
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
                if(res['code']=="success"){
                    $.cookie("reselect","",{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("domain","",{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("describe","",{expires:date,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('uct_works')}}";
                }else{
                    $(".publ-need-sel-def").text(domain);
                    $(".uct-works-txt").val(describe);
                    layer.confirm('申请失败,请重新申请', {
                        btn: ['确定'] //按钮
                    });
                    $(that).removeAttr('disabled');
                    $(that).html('提交审核');
                }
            }
        })

    })
</script>
@endsection