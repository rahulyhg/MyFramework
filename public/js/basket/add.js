$('.addToCart').click(function () {

    var id = 'cart_'+$(this).attr('data-id');
    var count = Number($(this).attr('data-count'));

    if ($.cookie(id)) {
        count += Number($.cookie(id));
    }

    $.cookie(id, count, {expires: 7, path: '/'});


    return false;
});