$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $purchaseForm = $('#purchaseForm')
$purchaseForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($purchaseForm[0])
    axios
        .post(APP_URL + '/session', formData)
        .then(function (response) {
            loaderHide();
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
