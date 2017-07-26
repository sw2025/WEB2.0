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
    // 首页幻灯轮播start
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
    // 首页幻灯轮播end
//*******//
    //==================首页专家轮播start
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
    //==================首页专家轮播end
    // 专家tab切换
    $('.tabar a').click(function() {
        $(this).addClass('current').siblings().removeClass('current');
    });
// ==================about 收藏start
    // 列表收藏
    $('.collect').click(function(event) {
        if($(this).attr('title').trim() == '已收藏'){
            $(this).attr("title","收藏");
            $(this).removeClass('red');
            fnc_collect($(this).attr('index'),'cancel',this);
        }else{
            $(this).attr("title","已收藏");
            $(this).addClass('red');
            fnc_collect($(this).attr('index'),'collect',this);
        }
    });
    // 详情收藏
    $('.collect-state').click(function(event) {
        if($(this).html() == '已收藏'){
            $(this).html('收藏');
            $(this).removeClass('done');
            fnc_collect($(this).attr('index'),'cancel',this);
        }else{
            $(this).html('已收藏');
            $(this).addClass('done');
            fnc_collect($(this).attr('index'),'collect',this);
        }
    });
// ==================about 收藏end
// 个人中心=======》我的消息start
    $('.myinfo-check-label').on('click','input', function() {
        $(this).parent().toggleClass('ischecked');
    });
    // 展开我的消息详情
    $('.myinfo-td').on('click', function() {
        $(this).addClass('been-read');
        $(this).children('.td-tips').html('已读');
        $(this).parent().next('.myinfo-row-details').slideToggle();
    });
    // 全选
    $('.check-all').on('click', function() {
        $('.myinfo-check-label').addClass('ischecked');
        $('.myinfo-check-label input').prop('checked', true);
    });
    // 标记为已读
    $('.read').on('click', function() {
        var checkNum = $('.ischecked').length;
        // alert(checkNum)
        if(checkNum > 0){
            $('.ischecked').next('.myinfo-td').addClass('been-read');
            $('.ischecked').next('.myinfo-td').children('.td-tips').html('已读');
        }else{
            layer.msg('未选中任何信息');
        }
    });
    // 删除
    $('.delete').on('click', function() {
        var checkNum = $('.ischecked').length;
        // alert(checkNum)
        if(checkNum > 0){
            $('.ischecked').closest('li').remove();
        }else{
            layer.msg('未选中任何信息');
        }
    });
// 个人中心=======》我的消息end
// 个人中心=======》充值金额start
    $('.recharge-sum .recharge-opt').click(function(event) {
        var $this = $(this);
        $this.addClass('focus').siblings().removeClass('focus');
        $this.children('input').prop('checked', true);
        $this.siblings().children('input').prop('checked', false);
        if($this.hasClass('others')){
            $('.recharge-inp-sum').removeAttr('readonly');
        }else{
            $('.recharge-inp-sum').attr('readonly','readonly');
        }
    });
    $('.recharge-way .recharge-opt').click(function(event) {
        $(this).addClass('focus').siblings().removeClass('focus');
        $(this).children('input').prop('checked', true);
        $(this).siblings().children('input').prop('checked', false);
    });
// 个人中心=======》充值金额end
// 个人中心=======》充值提现start
    $('.uploaded-img').hover(function() {
        $(this).children('span').stop().fadeIn();
    }, function() {
        $(this).children('span').stop().fadeOut();
    });
$('.money-cate-def').click(function() {
        $(this).next().stop().slideToggle();
    });

    $('.money-cate-list li').click(function() {
        var liHtml = $(this).html();
        $('.money-cate-def').html(liHtml);
        $(this).parent().hide();
    });
// 个人中心=======》充值提现end
// // 兼容placeholder
            // jQuery('[placeholder]').focus(function() {
            //     var input = jQuery(this);
            //     if (input.val() == input.attr('placeholder')) {
            //         input.val('');
            //         input.removeClass('placeholder');
            //     }
            // }).blur(function() {
            //     var input = jQuery(this);
            //     if (input.val() == '' || input.val() == input.attr('placeholder')) {
            //         input.addClass('placeholder');
            //         input.val(input.attr('placeholder'));
            //     }
            // }).blur().parents('form').submit(function() {
            //     jQuery(this).find('[placeholder]').each(function() {
            //         var input = jQuery(this);
            //         if (input.val() == input.attr('placeholder')) {
            //           input.val('');
            //         }
            //     })
            // });
// 个人中心=======》我的需求和专家资源start
    $('.three-icon').on('click', '.icon-row', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
// 个人中心=======》我的需求和专家资源end

// 
})