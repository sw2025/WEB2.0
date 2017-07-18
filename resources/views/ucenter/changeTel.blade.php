@extends("layouts.ucenter")
@section("content")
    <div class="main">
            <h3 class="main-top">基本资料</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="basic-source-changetel">
                        <span class="change-tel-tit">更换手机号</span>
                        <p class="change-tel-pwd">
                            <label><i class="iconfont icon-suo"></i></label><input type="password" placeholder="请输入密码" class="" />
                        </p>
                        <p class="change-tel-test clearfix">
                                <span class="change-tel-enter">
                                    <label><i class="iconfont icon-duanxinyanzhengma"></i></label>
                                    <input type="text" placeholder="请输入验证码" />
                                </span>
                            <input type="button" class="change-tel-get" id="getCode" value="获得验证码" />
                        </p>
                        <button type="button" class="basic-btn">下一步</button>
                    </div>
                </div>
            </div>
        </div>
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
        document.getElementById("getCode").onclick=function(){time(this);}

    })
</script>
@endsection