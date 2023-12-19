$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

let $getInTouchForm = $('#getInTouchForm')
$getInTouchForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($getInTouchForm[0])
    axios
        .post(APP_URL + '/get-in-touch', formData)
        .then(function (response) {
            loaderHide();
            window.location.href = APP_URL + '/home';
            notificationToast(response.data.message, 'success');
            $('#get-in-touch-msg').removeClass('d-none')
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
