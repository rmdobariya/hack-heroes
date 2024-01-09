$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

let $updateProfileForm = $('#updateProfileForm')
$updateProfileForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($updateProfileForm[0])
    axios
        .post(APP_URL + '/update-profile-store', formData)
        .then(function (response) {
            loaderHide();
            setTimeout(function () {
                window.location.href = APP_URL + '/profile';
            }, 5000);
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
