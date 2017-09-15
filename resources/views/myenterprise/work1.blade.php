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
                        <div class="publish-need-sel zindex3">
                            <span class="publ-need-sel-cap">问题分类</span><a href="javascript:;" class="publ-need-sel-def">请选择</a>
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
                        <div class="datas-sel mt20">
                            <span class="datas-sel-cap padd12">所在行业</span>
                            <a href="javascript:;" class="datas-sel-def" id="industrys">请选择</a>
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
                        <textarea name="" class="publish-need-txt uct-works-txt" cols="30" rows="10" placeholder="请输入办事描述"></textarea>
                        <div class="uct-works-exp">
                            <span>专家</span>
                            <a href="javascript:;" class="system-btn active uct-works-btn" id="random">系统分配</a>
                            <a href="javascript:;" class="uct-works-btn" id="appoint">指定专家</a>
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

<script type="text/javascript">
    $(function(){
        $('.datas-sel-def').click(function () {
            $(this).next('ul').stop().slideToggle();
            $(this).parent().siblings().children('ul').hide();
        });
        $('.datas-list li').click(function () {
            var publishHtml = $(this).html();
            $(this).parent().prev('.datas-sel-def').html(publishHtml);
            $(this).parent().hide();
        });
        if($.cookie("domain")!="请选择"){
            $(".publ-need-sel-def").text($.cookie("domain"));
        }
        if($.cookie("industry")!="请选择"){
            $("#industrys").text($.cookie("industry"));
        }
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
            var date = new Date();
            date.setTime(date.getTime() + (120 * 60 * 1000));
            $(this).addClass('active').siblings().removeClass('active');
            var text=$(this).text();
            if(text=="系统分配"){
                $(".uct-works-expava").hide();
            }else{
                if($.cookie('reselect')){
                    var selected=$.cookie('reselect').split(",");
                    if(selected.length==5){
                        $(".uct-works-expava").show();
                    }else{
                        var domains=$(".publ-need-sel-def").text();
                        var industry=$("#industrys").text();
                        var describes=$(".uct-works-txt").val();
                        $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                        window.location.href="{{asset('uct_works/reselect')}}"
                    }
                }else{
                    var domains=$(".publ-need-sel-def").text();
                    var industry=$("#industrys").text();
                    var describes=$(".uct-works-txt").val();
                    $.cookie("domain",domains,{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("industry",industry,{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("describe",describes,{expires:date,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('uct_works/reselect')}}"
                }
            }
        });
    })
    $(".submit-audit").on("click",function(){
        var that=this;
        var domain=$(".publ-need-sel-def").text();
        var industry=$("#industrys").text();
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
        if(industry=="请选择"){
            layer.tips("擅长行业不能为空", '.datas-sel-def', {
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
            data:{"domain":domain,"describe":describe,"isAppoint":isAppoint,"expertIds":expertIds,"state":state,"industry":industry},
            dateType:"json",
            type:"POST",
            success:function(res){
                var date = new Date();
                date.setTime(date.getTime() + (120 * 60 * 1000));
                if(res['code']=="success"){
                    $.cookie("reselect","",{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("domain","",{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("describe","",{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("industry","",{expires:date,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('uct_works')}}";
                }else{
                    $(".publ-need-sel-def").text(domain);
                    $("#industrys").text(describe);
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