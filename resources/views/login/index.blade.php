@extends("layouts.master")
@section("content")
<!-- 登录 / start -->
<div class="section login-bg">
    <div class="container">
        <div class="user-box user-login-top">
            <h2 class="login-tit">用户登录</h2>
            <span class="login-en-tit">USER LOGIN</span>
            <p class="user-tel">
                <label><i class="iconfont icon-touxiang"></i></label><input type="text" placeholder="请输入手机号" class="user-tel-inp" />
            </p>
            <p class="user-pwd">
                <label><i class="iconfont icon-suo"></i></label><input type="password" placeholder="请输入密码" class="user-pwd-inp" />
            </p>
            <button type="button" class="login-btn">登 录</button>
            <div class="login-bottom">
                <span class="go">尚无账号，去 <a href="{{asset('register')}}" class="to-register">注册</a></span>
                <a href="{{asset('forget')}}" class="find">找回密码</a>
            </div>
        </div>
    </div>
</div>
<!-- 登录 / end -->
<script>
  $(".login-btn").on("click",function(){
      var reg1 = /^1[3578][0-9]{9}$/;//手机号
      var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
      var phone=$(".user-tel-inp").val();
      var passWord=$(".user-pwd-inp").val();
      if(!(reg1.test(phone))){
          layer.tips('手机号不能为空或输入错误', '.user-tel', {
              tips: [2, '#00a7ed'],
              time: 4000
          });
          return false;
      };
      if(!(reg2.test(passWord))){
          layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
              tips: [2, '#00a7ed'],
              time: 4000
          });
          return false;
      };
      $.ajax({
          url:"{{asset('loginHandle')}}",
          data:{"phone":phone,"passWord":passWord},
          dateType:"json",
          type:"POST",
          success:function(res){
              if(res['code']=="phone"){
                  layer.tips(res['msg'], '.user-tel', {
                      tips: [2, '#00a7ed'],
                      time: 4000
                  });
              }else if(res['code']=="pwd"){
                  layer.tips(res['msg'], '.user-pwd', {
                      tips: [2, '#00a7ed'],
                      time: 4000
                  });
              }else{
                  $.cookie("userId",res['userId'],{expires:7,path:'/',domain:'web_sheng.com'});
                  $.cookie("name",res['name'],{expires:7,path:'/',domain:'web_sheng.com'});
                  window.location.href="{{asset('/')}}"
              }
          }
      })

  })
</script>
@endsection