$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

let $getInTouchForm = $('#getInTouchForm')
$getInTouchForm.on('submit', function (e) {
    e.preventDefault()
    $('span.error').remove();
    var has_error = false;
    if ($.trim($('#getInTouchForm').find('[name="name"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter name.</span>').insertAfter($('#getInTouchForm').find('[name="name"]'));
        has_error = true;
    }
    if ($.trim($('#getInTouchForm').find('[name="email"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter email address.</span>').insertAfter($('#getInTouchForm').find('[name="email"]'));
        has_error = true;
    } else if (!is_valid_email($.trim($('#getInTouchForm').find('[name="email"]').val()))) {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter valid email address.</span>').insertAfter($('#getInTouchForm').find('[name="email"]'));
        has_error = true;
    }
    if ($.trim($('#getInTouchForm').find('[name="message"]').val()) == '') {
        //notificationToast("Please Enter Your message", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter message.</span>').insertAfter($('#getInTouchForm').find('[name="message"]'));
        has_error = true;
    }
    if (!has_error) {
        loaderView();
        let formData = new FormData($getInTouchForm[0])
        axios
            .post(APP_URL + '/get-in-touch', formData)
            .then(function (response) {
                loaderHide();
                // window.location.href = APP_URL + '/home';
                if (response.data.success == true) {
                    $getInTouchForm[0].reset();
                    //notificationToast(response.data.message, 'success');
                    notificationToast('Form submitted successfully', 'success');                    
                    $('#get-in-touch-msg').removeClass('d-none')
                    setTimeout(function () {
                        $('#get-in-touch-msg').addClass('d-none')
                    }, 5000);
                }

            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
})


function is_valid_email(email) {
    var regex = /^([a-zA-Z0-9_\'\+\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$('#button-addon2').on('click', function () {
    $(document).find('span.custom-validation-message').remove();
    var email = $('#subscribe_email').val();
    if ($.trim(email) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-1">Please enter email address.</span>').insertAfter($('#subscribe_email').closest('.input-group'));
    } else if (!is_valid_email($.trim(email))) {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-1">Please enter valid email address.</span>').insertAfter($('#subscribe_email').closest('.input-group'));
    } else {
        loaderView();
        axios
            .post(APP_URL + '/subscribe', { email: email })
            .then(function (response) {
                loaderHide();
                $('#subscribe_email').val('');
                //notificationToast(response.data.message, 'success');
                $('<span class="text-success custom-validation-message ps-1">' + response.data.message + '</span>').insertAfter($('#subscribe_email').closest('.input-group'));
                setTimeout(function () {
                    $('.custom-validation-message').fadeOut();
                }, 3000);
                $('#subscribe_email').val('');
            })
            .catch(function (error) {
                //notificationToast(error.response.data.message, 'warning')
                $('<span class="error custom-validation-message ps-1">' + error.response.data.message + '</span>').insertAfter($('#subscribe_email').closest('.input-group'));
                setTimeout(function () {
                    $('.custom-validation-message').fadeOut();
                }, 3000);
                $('#subscribe_email').val('');
                loaderHide();
            });
    }
})
