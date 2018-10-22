
function showMiniCart()
{
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

function changeCountAndTotal(count,price) {
    var old_total = Number($('#totalMiniCart').text());
    $('#totalMiniCart').text(old_total+price*count);

    var old_count =Number($('#countMiniCart').text());
    $('#countMiniCart').text(old_count + count);
}

function changeAfterDeleteTovar(price,count)
{
    var old_total = Number($('#totalMiniCart').text());
    $('#totalMiniCart').text(old_total - price);

    var old_count =Number($('#countMiniCart').text());
    $('#countMiniCart').text(old_count - count);
}



$('#button_miniCart').mouseenter(function () {
    showMiniCart();
});



$(document).on('click','.deleteWithBasket',function () {

    var price = Number($(this).attr('data-price')) * Number($.cookie('cart_'+$(this).attr('data-id')));

    changeAfterDeleteTovar(price,Number($.cookie('cart_'+$(this).attr('data-id'))));

    $.removeCookie('cart_'+$(this).attr('data-id'),{path: '/',expires: 7});

    showMiniCart();

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

    changeCountAndTotal(Number($(this).attr('data-count')),price);

    return false;
});


$('.quantity-input-up').click(function () {
    changeNumber(1);
});
$('.quantity-input-down').click(function () {
    changeNumber(-1);
});

function changeNumber(num) {
    number = $('.custom-quantity-input input[name=quantity]');
    if((number.val() >= 1 && num > 0) || number.val() > 1){
        number.val(Number(number.val()) + Number(num));
        $('.addToCart').attr('data-count',number.val());
    }
}

$('.custom-quantity-input input[name=quantity]').change(function () {
   if($(this).val() <= 0){
       $(this).val(1);
   }
});

