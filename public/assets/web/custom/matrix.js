$(document).on('click', '.risk_event', function () {
    var clickedElement = $(this);
    risk($(this).data('id'), $(this).data('child-id'));
    clickedElement.addClass('active');
    $('.risk_event').not(clickedElement).removeClass('active');
});

function risk(id, child_id) {
    loaderView()
    $.ajax({
        url: APP_URL + '/getRisk/' + id + '/' + child_id,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        $('#risk_wise_detail').html(data.data)
        $('#render_recommendation_part').html(data.recommendation)

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
}

// $('.recommendation').on('click', function () {
//     var risk = $(this).data('name');
//     var child_id = $(this).data('id');
//     loaderView();
//     $.ajax({
//         url: APP_URL + '/getRiskWiseRecommendation/' + risk + '/' + child_id,
//         method: 'GET',
//
//     }).done(function (data) {
//         loaderHide()
//         console.log(data.data)
//         $('#recommendations').html(data.data)
//
//     }).fail(function (jqXHR, textStatus) {
//         loaderHide()
//         console.log('Request failed: ' + textStatus)
//     })
// })


