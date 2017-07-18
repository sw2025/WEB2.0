$(function(){
    // 尺寸变更导航切换
    $('.navbar-toggle').on('click', function(event) {
        event.preventDefault();
        $('.header .navbar-nav').toggleClass('in');
    });
    $('.nav li').click(function(event) {
        $(this).addClass('active').siblings().removeClass('active');
    });
    // 展开搜索框
    $('.search-cli').on('click', function(event) {
        event.preventDefault();
        $(this).hide();
        $('.search-sear').show();
    });
    // 搜索框下拉展示
    $('.select-showbox').on('click', function(event) {
        event.preventDefault();
        $('.select-option').animate({'left':0}, 400).show();
    });
    // 填充搜索框下拉值
    $('.select-option').on('click', 'li', function(event) {
        event.preventDefault();
        $(this).addClass('selected').siblings().removeClass('selected');
        var liHtml = $(this).html();
        $('.select-showbox span').html(liHtml);
        $('.select-option').hide();
        $('.search-text').attr('placeholder', liHtml);
    });
    // 首页幻灯轮播
    $('.banner ul li').eq(0).show();    
//*****
    var imgKey = 0;
    var lunbo = function(){
        $('.banner ul li').eq(imgKey).fadeOut();
        var bannerLen = $('.banner ul li').length - 1;
        imgKey++;
        if(imgKey > bannerLen){
            imgKey = 0;
        }
        $('.banner ol li').eq(imgKey).addClass('cur').siblings().removeClass('cur');
        $('.banner ul li').eq(imgKey).fadeIn();
    }
    var timer01 = null;
    timer01 = setInterval(lunbo,3000);
    
    $('.banner ol li').click(function(event) {
        var ind = $(this).index();
        $('.banner ul li').eq(ind).fadeIn().siblings().fadeOut();
        $(this).addClass('cur').siblings().removeClass('cur');
        imgKey = ind;
    });
    $('.banner').hover(function() {
        $('.leftBtn,.rightBtn').stop().fadeIn();
        clearInterval(timer01);
    }, function() {
        $('.leftBtn,.rightBtn').stop().fadeOut();
        timer01 = setInterval(lunbo,3000);
    });
    $('.rightBtn').click(function() {
        lunbo();
    });
    $('.leftBtn').click(function() {
        $('.banner ul li').eq(imgKey).fadeOut();
        imgKey--;
        if(imgKey < 0){
            imgKey = 3;
        }
        $('.banner ol li').eq(imgKey).addClass('cur').siblings().removeClass('cur');
        $('.banner ul li').eq(imgKey).fadeIn();
    });
//*******//
    //首页专家轮播
    var tabNum = 0;
    $('.fix-bg').hover(function(e) {
        $('.tab-leftbtn,.tab-rightbtn').stop().fadeIn();
    },function(){
        $('.tab-leftbtn,.tab-rightbtn').stop().fadeOut();
    });
    $('.tab-rightbtn').click(function(e) {
        tabNum++;
        if(tabNum > 2){
            tabNum = 0;
        }
        var move = tabNum * -100;
        $('.tab-con ul').stop().animate({'left':move + '%'},600)
    });
    
    $('.tab-leftbtn').click(function(e) {
        tabNum--;
        if(tabNum < 0){
            tabNum = 2;
        }
        var move = tabNum * -100;
        $('.tab-con ul').animate({'left': move + '%'},600);
    });
    // tab切换
    $('.tabar a').click(function() {
        $(this).addClass('current').siblings().removeClass('current');
    });
    
})