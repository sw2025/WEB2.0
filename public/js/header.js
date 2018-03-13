$(function () {
    $('.sw-toggle-nav').on('click', function () {
        console.log(123);
        $('.sw-menu').stop().slideToggle('fast');
    })
    $('.sw-logined').hover(function () {
        $(this).next().stop().slideToggle();
    })
    $('.sw-entry').hover(function () {
        $(this).stop().slideToggle();
    })

    var flag = false; // 个人中心导航层默认false隐藏
    $('.sw-left-btn').click(function () {
        flag = !flag;
        if (flag){
            $('.sw-pop').show();
            $('.sw-aside').stop().animate({'left':'0'});
        }else {
            $('.sw-pop').hide();
            $('.sw-aside').stop().animate({'left':'-185px'});
        }

    })
    $('.sw-pop').click(function (e) {
        flag = false;
        $(this).hide();
        $('.sw-aside').animate({'left':'-185px'});
    })
})
