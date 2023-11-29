rowNo = 1;
$(document).on('click', '#add_child', function () {
    rowNo = rowNo + 1
    getRow(rowNo)
})

function getRow(rowNo) {
    // loaderView()
    $.ajax({
        url: APP_URL + '/getRow/' + rowNo,
        method: 'GET',

    }).done(function (data) {
        // loaderHide()
        $('.child_part:last').after(data.data)

        // isRequired()
    }).fail(function (jqXHR, textStatus) {
        // loaderHide()
        console.log('Request failed: ' + textStatus)
    })
}
