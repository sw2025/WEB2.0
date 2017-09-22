@extends("layouts.ucenter4")
@section("content")
        <div class="main">
            <!-- 更改手机号 / start -->
            <h3 class="main-top">基本资料</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="basic-source-changetel">
                        <span class="change-tel-tit">更换手机号</span>
                        <p class="change-tel-pwd">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" placeholder="请输入密码" class=""  id="passWord" />
                        </p>
                        <button type="button" class="basic-btn" id="basic-btn">下一步</button>
                    </div>
                </div>
            </div>
        </div>

<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        document.getElementById("basic-btn").onclick=function(){
            var obj = this;
            var oldPassWord=$("#passWord").val();
            var userId=$.cookie("userId");
            if(!oldPassWord){
                layer.tips('密码不能为空!', '.change-tel-pwd', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }

            $.ajax({
                url:"{{asset('inspectPwd')}}",
                data:{"userId":userId,"oldPassWord":oldPassWord},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success") {

                        window.location.href="{{asset('basic/changeTel2')}}"
                    }else{
                        layer.tips('原密码不正确', '.change-tel-pwd', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }
                }
            })
        }
    });
</script>
@endsection