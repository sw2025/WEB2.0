@extends("layouts.master")
@section("content")
<!-- banner / start -->
<link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}" />
<div class="banner">
    <ul>
        <li class="img01"><div class="container"><span class="anim anim-left"></span><span class="anim anim-right"></span></div></li>
        <li class="img02"></li>
        <li class="img03"></li>
    </ul>
    <ol>
        <li class="cur"></li>
        <li></li>
        <li></li>
    </ol>
    <a href="javascript:;" class="leftBtn btn"><i class="iconfont icon-jiantou1"></i></a>
    <a href="javascript:;" class="rightBtn btn"><i class="iconfont icon-jiantou2"></i></a>
</div>
<!-- banner / end -->
<!-- section1 / start -->
<div class="section bg-white">
    <div class="container">
        <div class="supply-service-tit">升维网为企业提供的服务<span class="long-line"></span></div>
        <div class="supply-service-entit">SERVICE PROVIDED BY SHENGWEI FOR ENTERPRISES</div>
        <ul class="clearfix">
            <li class="item col-md-3"><a href="javascript:;">
                    <div class="item-con dif-hexagon1">
                        <span class="hexagon"><i class="iconfont icon-zhuanjia"></i></span>
                        <h2 class="number">01</h2>
                        <span class="item-tit">我要咨询</span>
                        <p class="item-desc">解决企业遇到各类问题</p>
                    </div>
                    <div class="item-con-hover">
                        <p>岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划，岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划</p>
                    </div>
                </a></li>
            <li class="item col-md-3"><a href="javascript:;">
                    <div class="item-con dif-hexagon2">
                        <span class="hexagon"><i class="iconfont icon-fangbianvideo"></i></span>
                        <h2 class="number">02</h2>
                        <span class="item-tit">我要开会</span>
                        <p class="item-desc">解决企业遇到各类问题</p>
                    </div>
                    <div class="item-con-hover">
                        <p>岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划，岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划</p>
                    </div>
                </a></li>
            <li class="item col-md-3"><a href="javascript:;">
                    <div class="item-con dif-hexagon3">
                        <span class="hexagon"><i class="iconfont icon-ziyuanku1"></i></span>
                        <h2 class="number">03</h2>
                        <span class="item-tit">我要办事</span>
                        <p class="item-desc">解决企业遇到各类问题</p>
                    </div>
                    <div class="item-con-hover">
                        <p>岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划，岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划</p>
                    </div>
                </a></li>
            <li class="item col-md-3"><a href="javascript:;">
                    <div class="item-con dif-hexagon4">
                        <span class="hexagon"><i class="iconfont icon-need"></i></span>
                        <h2 class="number">04</h2>
                        <span class="item-tit">发布信息</span>
                        <p class="item-desc">解决企业遇到各类问题</p>
                    </div>
                    <div class="item-con-hover">
                        <p>岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划，岁的法国红酒看，首先想到法国红酒岁的法国红酒sad法国红酒岁的法国红酒士大夫规划</p>
                    </div>
                </a></li>
        </ul>
        <div class="listbottom-link"><a href="javascript:;" class="become-expert homepage-link">入驻平台</a></div>
    </div>
</div>
<!-- section1 / end -->
<!-- section2 / start -->
<div class="section fix-bg">
    <div class="container">
        <div class="supply-service-tit supply-demand">专家资源库<span class="middle-line"></span></div>
        <div class="supply-service-entit">EXPERT RESOURCE BASE</div>
        <div class="more-box"><a href="{{asset('expert')}}" class="more">更多<i class="iconfont icon-rilijiantouyoushuang"></i></a></div>
        <div class="row tab-resources">
            <div class="tabar clearfix" id="knowExpert">
                <a href="javascript:;" class="tabar-opt">知名机构<div class="triangle-top"></div></a>
                <a href="javascript:;" class="tabar-opt">知名专家<div class="triangle-top"></div></a>
                <a href="javascript:;" class="tabar-opt">知名企业家<div class="triangle-top"></div></a>
            </div>
            <div class="tab-con">
                <ul class="tab-list clearfix" id="konwExpertList">

                </ul>
            </div>
            <div class="listbottom-link nomargin"><a href="javascript:;" class="become-expert homepage-link">成为专家</a></div>
        </div>
        <a href="javascript:;" class="tab-leftbtn"><i class="iconfont icon-jiantou1"></i></a>
        <a href="javascript:;" class="tab-rightbtn"><i class="iconfont icon-jiantou2"></i></a>
    </div>
