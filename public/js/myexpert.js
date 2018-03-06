$(function() {
    var select = new Array();



    // 选择服务领域
    $('.serve-field-list-show').on('click', 'li', function(event) {
        var serveLi = $(this).parent().siblings().html();
        select[0] = 'supply';
        select[1] = serveLi;
        getCondition(select);
    });

    $('.serve-field .serve-all').on('click', function(event) {
        select[0] = 'supply';
        select[1] = '不限';
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
    $('.list-search .list-search-btn').on('click', function () {
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
        }

        getCondition(select);
    })


    // 排序
    $('.sort').on('click', 'a', function (event) {
        var ordername = $(this).text();

        var firsticon = ($('.sort .active span .icon-triangle-copy').hasClass('blue-color')) ? 'desc' : 'asc';
        switch (ordername){
            case '认证时间':
                select[0] = 'ordertime';
                select[1] = firsticon;
                getCondition(select);
                break;
        }

    });


    var getCondition= function(select){
        var Condition=select;
        var searchName=$(".uct-list-search-inp").val();
        var supply=$(".all-results-field").text();
        var address=$(".all-results-location").text();

        if(searchName == '请输入大V姓名'){
            searchName = '';
        }
        searchName=(searchName)?searchName:null;
        supply=(supply)?supply:null;
        address=(address)?address:null;
        if( $(".sort").children('a').hasClass('active')){
            var ordername = $('.sort .active ').text();
            var firsticon = ($('.sort .active span .icon-triangle-copy').hasClass('blue-color'))?'desc':'asc';
            switch (ordername){
                case '认证时间':
                    var ordertime = firsticon;
                    break;
            }
        }

        if(Condition.length!=0){
            switch(Condition[0]){
                case "serveName":
                    searchName=Condition[1];
                    break;
                case "supply":
                    supply=(Condition[1]!="不限")?Condition[1]:null;
                    break;

                case "address":
                    address=(Condition[1]!="全部")?Condition[1]:null;
                    break;

                case "ordertime":
                    ordertime=Condition[1];
                    break;

            }
        }
        ordertime=(ordertime)?ordertime:null;
        window.location.href="?searchname="+searchName+"&address="+address+"&ordertime="+ordertime;
    }
})
