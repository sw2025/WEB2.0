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
                    <span class="change-tel-tit">更换手机号</span>
                  {{--  <p class="change-tel-tel">
                      <label><i class="iconfont icon-touxiang"></i></label><input type="text"  value='' class="" />
                    </p>--}}

                    <p class="change-tel-tel">
                        <label><i class="iconfont icon-touxiang"></i></label><input type="text" placeholder="请输入新手机号" id="phone" class="" />
                    </p>
                    <p class="change-tel-test clearfix">
                                <span class="change-tel-enter">
                                    <label><i class="iconfont icon-duanxinyanzhengma"></i></label>
                                    <input type="text" id="code" placeholder="请输入验证码" />
                                </span>
                        <input type="button" class="change-tel-get" id="getCode" value="获得验证码" style="margin-top:-36px;"/>
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

        $(function(){
            document.getElementById("getCode").onclick=function(){
                var obj = this;
                var phone=$("#phone").val();

                var reg1 = /^1[3578][0-9]{9}$/;//手机号
                var userId=$.cookie("userId");

                if(!(reg1.test(phone))){
                    layer.msg('手机号不能为空或输入错误', {
                        time: 2000
                    });
                    return false;
                };

                /*
                 time(this);
                 */
                verifyPhone(userId,obj)
            }

        })
        var verifyPhone=function(userId,obj){
            var newPhone=$("#phone").val();
            $.ajax({
                url:"{{asset('/getCode')}}",
                data:{"action":"change","phone":newPhone},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){
                        time(obj);
                        layer.tips(res['msg'], '.change-tel-get', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                    }else {
                        layer.tips(res['msg'], '.change-tel-get', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        return false;
                    }
                }
            })
        }
        $(".basic-btn").on("click",function(){
            var phone=$("#phone").val();
            var code=$("#code").val();
            var userId=$.cookie("userId");
            var reg1 = /^1[3578][0-9]{9}$/;//手机号
            if(!(reg1.test(phone))){
                layer.tips('手机号不能为空或输入错误', '.change-tel-tel', {
                    tips: [2, '#e25633'],
                    time: 3000
                });
                return false;
            };
            if(!code){
                layer.tips('验证码不能为空', '.change-tel-get', {
                    tips: [2, '#e25633'],
                    time: 3000
                });
                return false;
            }
            $.ajax({
                url:"{{asset('changeNewPhone')}}",
                data:{"phone":phone,"code":code},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){
                        layer.msg(res['msg'], {
                            time: 2000
                        },function () {
                            window.location = res.url;
                        });
                        return false;
                    }else if(res['code']=="code"){
                        layer.tips(res['msg'], '.change-tel-get', {
                            tips: [2, '#e25633'],
                            time: 3000
                        });
                        return false;
                    }
                }
            })
        })
    </script>
@endsection