</div>
<!-- section2 / end -->
<!-- section3 / start -->
<div class="section">
    <div class="container clearfix">
        <div class="supply-service-tit supply-demand">供求信息<span class="short-line"></span></div>
        <div class="supply-service-entit">SUPPLY AND DEMAND INFORMATION</div>
        <div class="row supply-categary clearfix">
            <div class="col-md-6">
                <div class="demands">
                    <h2 class="category">投融资<a href="{{asset('supply')}}" class="more">更多<i class="iconfont icon-rilijiantouyoushuang"></i></a></h2>
                    <ul class="demands-list">
                        @foreach($invests as $invest)
                        <li><i class="iconfont icon-jiantou"></i><a href="{{asset('supply/detail/'.$invest->needid)}}"><span class="dem-li-tit">{{$invest->brief}}</span><span class="dem-li-time"><i class="iconfont icon-shijian2"></i>{{$invest->created_at}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="demands">
                    <h2 class="category">战略合作<a href="{{asset('supply')}}" class="more">更多<i class="iconfont icon-rilijiantouyoushuang"></i></a></h2>
                    <ul class="demands-list">
                        @foreach($works as $work)
                        <li><i class="iconfont icon-jiantou"></i><a href="{{asset('supply/detail/'.$work->needid)}}"><span class="dem-li-tit">{{$work->brief}}</span><span class="dem-li-time"><i class="iconfont icon-shijian2"></i>{{$work->created_at}}</span></a></li>
                       @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="demands">
                    <h2 class="category">产品升级<a href="{{asset('supply')}}" class="more">更多<i class="iconfont icon-rilijiantouyoushuang"></i></a></h2>
                    <ul class="demands-list">
                        @foreach($products as $product)
                        <li><i class="iconfont icon-jiantou"></i><a href="{{asset('supply/detail/'.$product->needid)}}"><span class="dem-li-tit">{{$product->brief}}</span><span class="dem-li-time"><i class="iconfont icon-shijian2"></i>{{$product->created_at}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="demands">
                    <h2 class="category">市场运营<a href="{{asset('supply')}}" class="more">更多<i class="iconfont icon-rilijiantouyoushuang"></i></a></h2>
                    <ul class="demands-list">
                        @foreach($markets as $market)
                        <li><i class="iconfont icon-jiantou"></i><a href="{{asset('supply/detail/'.$market->needid)}}"><span class="dem-li-tit">{{$market->brief}}</span><span class="dem-li-time"><i class="iconfont icon-shijian2"></i>{{$market->created_at}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="listbottom-link"><a href="javascript:;" class="become-expert homepage-link">发布需求</a></div>
    </div>
</div>
<!-- section3 / end -->
<script>
    $(function(){
        var type=$("#knowExpert a:first-child").text();
        $("#knowExpert a:first-child").addClass("current")
        getType(type)
    })
    $("#knowExpert a").on("click",function(){
        $("#konwExpertList").empty();
        var expertType= $(this).text();
        getType(expertType);
    })
    var getType=function(type){
        $.ajax({
            url:"{{asset('returnData')}}",
            data:{"type":type},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    $.each(res['msg'],function(key,value){
                        var str=" <li class=''>";
                            str+="<a href='{{asset('expert/detail/')}}"+"/"+value.expertid+"'class='tab-list-link'>";
                            str+="<span class='ex-res-img'><img src='{{asset('img/avatar1.jpg')}}' /></span>";
                            str+="<div class='ex-res-con'>";
                            str+="<div class='triangle-bottom'></div>"
                            str+="<div class='ex-res-con-tit'>"
                            str+="<span class='expert-name'>"+value.expertname+"</span>"
                            str+="<span class='expert-consult'>视频咨询："+value.fee +"</span></div><div class='ex-res-con-desc'>"
                            str+="<span class='expert-field'><strong>擅长领域：</strong>"+value.domain1+"</span>"
                            str+="<p class='expert-field-desc'>"+value.brief+"</p>"
                            str+="</div> </div> </a><div class='ex-res-icon'>"
                            str+="<a href='javascript:;' class='review' id='"+value.expertid+"' onclick='toMessage(this)'><i class='iconfont icon-pinglun1'></i></a>"
                            if(value.collect==0){
                                str+="<a href='javascript:;' class='collect ' title='收藏' id='"+value.expertid+"' onclick='collect(this)'><i class='iconfont icon-likeo'></i></a> </div></li>";
                            }else{
                                str+="<a href='javascript:;' class='collect red ' title='已收藏' id='"+value.expertid+"' onclick='collect(this)'><i class='iconfont icon-likeo'></i></a> </div></li>";
                            }
                        $("#konwExpertList").append(str);
                    })
                }else{
                   /* $("#konwExpertList").text("暂无数据");*/
                }
            }

        })
    }
   function collect(e){
        var expertId=$(e).attr('id');
        var remark;
       if(!$.cookie("userId")){
           window.location.href="{{asset('login')}}"
           return false;
       }else{
           if($(e).attr('title') == '已收藏'){
               remark="0";
               collectHndle(expertId,remark);
               $(e).attr("title","收藏");
               $(e).removeClass('red');
           }else{
               remark="1";
               collectHndle(expertId,remark);
               $(e).attr("title","已收藏");
               $(e).addClass('red');
           }
       }
   }
    var collectHndle=function(expertId,remark){
            $.ajax({
                url:"{{asset('collectExpert')}}",
                data:{"remark":remark,"expertId":expertId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="error"){
                        alert("收藏失败!")
                        return false;
                    }
                }
            })
        }
    function toMessage(e){
        var expertId=$(e).attr('id');
        if(!$.cookie('userId')){
            window.location.href="{{asset('login')}}"
            return false;
        }else{
            window.location.href="{{asset('expert/detail')}}"+"/"+expertId;
        }
    }
</script>
@endsection