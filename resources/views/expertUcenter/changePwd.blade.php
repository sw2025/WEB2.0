@extends("layouts.ucenter4")
@section("content")
<div class="main">
            <!-- 更改手机号 / start -->
            <h3 class="main-top">基本资料</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="basic-source-changetel">
                        <span class="change-tel-tit">更换密码</span>
                        <p class="change-tel-pwd oldPassWord">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" name="oldPassWord" id="oldPassWord" placeholder="请输入原密码" class="" />
                        </p>
                        <p class="change-tel-pwd passWord">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" name="passWord" id="passWord" placeholder="请输入新密码" class="" />
                        </p>
                        <p class="change-tel-pwd replayWord">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" id="replayWord" placeholder="请再次输入密码" class="" />
                        </p>
                        <button type="button" class="basic-btn">确定</button>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(".basic-btn").on("click",function(){
        var userId=$.cookie("userId");
        var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
        var passWord=$("#passWord").val();
        var replayWord=$("#replayWord").val();
        var oldPassWord = $("#oldPassWord").val();
        if(!(reg2.test(oldPassWord))){
            layer.tips("密码只能是6-18位的数字或者字母", '.oldPassWord', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }

        $.ajax({
            url:"{{asset('inspectPwd')}}",
            data:{"oldPassWord":oldPassWord,"userId":userId},
            dateType:"json",
            "type":"POST",
            success:function(res){
                if(res['code']=="success"){
                    if(!(reg2.test(passWord))){
                        layer.tips("密码只能是6-18位的数字或者字母", '.passWord', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }
                    if(!(reg2.test(replayWord))){
                        layer.tips("密码只能是6-18位的数字或者字母", '.replayWord', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }
                    if(passWord!=replayWord){
                        layer.tips("两次输入密码不一致，重新输入", '.replayWord', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }
                    $.ajax({
                        url:"{{asset('updatePwd')}}",
                        data:{"passWord":passWord,"userId":userId},
                        dateType:"json",
                        "type":"POST",
                        success:function(res){
                            var date = new Date();
                            date.setTime(date.getTime() + (120 * 60 * 1000));
                            if(res['code']=="success"){
                                layer.msg("密码修改成功",function () {
                                    window.location = '{{url('/basic')}}';
                                })
                            }else{
                                layer.msg("密码修改失败")
                            }
                        }
                    })
                }else{
                    layer.tips("原密码不正确", '.oldPassWord', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                    return false;
                }
            }
        })
    })
</script>
@endsection