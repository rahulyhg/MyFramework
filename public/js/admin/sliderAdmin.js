
//select slider
$('#slider_show').change(function () {
    id = $(this).val();

    selectDiv(id);

    $.cookie('slider-menu',id,{path: document.location.pathname});

});


if($.cookie('slider-menu')){

    id = $.cookie('slider-menu');

    selectDiv(id);

    $('#slider_show').val(id);
}

function selectDiv(id) {

    if(id == 'top_slider'){
        $('#top_slider').css('display','block');
        $('#bottom_slider').css('display','none');
    }else{
        $('#top_slider').css('display','none');
        $('#bottom_slider').css('display','block');
    }
}