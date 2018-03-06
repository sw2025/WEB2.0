@extends("layouts.master")
@section("content")
<link type="text/css" rel="stylesheet" href="{{asset('css/login.css')}}">
<script type="text/javascript" src="{{asset('js/reg.js')}}"></script>
    <!-- 登录 / start -->
    <div class="section sw-bg">
        <div class="swcontainer">
            <div class="user-box user-login-top">
                <h2 class="login-tit">找回密码</h2>
                <span class="login-en-tit">RETRIEVE PASSWORD</span>
                <p class="user-tel">
                    <label><i class="iconfont icon-gerenzhongxin1"></i></label><input type="text" placeholder="请输入手机号" class="user-tel-inp" />
                </p>
                <p class="user-test clearfix">
                    <span class="user-test-enter"><label><i class="iconfont icon-duanxinapptuisongmoban"></i></label>
                    <input type="text" placeholder="短信验证码" class="user-test-inp" /></span>
                    <input type="button" class="get-test" id="getCode" value="获得验证码" />
                </p>
                <p class="user-pwd">
                    <label><i class="iconfont icon-mima"></i></label><input type="password" placeholder="请设置密码" class="user-pwd-inp" />
                </p>
                <button type="button" class="login-btn">设 置</button>
                
            </div>
        </div>
    </div>
    <!-- 登录 / end -->

<script>
    $(function(){
        // 获取验证码
        var wait=60;
        function time() {
            var o = document.getElementById("getCode");
            if (wait == 0) {
                o.removeAttribute("disabled");
                o.value="获得验证码";
                wait = 60;
            }else{
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
            var phone= $(".user-tel-inp").val();
            if(!phone){
                layer.tips('手机号不能为空', '.user-tel', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            }
            $.ajax({
                url:"{{asset('getCode')}}",
                data:{"phone":phone,"action":"findPwd"},
                dataType:"json",
                type:"POST",
                success:function(res){
                    if(res['type']=="code"){
                        layer.tips(res['msg'], '.get-test', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        return false;
                    }else if(res['code']=="phone"){
                        layer.tips(res['msg'], '.user-tel', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        return false;
                    }else{
                        $(this).attr('disabled',true);
                        time();
                    }
                }
            })
        }
    })
    $(".login-btn").on("click",function(){
        var that=this;
        var phone=$(".user-tel-inp").val();
        var code=$(".user-test-inp").val();
        var passWord=$(".user-pwd-inp").val();
        $(this).attr('disabled',true);
        $(this).html('正在设置');
        $.ajax({
            url:"{{asset('forgetHandle')}}",
            data:{"phone":phone,"code":code,"passWord":passWord},
            dateType:"json",
            type:"POST",
            success:function(res){
                switch(res['code']){
                    case "code":
                        layer.tips(res['msg'], '.user-test-inp', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        $(that).removeAttr('disabled');
                        $(that).html('设置');
                        break;
                    case "phone":
                        layer.tips(res['msg'], '.user-tel', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        $(that).removeAttr('disabled');
                        $(that).html('设置');
                        break;
                    case "success":
                        window.location.href="{{asset('login')}}"
                        break;
                }
            }
        })
    })
</script>
@endsection

