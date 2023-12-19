$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $signup2 = $('#signup2')
$signup2.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signup2[0])
    axios
        .post(APP_URL + '/signup_2', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/signup_2_view';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
let $signup3 = $('#signup3')
$signup3.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signup3[0])
    axios
        .post(APP_URL + '/signup_3', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/signup_3_view';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
let $signup4 = $('#signup4')
$signup4.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signup4[0])
    axios
        .post(APP_URL + '/signup_4', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/signup_4_view';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

let $signup5 = $('#signup5')
$signup5.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signup5[0])
    axios
        .post(APP_URL + '/signup_5', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/signup_5_view';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
let $signup6 = $('#signup6')
$signup6.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signup6[0])
    axios
        .post(APP_URL + '/signup_6', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/signup_6_view';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

let $signupStore = $('#signupStore')
$signupStore.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($signupStore[0])
    axios
        .post(APP_URL + '/signup_store', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/home';
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

let $loginForm = $('#loginForm')
$loginForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($loginForm[0])
    axios
        .post(APP_URL + '/login-check', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/dashboard';
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
let $forgotPasswordForm = $('#forgotPasswordForm')
$forgotPasswordForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($forgotPasswordForm[0])
    axios
        .post(APP_URL + '/reset-password-submit', formData)
        .then(function (response) {
            console.log(response)
            loaderHide();
            window.location.href = APP_URL + '/dashboard';
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
$('#send_mail').on('click', function () {
    let email = $('#forgot_email').val();
    if (email === '') {
        notificationToast('Please Enter Email', 'warning')
        return false
    }
    loaderView()
    axios
        .post(APP_URL + '/send-mail', {
            email: email,
        })
        .then(function (response) {
            loaderHide()
            notificationToast(response.data.message, 'success')
        })
        .catch(function (error) {
            notificationToast(error.response.data.message, 'warning')
            loaderHide()
        })
})


