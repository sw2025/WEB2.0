$(function () {
    $(document).click(function () {
        $('.sw-fill-list').hide();
    })
    $('.sw-fill-opt').click(function (e) {
        e.stopPropagation();
        $(this).next().stop().toggle();
        $(this).closest('.sw-fill-row').siblings().find('.sw-fill-list').hide();
    })
    $('.sw-fill-list li').click(function (e) {
        e.stopPropagation();
        var htmlVal = $(this).html();
        $(this).parent().prev().html(htmlVal);
        $(this).parent().hide();
    })
})