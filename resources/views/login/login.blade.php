@extends("layouts.master")
@section("content")
    <!-- 登录 / start -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/login.css')}}">
    <script type="text/javascript" src="{{asset('js/reg.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.cookie.js')}}"></script>


<div class="section sw-bg"  onkeydown="autosubmit()">
        <div class="swcontainer">
            <div class="user-box user-login-top">
                <h2 class="login-tit">用户登录</h2>
                <span class="login-en-tit">USER LOGIN</span>
                <p class="user-tel">
                    <label><i class="iconfont icon-gerenzhongxin1"></i></label><input type="text" placeholder="请输入手机号" class="user-tel-inp" />
                </p>
                <p class="user-pwd">
                    <label><i class="iconfont icon-mima"></i></label><input type="password" placeholder="请输入密码" class="user-pwd-inp" />
                </p>
                <button type="button" class="login-btn">登 录</button>
                <div class="login-bottom">
                    <span class="go">尚无账号，去 <a href="{{url('/register')}}" class="to-register">注册</a></span>
                    <a href="{{url('/forget')}}" class="find">找回密码</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录 / end -->

<script>
    function autosubmit(){//事件触发函数
        if(event.keyCode==13){
            $(".login-btn").trigger("click");
        }
    }
    $(".login-btn").on("click",function(){
        var that=this;
        var reg1 = /^1[3578][0-9]{9}$/;//手机号
        var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
        var phone=$(".user-tel-inp").val();
        var passWord=$(".user-pwd-inp").val();
        if(!(reg1.test(phone))){
            layer.tips('手机号不能为空或输入错误', '.user-tel', {
                tips: [2, '#e25633'],
                time: 4000
            });
            return false;
        };
        if(!(reg2.test(passWord))){
            layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
                tips: [2, '#e25633'],
                time: 4000
            });
            return false;
        };
        $(this).attr('disabled',true);
        $(this).html('登录中...');
        $.ajax({
            url:"{{url('/loginHandle')}}",
            data:{"phone":phone,"passWord":passWord},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="phone"){
                    layer.tips(res['msg'], '.user-tel', {
                        tips: [2, '#e25633'],
                        time: 4000
                    });
                    $(that).removeAttr('disabled');
                    $(that).html('登录');
                }else if(res['code']=="pwd"){
                    $(that).removeAttr('disabled');
                    $(that).html('登录');
                    layer.tips(res['msg'], '.user-pwd', {
                        tips: [2, '#e25633'],
                        time: 4000
                    });
                }else{
                    var date = new Date();
                    date.setTime(date.getTime() + (120 * 60 * 1000));
                    $.cookie("userId",res['userId'],{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("userId",res['userId'],{expires:date,path:'/',domain:'swchina.com'});
                    $.cookie("name",res['name'],{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("name",res['name'],{expires:date,path:'/',domain:'swchina.com'});
                    $.cookie("role",res['role'],{expires:date,path:'/',domain:'sw2025.com'});
                    $.cookie("role",res['role'],{expires:date,path:'/',domain:'swchina.com'});
                    if({{$return}}){
                        window.location.href="{{$returnurl}}";
                    } else {
                        if(res['role']=="专家"){
                            window.location.href="{{asset('uct_mywork')}}";
                        }else{
                            window.location.href="{{asset('uct_works')}}";
                        }
                    }

                }
            }
        })

    })
</script>
@endsection