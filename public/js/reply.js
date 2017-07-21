$(document).ready(function(){
    $('.reply-list').on('click', '.reply-btn', function(event) {
        var obj = $(this).closest('li').parent().siblings();
        obj.show();
        var name = $(this).closest('li').find('.floor-guest-name').html();
        obj.children('.reply-enter').attr('touser',$(this).attr('userid'));
        obj.children('.reply-enter').attr('placeholder','回复 '+name+':');
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

        var obj = $(this).parent().siblings();
        var needid = obj.attr('index');
        var id = obj.attr('id');
        var use_userid = obj.attr('touser');
        var content = obj.val();
        $(this).attr('disabled',"true");
        replymessage({'needid':needid,'parentid':id,'content':content,'use_userid':use_userid},this);

    });
    // var replyLen = $('.reply-list-ul li').length;
    // if(replyLen > 5){
    //     $('.reply-list-ul li:gt(4)').hide();
    // }else{
    //     $('.look-more').hide();
    // }
});
