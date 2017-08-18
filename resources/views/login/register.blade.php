@extends("layouts.master")
@section("content")
<!-- 登录 / start -->
<div class="section login-bg">
    <div class="container">
        <div class="user-box user-register-top">
            <h2 class="login-tit">用户注册</h2>
            <span class="login-en-tit">USER REGISTRATION</span>
            <p class="user-tel">
                <label><i class="iconfont icon-touxiang"></i></label><input type="text" placeholder="请输入手机号" class="user-tel-inp" />
            </p>
            <p class="user-test clearfix">
                    <span class="user-test-enter"><label><i class="iconfont icon-duanxinyanzhengma"></i></label>
                    <input type="text" placeholder="短信验证码" class="user-test-inp" /></span>
                    <input type="button" class="get-test" id="getCode" value="获得验证码" />
            </p>
            <p class="user-pwd user-register-pwd">
                <label><i class="iconfont icon-suo"></i></label><input type="password" placeholder="请设置密码" class="user-pwd-inp" />
            </p>
            <div class="user-role">
                <label><i class="iconfont icon-role-setting"></i></label>
                <div class="user-role-opt"><a href="javascript:;">角色</a>
                    <span class="mutil-choice"><i class="iconfont icon-xiangxiajiantou"></i></span></div>
                <ul class="user-role-list">
                    <li>企业</li>
                    <li>专家</li>
                </ul>
            </div>
            <button type="button" class="login-btn">注 册</button>
            <div class="login-bottom">
                <a href="find.html" class="protocol">注册协议</a>
                <span class="go-login">已有账号，去 <a href="{{asset('login')}}" class="to-log">登录</a></span>
            </div>
        </div>
    </div>
</div>
<!-- 登录 / end -->
<script type="text/javascript">
    $(function(){
        // 获取验证码
        var wait=60;
        function time(o) {
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
                    tips: [2, '#00a7ed'],
                    time: 4000
                });
                    return false;
            }
            time(this);
            $.ajax({
                url:"{{asset('getCode')}}",
                data:{"phone":phone,"action":"register"},
                dataType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="code"){
                        layer.tips(res['msg'], '.get-test', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }else{
                        layer.tips(res['msg'], '.user-tel', {
                            tips: [2, '#00a7ed'],
                            time: 4000
                        });
                        return false;
                    }
                }
            })
        }
    })
    $(".login-btn").on("click",function(){
        var reg1 = /^1[3578][0-9]{9}$/;//手机号
        var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
        var phone=$(".user-tel-inp").val();
        var pwd=$(".user-pwd-inp").val();
        var code=$(".user-test-inp").val();
        var role=$(".user-role-opt a").html();
        if(!(reg1.test(phone))){
            layer.tips('手机号不能为空或输入错误', '.user-tel', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        };
        if(!(reg2.test(pwd))){
            layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        };
        if(!code){
            layer.tips('验证码不能为空!', '.user-test', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        if(role=="角色"){
            layer.tips('角色必选', '.user-role-opt', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        $.ajax({
            url:"{{asset('registerHandle')}}",
            data:{"phone":phone,"passWord":pwd,"codes":code,"role":role},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="phone"){
                    layer.tips(res['msg'], '.user-tel', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                }else if(res['code']=="code"){
                    layer.tips(res['msg'], '.user-test-inp', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                }else{
                    $.cookie('userId',res['userId'],{expires:7,path:'/',domain:'sw2025.com'});
                    $.cookie('name',res['name'],{expires:7,path:'/',domain:'sw2025.com'});
                    window.location.href="{{asset('login')}}"
                }
            }
        })
    })
</script>
@endsection