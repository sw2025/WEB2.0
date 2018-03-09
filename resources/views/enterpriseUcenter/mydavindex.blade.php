@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>



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
    <div class="swcontainer sw-ucenter">
        <!-- 个人中心左侧 -->
        @include('layouts.entucenter')
    <!-- 个人中心主体 -->
    <div class="sw-mains">
        <ul class="sw-white-style">
            <li class="sw-white-item">
                <div class="img-wrapper">
                    <img src="img/person1.jpg" class="sw-expert-img">
                    <a href="javascript:;" class="sw-connect-btn">联系投资人</a>
                </div>
                <div class="content-wrapper">
                    <strong class="sw-meet-name">专家名字</strong>
                    <div class="sw-meet-label">
                        <a href="javacript:;">天使投资</a>
                        <a href="javacript:;">A轮</a>
                    </div>
                    <p class="sw-meet-desc">
                        十年深厚的管理咨询经验。北京交通大学d管理学博士并在德国科隆CTC中心进行管理深造，曾担某纺织机械公司副总经理，在人力资源管理以及企业管理模式有较为深入的研究，咨询辅导的企业上百家，并为中石油、国家开发投资公司、鲁能集团、保利集团、中国铁路工程总公司。
                    </p>
                </div>
                <div class="sw-meet-time"><span>约见时间：</span>2018.3.12</div>
                <span class="sw-meet-state">已约见</span>
            </li>
        </ul>
    </div>
</div>
@endsection