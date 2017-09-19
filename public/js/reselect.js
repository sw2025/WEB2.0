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
    $('.uct-list-search .uct-list-search-btn').on('click',function () {
        var searchName = $(this).siblings().val();

        select[0] = 'serveName';
        select[1] = searchName;
        getCondition(select);
    });
    $('.uct-list-search-inp').keydown(function (evnet) {
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
        var start=($.cookie('videodateStart'))?$.cookie('videodateStart'):null;
        var end=($.cookie('videodateEnd'))?$.cookie('videodateEnd'):null;
        window.location.href="?searchname="+searchName+"&role="+role+"&supply="+supply+"&consult="+consult+"&address="+address+"&ordertime="+ordertime+"&ordercollect="+ordercollect+"&ordermessage="+ordermessage+"&start="+start+"&end="+end;
    }
})











