function showMiniCart() {
    $('#ajaxMiniCart').empty();

    $.ajax({
            url: '/basket/mini',
            type: 'GET',
            success: function (html) {
                $('#ajaxMiniCart').html(html);

            }
        }
    );
}

function changeCountAndTotal(count, price) {
    var old_total = Number($('#totalMiniCart').text());
    $('#totalMiniCart').text(old_total + price * count);
    $('#total_basket').text(old_total + price * count);

    var old_count = Number($('#countMiniCart').text());
    $('#countMiniCart').text(old_count + count);
}

function changeAfterDeleteTovar(price, count) {
    var old_total = Number($('#totalMiniCart').text());
    $('#totalMiniCart').text(old_total - price);
    $('#total_basket').text(old_total - price);

    var old_count = Number($('#countMiniCart').text());
    $('#countMiniCart').text(old_count - count);

}


$('#button_miniCart').mouseenter(function () {
    showMiniCart();
});

$('#button_miniCart').click(function () {
    if(Number($('#countMiniCart ').text()) > 0){
        location.href = $(this).attr('data-href');
    }
});

$(document).on('click', '.deleteWithBasket', function () {

    var price = Number($(this).attr('data-price')) * Number($.cookie('cart_' + $(this).attr('data-id')));

    changeAfterDeleteTovar(price, Number($.cookie('cart_' + $(this).attr('data-id'))));

    totalAllBasket();

    $.removeCookie('cart_' + $(this).attr('data-id'), {path: '/', expires: 7});

    showMiniCart();

    $('#big_cart .tovar_' + $(this).attr('data-id')).remove();

    if ($('#countMiniCart').text() == '0') {
        location.reload();
    }

    return false;
});


$('.addToCart').click(function () {

    var id = 'cart_' + $(this).attr('data-id');
    var count = Number($(this).attr('data-count'));
    var price = Number($(this).attr('data-price'));

    if ($.cookie(id)) {
        count += Number($.cookie(id));
    }

    $.cookie(id, count, {expires: 7, path: '/'});

    changeCountAndTotal(Number($(this).attr('data-count')), price);

    return false;
});


$('.quantity-input-up').click(function () {
    changeNumber(1, $(this));
});
$('.quantity-input-down').click(function () {
    changeNumber(-1, $(this));
});

function changeNumber(num, elem) {
    number = elem.parents('.custom-quantity-input').find('input[name=quantity]');

    if(number.attr('data-cookie')){
        count = Number($.cookie('cart_' + number.attr('data-id')));
        $.cookie('cart_' + number.attr('data-id'),count+num,{path: '/', expires: 7});
    }
    
    if ((number.val() >= 1 && num > 0) || number.val() > 1) {
        number.val(Number(number.val()) + Number(num));
        $('.addToCart').attr('data-count', number.val());
    }
    calc();
}

$('.custom-quantity-input input[name=quantity]').change(function () {
    if ($(this).val() <= 0) {
        $(this).val(1);
    }
});

calc();

function calc() {
    $('.cart-table tbody tr').each(function () {
        number = Number($(this).find('.price').text());
        qnt = Number($(this).find('input[name="quantity"]').val());
        $(this).find('.total_price_tovar').text(number * qnt);
    });
}

function totalAllBasket() {
    $('#total_all').text(Number($('#total_basket').text())+Number($('#shipping_total').text()));
}

