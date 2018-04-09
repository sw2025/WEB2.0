@extends("layouts.master")
@section("content")
    <!-- 登录 / start -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/login.css')}}">
    <script type="text/javascript" src="{{asset('js/reg.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/payJudge.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery/jquery.qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/pingpp.js')}}"></script>
    <style>

        .changeWeixin img{
            margin:0 auto;
        }
    </style>

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
                    <span class="go">尚无账号，去 <a href="javascript:;" class="to-register switchtype">注册</a></span>
                    <a href="{{url('/forget')}}" class="find">找回密码</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 登录 / end -->
<div class="layer-pop" style="position:fixed;background: rgba(0,0,0,0.3);top: 0;left: 0;width: 100%;height: 100%;z-index: 19891016;display: none;">
    <div class="popWx" style="position: absolute;top: 10%;width: 285px;border: 2px solid #ccc;left: 50%;top: 50%;margin: -160px 0 0 -145px;background: #fff;text-align: center;border-radius: 3px;font-size: 14px;padding: 30px 0 27px;">
        <div class="changeWeixin">
            <div class="popWeixin" id="code">
            </div>
        </div>
        <span class="weixinLittle"></span>
        <div class="weixinTips" style="display: none"><strong>扫瞄二维码完成支付</strong><br>支付完成后请关闭二维码</div>
        <a href="javascript:;" class="closePop" title="关闭" style="position: absolute;top: 0;right: 0;"><i class="iconfont icon-chahao"></i></a>
    </div>
</div>
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
        var type="{{$type}}";
        var id= "{{$id}}";
        if(!(reg1.test(phone))){
            layer.tips('手机号不能为空或输入错误', '.user-tel', {
                tips: [2, '#61498f'],
                time: 4000
            });
            return false;
        };
        if(!(reg2.test(passWord))){
            layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
                tips: [2, '#61498f'],
                time: 4000
            });
            return false;
        };
        $(this).attr('disabled',true);
        $(this).html('登录中...');
        $.ajax({
            url:"{{url('/loginHandle')}}",
            data:{"phone":phone,"passWord":passWord,'id':parseInt(id),'type':type},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="phone"){
                    layer.tips(res['msg'], '.user-tel', {
                        tips: [2, '#61498f'],
                        time: 4000
                    });
                    $(that).removeAttr('disabled');
                    $(that).html('登录');
                }else if(res['code']=="pwd"){
                    $(that).removeAttr('disabled');
                    $(that).html('登录');
                    layer.tips(res['msg'], '.user-pwd', {
                        tips: [2, '#61498f'],
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
                    if(type!='' && id!=''){

                        if(res.data.icon==2){
                            layer.msg(res.data.msg,function () {
                                window.location.href="/";
                                return false;
                            });
                        } else {
                            if($.trim(type)=='Submit'){
                                window.location = '/keep'+type+'/'+id;
                            } else {
                                callPingPay(res.data.data);
                                $(that).html('登录完成,请支付');
                                $('.closePop').on('click',function () {
                                    window.location = '/keep'+type+'/'+id;
                                });
                            }

                        }
                    } else {
                        if({{$return}}){
                            window.location.href="{{$returnurl}}";
                        } else {
                            window.location.href="/";
                            /*if(res['role']=="专家"){
                                window.location.href="{{asset('uct_mywork')}}";
                            }else{
                                window.location.href="{{asset('uct_works')}}";
                            }*/
                        }
                    }


                }
            }
        })

    })
</script>
@endsection