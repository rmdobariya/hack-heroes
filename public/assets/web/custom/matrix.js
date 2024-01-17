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
        $('.risk_change_event').val(data.risk_name);
        $('.risk_change_event').trigger('change');
    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
}

$(document).on('change', '.risk_change_event', function () {
    var risk = $(this).val();
    var id = $(this).find(':selected').data('child-id');
    loaderView()
    $.ajax({
        url: APP_URL + '/risk-change-event/' + risk + '/' + id,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        $('.risk_wise_recommendation_part').html(data.data)

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});

$(document).on('click', '.risk_wise_filter', function () {
    var risk = $(this).data('key');
    var id = $(this).data('child-id');
    loaderView()
    $.ajax({
        url: APP_URL + '/risk-change-event/' + risk + '/' + id,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        $('.risk_change_event').val(risk);
        $('.risk_change_event').trigger('change');
        $('.risk_wise_recommendation_part').html(data.data)

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});

