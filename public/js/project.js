$(function () {
    // tab栏切换
    $('.sw-pro-tab a').click(function () {
        var num = $(this).index();
        $('.sw-pro-tabcon').eq(num).show().siblings().hide();
        $(this).addClass('active').siblings().removeClass('active');
    })
    // 领域、类型、角色下拉
    $('.sw-select-default').on('click', function (e) {
        e.stopPropagation();
        $(this).closest('.sw-pro-row').siblings().find('.sw-select-list').hide();
        $(this).next().stop().toggle();
    })
    $(document).click(function () {
        $('.sw-select-list').hide();
    })
    $('.sw-select-list li').click(function (e) {
        e.stopPropagation();
        var aHtml = $(this).html();
        $(this).parent().hide();
        $(this).parent().prev().html(aHtml);
    })
    // 大V、支付方式radio选择
    $('.sw-radio-wrapper').click(function () {
        $(this).addClass('swon').siblings().removeClass('swon');
    })
    // 选择大V方式切换
    $('.sw-choose-expert').on('click',function (e) {
        var num = $(this).index();
        $(this).addClass('swon').siblings().removeClass('swon');
        $('.sw-refer .sw-need-con').eq(num).show().siblings().hide();
    })



    // 项目名称失焦验证
    $('.project-name').blur(function () {
        var val = $(this).val();
        if (!val || !val.replace(/(^\s*)|(\s*$)/g, "").length){
            $(this).next('.sw-error').html('项目名称不可为空');
        }else {
            $(this).next('.sw-error').html('');
        }
    })
    // 一句话简介失焦验证
    $('.sw-one-word').keyup(function () {
        var val = $(this).val();
        if (!val || !val.replace(/(^\s*)|(\s*$)/g, "").length){
            $(this).next('.sw-error').html('简介不可为空');
        }else {
            if(val.replace(/(^\s*)|(\s*$)/g, "").length > 30){
                $(this).next('.sw-error').html('简介不可超过30个字');
            }else {
                $(this).next('.sw-error').html('');
            }
        }
    })
    // 项目概况字数限制
    $('.sw-project-txt').keyup(function () {
        var maxLen = 1000;
        var val = $(this).val();
        var count = val.length;
        $('.sw-num').html(count);
        if(val.length >= maxLen){
            $('.sw-num').css('color','#e25633')
        }else {
            $('.sw-num').css('color','#696f77')
        }
    })
})
