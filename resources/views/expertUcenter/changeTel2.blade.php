@extends("layouts.ucenter4")
@section("content")
<div class="main">
            <!-- 更改手机号 / start -->
            <h3 class="main-top">基本资料</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="basic-source-changetel">
                        <span class="change-tel-tit">更换手机号</span>
                        <p class="change-tel-tel">
                            <label><i class="iconfont icon-touxiang"></i></label><input type="text" placeholder="请输入新手机号" id="phone" class="" />
                        </p>
                        <p class="change-tel-test clearfix">
                                <span class="change-tel-enter">
                                    <label><i class="iconfont icon-duanxinyanzhengma"></i></label>
                                    <input type="text" id="code" placeholder="请输入验证码" />
                                </span>
                            <input type="button" class="change-tel-get" id="getCode" value="获得验证码" />
                        </p>
                        <button type="button" class="basic-btn">完成</button>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
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
                layer.tips('手机号不能为空或输入错误', '.', {
                    tips: [2, '#00a7ed'],
                    time: 4000
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
            url:"{{asset('getcodes')}}",
            data:{"userId":userId,"action":"change2","newPhone":newPhone},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="success"){
                    time(obj);
                    layer.tips(res['msg'], '.change-tel-get', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                }else {
                    layer.tips(res['msg'], '.change-tel-get', {
                        tips: [2, '#00a7ed'],
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
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        };
        if(!code){
            layer.tips('验证码不能为空', '.change-tel-get', {
                tips: [2, '#00a7ed'],
                time: 4000
            });
            return false;
        }
        $.ajax({
            url:"{{asset('changeNewPhone')}}",
            data:{"phone":phone,"code":code,"userId":userId},
            dateType:"json",
            type:"POST",
            success:function(res){
                if(res['code']=="phone"){
                    layer.tips(res['msg'], '.change-tel-tel', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                    return false;
                }else if(res['code']=="code"){
                    layer.tips(res['msg'], '.change-tel-get', {
                        tips: [2, '#00a7ed'],
                        time: 4000
                    });
                    return false;
                }else{
                    $.cookie("userId",'',{expires:7,path:'/',domain:'web_sheng.com'});
                    $.cookie("name",'',{expires:7,path:'/',domain:'web_sheng.com'});
                    window.location.href="{{asset('login')}}"
                }
            }
        })
    })
</script>
@endsection