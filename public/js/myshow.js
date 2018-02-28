$(function() {
    var select = new Array();




    $('.uct-list-search-inp').keydown(function (evnet) {
        if (evnet.keyCode == '13') {
            var searchName = $(this).val();
            select[0] = 'serveName';
            select[1] = searchName;
            getCondition(select);
        }
    });

    $('.v-condition a').on('click',function () {
        var action = $(this).attr('index');
        select[0] = 'action';
        select[1] = action;
        getCondition(select);
    });

    $('.my-trace').on('click', 'a', function(event) {
        var action = $(this).attr('index');
        select[0] = 'action';
        select[1] = action;
        getCondition(select);
    });

    /*//动作
    $('.three-icon .icon-row').on('click',function () {
        var action = $(this).attr('index');
        select[0] = 'action';
        /!*switch (action) {
         case '收藏':
         select[1] = 'collect';
         break;
         case '发布':
         select[1] = 'myput';
         break;
         case '留言':
         select[1] = 'message';
         break;
         case '待审核':
         select[1] = 'waitverify';
         break;
         case '拒审核':
         select[1] = 'refuseverify';
         break;
         }*!/
        select[1] = action;
        getCondition(select);
    });
*/



    //删除
    $('.all-results').on('click', '.all-results-opt', function (event) {
        var key = $(this).text();
        if ($(this).hasClass('all-results-expert')) {
            select[0] = 'role';
            select[1] = null;
        } else if ($(this).hasClass('all-results-field')) {
            select[0] = 'supply';
            select[1] = null;
        } else if ($(this).hasClass('all-results-location')) {
            select[0] = 'address';
            select[1] = null;
        }else if ($(this).hasClass('all-results-trace')) {
            select[0] = 'action';
            select[1] = null;
        }
        getCondition(select);
    })





    var getCondition= function(select){
        var Condition=select;

        var action=$(".my-trace .active").attr('index');
        if(!action){
            action = $('.v-condition .active').attr('index');
        }

        action=(action != '不限')?action:null;


        if(Condition.length!=0){
            switch(Condition[0]){

                case "action":
                    action=(Condition[1]!="不限")?Condition[1]:null;
                    break;
            }
        }
        window.location.href="?action="+action;
    }
})

function fnc_collect (supplyid,action,obj) {

    $.post('/dealcollect',{'supplyid':supplyid,'action':action},function (data) {
        if(data == 'nologin'){
            layer.confirm('您还未登陆是否去登陆？', {
                btn: ['去登陆','暂不需要'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href='/login';
            }, function(){
                layer.close();
                $(obj).attr("title","收藏");
                $(obj).removeClass('red');
                if($(obj).hasClass('done')){
                    $(obj).text("收藏");
                    $(obj).removeClass('done');
                }
                $(obj).attr('disabled',false);
            });
        } else if(data == 'success') {
            if(action == 'collect'){
                var number = $(obj).text().trim() == '' ? 0:$(obj).text();
                $(obj).children('span').text(parseInt(number)+1);
                if($(obj).hasClass('collect-state')){
                    $(obj).html('已收藏');
                    $(obj).addClass('done');
                } else {
                    $(obj).attr("title","已收藏");
                    $(obj).addClass('red');
                }
                layer.msg('收藏成功');
                $(obj).attr('disabled',false);
            } else {
                var number = $(obj).text() == 1 ? ' ' : parseInt($(obj).text())-1;
                $(obj).children('span').text(number);
                if($(obj).hasClass('collect')){
                    $(obj).attr("title","收藏");
                    $(obj).removeClass('red');
                } else {
                    $(obj).html('收藏');
                    $(obj).removeClass('done');
                }
                layer.msg('取消收藏成功');
                $(obj).attr('disabled',false);
            }
        } else {
            $(obj).removeClass('red');
            layer.msg('收藏失败请您登陆或者这是一个异常需求',{'icon':0});

        }
    });
}

$('.details-message .submit').on('click',function () {
    var textarea = $(this).parent().siblings('textarea');
    var needid = textarea.attr('id');
    var content = textarea.val();
    $(this).attr('disabled',"true");
    replymessage({'needid':needid,'content':content,'parentid':0},this);
});

function replymessage (datas,obj) {
    if(!datas.content.trim().length){
        layer.msg('请输入留言内容');
        $(obj).attr('disabled',false);
        return false;
    }
    $.post('/replymessage',datas,function (data) {
        if(data == 'success'){
            layer.msg('回复成功',{time:2000},function () {
                var url = window.location.href;
                url = url.replace(/\#reply/,'');
                window.location = url;
            });
        }else if(data == 'nologin') {
            layer.confirm('您还未登陆是否去登陆？', {
                btn: ['去登陆','暂不需要'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href='/login';
            }, function(){
                layer.close();
                /*$(obj).attr("title","收藏");
                $(obj).removeClass('red');
                if($(obj).hasClass('done')){
                    $(obj).removeClass('done');
                }*/
                $(obj).attr('disabled',false);
            });
        } else {
            layer.msg('处理失败');
        }
    });
}
