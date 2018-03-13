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
                    <span class="change-tel-tit">更换密码</span>
                    <p class="change-tel-pwd oldPassWord">
                        <label><i class="iconfont icon-suo"></i></label><input type="password" name="oldPassWord" id="oldPassWord" placeholder="请输入原密码" class="" />
                    </p>
                    <p class="change-tel-pwd passWord">
                        <label><i class="iconfont icon-suo"></i></label><input type="password" name="passWord" id="passWord" placeholder="请输入新密码" class="" />
                    </p>
                    <p class="change-tel-pwd replayWord">
                        <label><i class="iconfont icon-suo"></i></label><input type="password" id="replayWord" placeholder="请再次输入新密码" class="" />
                    </p>

                    <button type="button" class="basic-btn">保存</button>
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

        $(".basic-btn").on("click",function(){
            var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
            var passWord=$("#passWord").val();
            var replayWord=$("#replayWord").val();
            var oldPassWord = $("#oldPassWord").val();
            if( !(reg2.test(oldPassWord)))
            {
                layer.tips("密码只能是6-18位的数字或者字母", '.oldPassWord', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            }
            if(!(reg2.test(passWord))){
                layer.tips("密码只能是6-18位的数字或者字母", '.passWord', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            }

            if(passWord!=replayWord){
                layer.tips("两次输入密码不一致，重新输入", '.replayWord', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            }
            $.ajax({
                url:"{{asset('updatePwd')}}",
                data:{"oldPassWord":oldPassWord,"passWord":passWord},
                dateType:"json",
                "type":"POST",
                success:function(res){
                    if(res['code']=="success"){
                        layer.msg("修改成功", {
                            time: 3000
                        },function () {
                            window.location = res.url;
                        });
                    }else if(res['code']=="error"){
                        layer.tips("原密码不正确", '.oldPassWord', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        return false;
                    }else{
                        layer.msg("修改失败", {
                            time: 4000
                        });
                        return false;
                    }
                }
            })
        })
    </script>
@endsection