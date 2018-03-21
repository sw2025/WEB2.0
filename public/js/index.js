    $('.sw-banner ul li').eq(0).show();
    var imgKey = 0;
    var bannerLen = $('.sw-banner ul li').length - 1;
    var lunbo = function(){
        $('.sw-banner ul li').eq(imgKey).fadeOut();
        imgKey++;
        if(imgKey > bannerLen){
            imgKey = 0;
        }
        $('.sw-banner ol li').eq(imgKey).addClass('cur').siblings().removeClass('cur');
        $('.sw-banner ul li').eq(imgKey).fadeIn();
    }
    var timer01 = null;
    timer01 = setInterval(lunbo,8000);

    $('.sw-banner ol li').click(function(event) {
        var ind = $(this).index();
        $('.sw-banner ul li').eq(ind).fadeIn().siblings().fadeOut();
        $(this).addClass('cur').siblings().removeClass('cur');
        imgKey = ind;
    });
    $('.sw-banner').hover(function() {
        $('.leftBtn,.rightBtn').stop().fadeIn();
        clearInterval(timer01);
    }, function() {
        $('.leftBtn,.rightBtn').stop().fadeOut();
        timer01 = setInterval(lunbo,8000);
    });
    $('.rightBtn').click(function() {
        lunbo();
    });
    $('.leftBtn').click(function() {
        $('.sw-banner ul li').eq(imgKey).fadeOut();
        imgKey--;
        if(imgKey < 0){
            imgKey = bannerLen;
        }
        $('.sw-banner ol li').eq(imgKey).addClass('cur').siblings().removeClass('cur');
        $('.sw-banner ul li').eq(imgKey).fadeIn();
    });
