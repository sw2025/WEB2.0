$(function(){
    var select=new Array();
    //选择专家
    $('.experts-classify').on('click', 'a', function(event) {
        var cliHtml = $(this).html();
        select[0] = 'role';
        select[1] = cliHtml;
        getCondition(select);
    });

    // 选择服务领域
    $('.serve-field-list-show').on('click', 'li', function(event) {
        var serveLi = $(this).parent().siblings().html();
        select[0] = 'supply';
        select[1] = serveLi;
        getCondition(select);
    });
    $('.serve-field .serve-all').on('click', function(event) {
        select[0] = 'supply';
        select[1] = '全部';
        getCondition(select);
    });

    // 选择视频
    $('.video-consult').on('click', 'a', function(event) {
        var cliHtml = $(this).html();
        select[0] = 'consult';
        select[1] = cliHtml;
        getCondition(select);
    });

    // 选择地区
    $('.location').on('click', 'a', function(event) {
        var cliHtml = $(this).html();
        select[0] = 'address';
        select[1] = cliHtml;
        getCondition(select);
    });

    //搜索
    $('.list-search .list-search-btn').on('click',function () {
        var searchName = $(this).siblings().val();

        select[0] = 'serveName';
        select[1] = searchName;
        getCondition(select);
    });
    $('.list-search-inp').keydown(function (evnet) {
        if (evnet.keyCode == '13') {
            var searchName = $(this).val();
            select[0] = 'serveName';
            select[1] = searchName;
            getCondition(select);
        }
    });

    //删除
    $('.all-results').on('click', '.all-results-opt', function(event) {
        var key = $(this).text();
        if ($(this).hasClass('all-results-expert')){
            select[0] = 'role';
            select[1] = null;
        } else if ($(this).hasClass('all-results-field')){
            select[0] = 'supply';
            select[1] = null;
        } else if ($(this).hasClass('all-results-location')) {
            select[0] = 'address';
            select[1] = null;
        }else if ($(this).hasClass('all-results-video')) {
            select[0] = 'consult';
            select[1] = null;
        }
        getCondition(select);
    })



    // 排序
    $('.sort').on('click', 'a', function(event) {
        var ordername = $(this).text();
        var firsticon = ($('.sort .active span .icon-triangle-copy').hasClass('blue-color'))?'desc':'asc';
        switch (ordername){
            case '认证时间  ':
                select[0] = 'ordertime';
                select[1] = firsticon;
                getCondition(select);
                break;
            case '收藏数':
                select[0] = 'ordercollect';
                select[1] = firsticon;
                getCondition(select);
                break;
            case '留言数':
                select[0] = 'ordermessage';
                select[1] = firsticon;
                getCondition(select);
                break;
        }

    });


    var getCondition= function(select){
        var Condition=select;
        var searchName=$(".list-search-inp").val();
        if(searchName == '请输入专家姓名／机构名称／企业家姓名'){
            searchName = '';
        }
        var role=$(".all-results-expert").text();
        var supply=$(".all-results-field").text();
        var address=$(".all-results-location").text();
        var consult=$(".all-results-video").text();
        searchName=(searchName)?searchName:null;
        role=(role)?role:null;
        supply=(supply)?supply:null;
        address=(address)?address:null;
        consult=(consult)?consult:null;
        if( $(".sort").children('a').hasClass('active')){
            var ordername = $('.sort .active ').text();
            var firsticon = ($('.sort .active span .icon-triangle-copy').hasClass('blue-color'))?'desc':'asc';
            switch (ordername){
                case '认证时间':
                    var ordertime = firsticon;
                    break;
                case '收藏数':
                    var ordercollect = firsticon;
                    break;
                case '留言数':
                    var ordermessage = firsticon;
                    break;
            }
        }

        if(Condition.length!=0){
            switch(Condition[0]){
                case "role":
                    role=(Condition[1]!="全部")?Condition[1]:null;
                    break;
                case "serveName":
                    searchName=Condition[1];
                    break;
                case "supply":
                    supply=(Condition[1]!="全部")?Condition[1]:null;
                    break;
                case "consult":
                    consult=(Condition[1]!="全部")?Condition[1]:null;
                    break;
                case "address":
                    address=(Condition[1]!="全部")?Condition[1]:null;
                    break;
                case "ordertime":
                    ordertime=Condition[1];
                    break;
                case "ordercollect":
                    ordercollect=Condition[1];
                    break;
                case "ordermessage":
                    ordermessage=Condition[1];
                    break;

            }
        }
        ordertime=(ordertime)?ordertime:null;
        ordercollect=(ordercollect)?ordercollect:null;
        ordermessage=(ordermessage)?ordermessage:null;
        window.location.href="?searchname="+searchName+"&role="+role+"&supply="+supply+"&consult="+consult+"&address="+address+"&ordertime="+ordertime+"&ordercollect="+ordercollect+"&ordermessage="+ordermessage;
    }
})




function fnc_collect (supplyid,action,obj) {

    $.post('/dealextcollect',{'supplyid':supplyid,'action':action},function (data) {
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
                    $(obj).removeClass('done');
                }
            });
        } else if(data == 'success') {
            if(action == 'collect'){
                var number = $(obj).text() == '' ? 0:$(obj).text();
                $(obj).children('span').text(parseInt(number)+1);
                layer.msg('收藏成功');
            } else {
                var number = $(obj).text() == 1 ? '' : parseInt($(obj).text())-1;
                $(obj).children('span').text(number);
                layer.msg('取消收藏成功');
            }
        } else {
            $(obj).removeClass('red');
            layer.msg('处理失败');
        }
    });
}

$('.details-message .submit').on('click',function () {
    var textarea = $(this).parent().siblings('textarea');
    var needid = textarea.attr('id');
    var content = textarea.val();
    $(this).attr('disabled',"true");
    replymessage({'needid':needid,'content':content},this);
});

function replymessage (datas,obj) {
    $.post('/replyextmessage',datas,function (data) {
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
                $(obj).attr("title","收藏");
                $(obj).removeClass('red');
                if($(obj).hasClass('done')){
                    $(obj).removeClass('done');
                }
                $(obj).attr('disabled',false);
            });
        } else {
            layer.msg('处理失败');
        }
    });
}


