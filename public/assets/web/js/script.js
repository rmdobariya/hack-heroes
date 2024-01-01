

$('#prev').click(function() {
    $('.current').removeClass('current').hide()
    .prev().show().addClass('current');
    $('.current1').removeClass('current1').removeClass('active').prev().addClass('active').addClass('current1');

    $("li.current1").find('span').removeClass('active1');

    if ($('.current').hasClass('first')) {
        $('#prev').css('display', 'none');
    }
    if ($('.current').hasClass('last')) {
        $('#signup_store').removeClass('d-none');
    }else{
        $('#signup_store').addClass('d-none');
    }
    $('#next').css('display', 'inline-block');
});
