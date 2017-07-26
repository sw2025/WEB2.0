@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 更改手机号 / start -->
            <h3 class="main-top">基本资料</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="basic-source-changetel">
                        <span class="change-tel-tit">更换密码</span>
                        请输入新密码
                        <p class="change-tel-pwd passWord">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" name="passWord" id="passWord" placeholder="请输入新密码" class="" />
                        </p>
                        请再次输入密码
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
        var passWord=$("#passWord").val();
        var replayWord=$("#replayWord").val();
        if(!passWord){
            layer.tips("密码不能为空", '.passWord', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(!replayWord){
            layer.tips("确认密码不能为空", '.replayWord', {
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
                if(res['code']=="success"){
                    $.cookie("userId",'',{expires:7,path:'/',domain:'sw2025.com'});
                    $.cookie("name",'',{expires:7,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('login')}}"
                }else{
                    layer.msg("密码修改失败")
                }
            }
        })

    })
</script>
@endsection