$(".ratings").mousemove(function (e) {
    if($(this).attr('data-move') != 'false'){
        var offset = $(this).offset();
        var relativeX = (e.pageX - offset.left);
        changePoint($(this),relativeX);
    }
});

$(".ratings").click(function (e) {
    $(this).attr('data-move',false);
    var offset = $(this).offset();
    var relativeX = (e.pageX - offset.left);
    changePoint($(this),relativeX);
    var object = $(this);
    $.ajax({
       url: $(this).attr('data-href'),
       type: "get",
       dataType: "json",
       data: {
           rating: calcSize($(this),relativeX),
           lid: $(this).attr('data-id')
       },
       success: function (data) {
          changePoint(object,data.avg*(object.width()/5));
       }
    });
});



function calcSize(object,relativeX) {
    point = relativeX/(object.width()/5);

    if(point > 4.5){
        return 5;
    }
   return point.toFixed(1);
}

function changePoint(object,relativeX) {
    object.children('.ratings-result').attr('data-result',relativeX).css('width',relativeX);
    object.parents('.ratings-container').find('.ratings-amount b').text(calcSize(object,relativeX));
}

$('.ratings').mouseleave(function () {
    changePoint($(this),Number(102/5*$(this).attr('data-avg')));
});