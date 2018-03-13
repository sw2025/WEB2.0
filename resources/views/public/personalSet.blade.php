@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/meet.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/ucenter.css')}}" />


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
    <!-- 个人中心主体 -->
    <div class="sw-mains" style="margin-left: 0px;border: none;">

        <h3 class="main-top" style="font-size: 25px;font-weight: normal;text-align: center;">基本资料</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="basic-source">
                    <p class="basic-tel basic-row clearfix">
                        <label for="">手机号：</label>
                        <span>{{$data->phone}}</span>
                        <a href="{{asset('changeTel')}}" class="change-btn" style="blackground-color:#e25633">更换</a>
                    </p>
                    <br/>
                    <p class="basic-pwd basic-row clearfix">
                        <label for="">密<em></em>码：</label>
                        <span>******</span>
                        <a href="{{asset('changePwd')}}" class="change-btn">修改</a>
                    </p>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $('.contact').on('click',function () {
            var e = $(this).attr('index');
            $('.contact').html(e);
        })

    </script>
@endsection