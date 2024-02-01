$(document).on('click', '.risk_event', function () {
    var clickedElement = $(this);
    get_risk($(this).data('id'), $(this).data('child-id'));
    clickedElement.addClass('active');
    $('.risk_event').not(clickedElement).removeClass('active');
});

function get_risk(id, child_id) {
    loaderView()
    $.ajax({
        url: APP_URL + '/getRisk/' + id + '/' + child_id,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        $('#risk_wise_detail').html(data.data)
        // $('#render_recommendation_part').html(data.recommendation)
        // $('.risk_change_event').val(data.risk_name);
        // $('.risk_change_event').trigger('change');
         if ($(document).find('.risk_change_event [value="' + data.risk_name + '"]').length == 0) {
            $(document).find('.risk_change_event').val('all_category').trigger('change');
        } else {
            $(document).find('.risk_change_event').val(data.risk_name).trigger('change');
        }
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
        // $('.risk_change_event').val(risk);
        // $('.risk_change_event').trigger('change');
        if ($('.risk_change_event [value="' + risk + '"]').length == 0) {
            $('.risk_change_event').val('all_category');
        } else {
            $('.risk_change_event').val(risk);
        }
        $('.risk_wise_recommendation_part').html(data.data)

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});

$(document).on('click', '.add_to_calendar', function () {
    var title = $(this).data('rec-title');
    var desc = $(this).data('rec-des');
    var id = $(this).data('id');
    loaderView()
    $.ajax({
        url: APP_URL + '/add-to-calendar/' + title + '/' + id,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        window.open(data.url, '_blank');

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});
$(document).on('click', '.add_to_apple_calendar', function () {
    var title = $(this).data('rec-title');
    var desc = $(this).data('rec-des');
    loaderView()
    $.ajax({
        url: APP_URL + '/add-to-apple-calendar/' + title + '/' + desc,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        window.open(data.url, '_blank');

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});
$(document).on('click', '.add_to_micro_soft_calendar', function () {
    var title = $(this).data('rec-title');
    var desc = $(this).data('rec-des');
    loaderView()
    $.ajax({
        url: APP_URL + '/add-to-microsoft-calendar/' + title + '/' + desc,
        method: 'GET',

    }).done(function (data) {
        loaderHide()
        window.open(data.url, '_blank');

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
});

