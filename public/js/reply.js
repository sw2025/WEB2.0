$(document).ready(function(){
    $('.reply-list').on('click', '.reply-btn', function(event) {
        $('.reply-box').show();
        var name = $(this).closest('li').find('.floor-guest-name').html();
        $('.reply-enter').val('回复 '+name+'：');
    });
    // 查看回复
    $('.message-reply-show').on('click','.look-reply', function(event) {
        var $ul = $(this).parent().next().children('ul');
        if($ul.children('li').length >= 1){
            $(this).parent().next().children('ul').stop().slideToggle(500);
            $(this).parent().next().children('.reply-box').hide();
        }

    });
    // 回复楼主
    $('.message-reply-show').on('click','.message-reply', function(event) {
        $(this).parent().next().children('ul').hide();
        $(this).parent().next().children('.reply-box').slideToggle(500);

    });
    // 互相回复
    $('.publish-btn').on('click', function(event) {
        var enterHtml = $(this).parent().prev('.reply-enter').val();
        // $(this).closest('.reply-box').prev('ul').append('<li><img src="img/avatar3.jpg" class="floor-guest-ava" /><div class="gloor-guest-cnt"><a href="javascript:;" class="floor-guest-name">牛犇犇</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">李道山</a><span class="floor-guest-words">'+ enterHtml +'</span></div><div class="floor-bottom"><span class="floor-guest-time">2017-7-8  17：25</span><a href="javascript:;" class="reply-btn">回复</a></div></li>');
        $(this).closest('.reply-box').prev('ul').append('<li><img src="img/avatar3.jpg" class="floor-guest-ava" /><div class="gloor-guest-cnt"><span class="floor-guest-words">'+ enterHtml +'</span></div><div class="floor-bottom"><span class="floor-guest-time">2017-7-8  17：25</span><a href="javascript:;" class="reply-btn">回复</a></div></li>');
        $(this).parent().prev('.reply-enter').val('');
        $(this).closest('.reply-box').prev('ul').show()
    });
    // var replyLen = $('.reply-list-ul li').length;
    // if(replyLen > 5){
    //     $('.reply-list-ul li:gt(4)').hide();
    // }else{
    //     $('.look-more').hide();
    // }
});
