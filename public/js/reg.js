$(document).ready(function(){
    // 正则验证start================失去焦点
    var reg1 = /^1[3578][0-9]{9}$/;//手机号
    var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
    /*   $('.user-tel-inp').blur(function(event) {
           if(!(reg1.test($(this).val()))){
               layer.tips('手机号不能为空或输入错误', '.user-tel', {
                   tips: [2, '#e25633'],
                   time: 4000
               });
           }
       });*/
    $('.user-pwd-inp').blur(function(event) {
        if(!(reg2.test($(this).val()))){
            layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
                tips: [2, '#e25633'],
                time: 4000
            });
        }
    });

    // 正则验证end================失去焦点
    // 注册角色
    $('.user-role-opt').on('click', function() {
        $('.user-role-list').stop().slideToggle();
    });
    $('.user-role-list').on('click', 'li', function() {
        var roleLi = $(this).html();
        $('.user-role-opt a').html(roleLi);
        $('.user-role-list').hide();
    });
});