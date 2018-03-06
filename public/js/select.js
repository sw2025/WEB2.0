$(document).ready(function(){
    /*$('.checkbox-wrapper').click(function(){
      $(this).toggleClass('nocheck');
    })*/
    
    $('.serve-field-list-deft').on('click', function(event) {
        $(this).next('ul').animate({'left':'-5px'},  50).slideToggle(50);
        $(this).parent().siblings().children('ul').hide().css('left', '-20px');
    });

    // 选择服务领域2017-07-24
    $('.serve-field-list-show').on('click', 'li', function(event) {
        $('.serve-all').removeClass('active');
        var serveLi = $(this).html();
        var parentname=$(this).parent().siblings().html();
        var field = parentname+'/'+serveLi;
        $('.serve-field-list-deft').css('color','#333');
        $(this).parent().prev('a').css('color','#e25633');
        $(this).parent().hide().css('left', '-20px');
        $('.all-results-field').remove();
        $('.all-results').append('<a href="javascript:;" class="all-results-field all-results-opt">'+ field +'</a>');
    });

    // 选择专家
    $('.experts-classify').on('click', 'a', function(event) {
        $(this).addClass('active').siblings().removeClass('active');
        var cliHtml = $(this).html();
        $('.all-results-expert').remove();
        $('.all-results').append('<a href="javascript:;" class="all-results-expert all-results-opt">'+ cliHtml +'</a>');
    });
    // 选择视频
    $('.video-consult').on('click', 'a', function(event) {
        $(this).addClass('active').siblings().removeClass('active');
        var cliHtml = $(this).html();
        $('.all-results-video').remove();
        $('.all-results').append('<a href="javascript:;" class="all-results-video all-results-opt">'+ cliHtml +'</a>');
    });
    // 选择地区
    $('.location').on('click', 'a', function(event) {
        $(this).addClass('active').siblings().removeClass('active');
        var cliHtml = $(this).html();
        $('.all-results-location').remove();
        $('.all-results').append('<a href="javascript:;" class="all-results-location all-results-opt">'+ cliHtml +'</a>');
    });

    // vip
    $('#vipneed').on('click', function(event) {
        $(this).attr('index',1);
        $('.all-results').append('<a href="javascript:;" class="all-results-vip all-results-opt">'+ 'VIP商情' +'</a>');
    });
    // 删除
    $('.all-results').on('click', '.all-results-opt', function(event) {
        $(this).remove();
        if($(this).hasClass('all-results-expert')){
            $('.experts-classify a:first').addClass('active').siblings().removeClass('active');
        }
        else if($(this).hasClass('all-results-video')){
            $('.video-consult a:first').addClass('active').siblings().removeClass('active');
        }
        else if($(this).hasClass('all-results-location')){
            $('.location a:first').addClass('active').siblings().removeClass('active');
        }else if($(this).hasClass('all-results-trace')){
            $('.my-trace a:first').addClass('active').siblings().removeClass('active');
        }else{
            $('.serve-all').addClass('active');
        }
    });
    // v2========2017-08-30
    // 选择收藏留言
    // $('.my-trace').on('click', 'a', function(event) {
    //     $(this).addClass('active').siblings().removeClass('active');
    //     var cliHtml = $(this).html();
    //     $('.all-results-trace').remove();
    //     $('.all-results').append('<a href="javascript:;" class="all-results-trace all-results-opt">'+ cliHtml +'</a>');
    // });
// v2========2017-08-30
    // 排序
    $('.sort').on('click', 'a', function(event) {
        var $this = $(this);
        var $childAsc = $(this).find('.icon-triangle-copy');
        var $childDesc = $(this).find('.icon-sanjiaoxing');
        $this.addClass('active').siblings().removeClass('active');
        $this.siblings().find('.icon-triangle-copy').removeClass('white-color blue-color');
        $this.siblings().find('.icon-sanjiaoxing').removeClass('white-color blue-color');
        if($childAsc.hasClass('white-color')){                      //若是升序时
            $childAsc.removeClass('white-color').addClass('blue-color');
            $childDesc.addClass('white-color').removeClass('blue-color');
        }else{                          //若降序
            $childAsc.addClass('white-color').removeClass('blue-color');
            $childDesc.removeClass('white-color').addClass('blue-color');
        }
    });
});
