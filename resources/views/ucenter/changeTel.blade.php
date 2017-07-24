@extends("layouts.ucenter")
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
                        <p class="change-tel-test clearfix">
                                <span class="change-tel-enter">
                                    <label><i class="iconfont icon-duanxinyanzhengma"></i></label>
                                    <input type="text" placeholder="请输入验证码" id="code" />
                                </span>
                            <input type="button" class="change-tel-get" id="getCode" value="获得验证码" />
                        </p>
                        <button type="button" class="basic-btn" id="basic-btn">下一步</button>
                    </div>
                </div>
            </div>
        </div>

<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){
        // 获取验证码
        var wait=60;
        function time(o) {
            if (wait == 0) {
                o.removeAttribute("disabled");
                o.value="获得验证码";
                wait = 60;
            } else {
                o.setAttribute("disabled", true);
                o.value= wait + "秒";
                wait--;
                setTimeout(function() {
                            time(o)
                        },
                        1000)
            }
        }
        document.getElementById("getCode").onclick=function(){
            var passWord=$("#passWord").val();
            var userId=$.cookie("userId");
            if(!passWord){
                layer.tips('密码不能为空!', '.change-tel-pwd', {
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                return false;
            }
            time(this);
            verifyCode(userId);
        }
    })
    var verifyCode=function(userId){
        $.ajax({
            url:"{{asset('getcodes')}}",
            data:{"userId":userId,"action":"forget"},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="code"){
                    layer.tips(res['msg'], '.change-tel-get', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                    return false;
                }
            }
        })
    }
    $("#basic-btn").on("click",function(){
        window.location.href="{{asset('uct_basic/changeTel2')}}"
       /* var code=$("#code").val();
        var passWord=$("#passWord").val();
        var userId=$.cookie("userId");
        if(!passWord){
            layer.tips('密码不能为空!', '.change-tel-pwd', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(!code){
            layer.tips('验证码不能为空', '.change-tel-get', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        $.ajax({
            url:"{{asset('returnCode')}}",
            data:{"code":code,"userId":userId},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="code"){
                    layer.tips(res['msg'], '.change-tel-get', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                    return false;
                }else{
                    window.location.href="{{asset('uct_basic/changeTel2')}}"
                }
            }
        })*/
    })
</script>
@endsection