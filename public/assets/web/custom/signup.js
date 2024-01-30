$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $signup2 = $('#signup2')
$signup2.on('submit', function (e) {
    e.preventDefault()

    $('span.error').remove();
    var has_error = false;
    if ($.trim($signup2.find('[name="name"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter name.</span>').insertAfter($signup2.find('[name="name"]'));
        has_error = true;
    }
    if ($.trim($signup2.find('[name="email"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter email address.</span>').insertAfter($signup2.find('[name="email"]'));
        has_error = true;
    } else if (!is_valid_email($.trim($signup2.find('[name="email"]').val()))) {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter valid email address.</span>').insertAfter($signup2.find('[name="email"]'));
        has_error = true;
    }

    if (!has_error) {
        loaderView();
        let formData = new FormData($signup2[0])
        axios
            .post(APP_URL + '/signup_2', formData)
            .then(function (response) {
                console.log(response)
                loaderHide();
                window.location.href = APP_URL + '/add-child-info';
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
})
let $signup3 = $('#signup3')
$signup3.on('submit', function (e) {
    e.preventDefault()
    $('span.error').remove();
    var has_error = false;
    $('.child-name').each(function () {
        var childName = $(this).val(); // Find the input field inside each attribute-row
        if ($.trim(childName) != '') {
            //            $('<span class="error custom-validation-message ps-3">Please enter child name.</span>').insertAfter($(this));
            //has_error = true;
            if ($(this).next('.child-sex').val() == '') {
                $('<span class="error custom-validation-message ps-3">Please select gender.</span>').insertAfter($(this).next('.child-sex'));
                has_error = true;
            }
        }
    });
    if ($('.child-name').length == 1 && $.trim($('.child-name').val()) == '') {
        $('<span class="error custom-validation-message ps-3">Please enter child name.</span>').insertAfter($('.child-name'));
        has_error = true;
    }
    if (!has_error) {
        loaderView();
        let formData = new FormData($signup3[0])
        axios
            .post(APP_URL + '/signup_3', formData)
            .then(function (response) {
                console.log(response)
                loaderHide();
                if (response.data.user_id == 0) {
                    window.location.href = APP_URL + '/create-password';
                } else {
                    window.location.href = APP_URL + '/create-plan';
                }
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
})


$('#password').keyup(function () {
    var password = $('#password').val();
    if (checkStrength(password) == false) {
        //$('#sign-up').attr('disabled', true);
    }
});

$('[name="new_password"]').keyup(function () {
    var password = $('[name="new_password"]').val();
    if (checkStrength(password) == false) {
        //$('#sign-up').attr('disabled', true);
    }
});

function containsUppercase(str) {
    return /[A-Z]/.test(str);
}

function containsLowercase(str) {
    return /[a-z]/.test(str);
}

function checkStrength(password) {
    var strength = 0;
    //If password contains both lower and uppercase characters, increase strength value.
    // if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
    //     strength += 1;
    //     $('.has-lowercase').addClass('text-success');
    // } else {
    //     $('.has-lowercase').removeClass('text-success');
    // }

    if (containsLowercase(password)) {
        strength += 1;
        $('.has-lowercase').addClass('text-success');
    } else {
        $('.has-lowercase').removeClass('text-success');
    }

    if (containsUppercase(password)) {
        strength += 1;
        $('.has-uppercase').addClass('text-success');
    } else {
        $('.has-uppercase').removeClass('text-success');
    }

    //If it has numbers and characters, increase strength value.
    //if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
        strength += 1;
        $('.has-number').addClass('text-success');
    } else {
        $('.has-number').removeClass('text-success');
    }

    //If it has one special character, increase strength value.
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
        $('.has-symbol').addClass('text-success');

    } else {
        $('.has-symbol').removeClass('text-success');
    }

    if (password.length >= 12) {
        strength += 1;
        $('.has-length').addClass('text-success');

    } else {
        $('.has-length').removeClass('text-success');
    }
    // If value is less than 2
    if (strength < 2) {
        // $('#result').removeClass()
        // $('#password-strength').addClass('progress-bar-danger');
        // $('#result').addClass('text-danger').text('Very Week');
        // $('#password-strength').css('width', '10%');
        return false;
    } else if (strength == 2) {
        // $('#result').addClass('good');
        // $('#password-strength').removeClass('progress-bar-danger');
        // $('#password-strength').addClass('progress-bar-warning');
        // $('#result').addClass('text-warning').text('Week')
        // $('#password-strength').css('width', '60%');
        // return 'Week'
        return false;
    } else if (strength >= 5) {
        // $('#result').removeClass()
        // $('#result').addClass('strong');
        // $('#password-strength').removeClass('progress-bar-warning');
        // $('#password-strength').addClass('progress-bar-success');
        // $('#result').addClass('text-success').text('Strength');
        // $('#password-strength').css('width', '100%');
        // return 'Strong'
        return true;
    }
}


let $signup4 = $('#signup4')
$signup4.on('submit', function (e) {
    $('span.error').remove();
    e.preventDefault()
    if (checkStrength($('#password').val())) {
        loaderView();
        let formData = new FormData($signup4[0])
        axios
            .post(APP_URL + '/signup_4', formData)
            .then(function (response) {
                console.log(response)
                loaderHide();
                window.location.href = APP_URL + '/create-plan';
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    } else {
        var message = "Your password isn't quite ready yet. Check the requirements list – the items that aren't green need your attention. You can do it!";
        $('<span class="error custom-validation-message ps-3">' + message + '</span>').insertAfter($('[name="password"]'));
    }
})

let $signup5 = $('#signup5')
$signup5.on('submit', function (e) {
    e.preventDefault()
    $('span.error').remove();
    var has_error = false;
    $('.sec-add-child').each(function () {
        var childName = $(this).find('.child-name').val(); // Find the input field inside each attribute-row
        if ($.trim(childName) != '') {
            // $('<span class="error custom-validation-message ps-3 mt-0">Please enter child name.</span>').insertAfter($(this));
            // has_error = true;
            if ($(this).find('.child-sex').val() == '') {
                $('<span class="error custom-validation-message ps-3">Please select gender.</span>').insertAfter($(this).find('.child-sex'));
                has_error = true;
            }
        }
    });
    if (!has_error) {
        loaderView();
        let formData = new FormData($signup5[0])
        axios
            .post(APP_URL + '/signup_5', formData)
            .then(function (response) {
                console.log(response)
                loaderHide();
                window.location.href = APP_URL + '/child-info';
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
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
            window.location.href = APP_URL + '/child-characteristics';
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

let signupStore = $('#signupStore')
signupStore.on('submit', function (e) {
    e.preventDefault()
    loaderView()
    let formData = new FormData(signupStore[0])
    axios
        .post(APP_URL + '/signup_store', formData)
        .then(function (response) {
            loaderHide()
            notificationToast(response.data.message, 'success')
            setTimeout(function () {
                window.location.href = APP_URL + '/dashboard';
            }, 2000);
        })
        .catch(function (error) {
            notificationToast(error.response.data.message, 'warning')
            loaderHide()
        })
})

$(document).on('click', '#skip_store', function () {
    $('span.error').remove();
    var password = $('#password').val();
    if (checkStrength($('#password').val())) {
        // loaderView()
        axios
            .post(APP_URL + '/skip_store', { password: password })
            .then(function (response) {
                loaderHide()
                notificationToast(response.data.message, 'success')
                setTimeout(function () {
                    window.location.href = APP_URL + '/dashboard';
                }, 5000);
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    } else {
        var message = "Your password isn't quite ready yet. Check the requirements list – the items that aren't green need your attention. You can do it!";
        $('<span class="error custom-validation-message ps-3">' + message + '</span>').insertAfter($('[name="password"]'));
        loaderHide()
    }

})


let $loginForm = $('#loginForm')
$loginForm.on('submit', function (e) {
    e.preventDefault()
    var has_error = false;
    $('span.error').remove();
    if ($.trim($('#loginForm').find('[name="email"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter email address.</span>').insertAfter($('#loginForm').find('[name="email"]'));
        has_error = true;
    } else if (!is_valid_email($.trim($('#loginForm').find('[name="email"]').val()))) {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter valid email address.</span>').insertAfter($('#loginForm').find('[name="email"]'));
        has_error = true;
    }
    if ($.trim($('#loginForm').find('[name="password"]').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter password.</span>').insertAfter($('#loginForm').find('[name="password"]'));
        has_error = true;
    }

    if (!has_error) {
        loaderView();
        let formData = new FormData($loginForm[0])
        axios
            .post(APP_URL + '/login-check', formData)
            .then(function (response) {
                console.log(response)
                loaderHide();
                setTimeout(function () {
                    window.location.href = APP_URL + '/dashboard';
                }, 3000);
                notificationToast(response.data.message, 'success');
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
})
let $forgotPasswordForm = $('#forgotPasswordForm')
$forgotPasswordForm.on('submit', function (e) {
    e.preventDefault()
    $('span.error').remove();
    if ($.trim($('[name="new_password"]').val()) == '') {
        $('<span class="error custom-validation-message ps-3">Please enter password.</span>').insertAfter($('[name="new_password"]'));
    } else if ($.trim($('[name="new_password"]').val()) == '') {
        $('<span class="error custom-validation-message ps-3">Please enter confirm password.</span>').insertAfter($('[name="confirm_password"]'));
    } else if (checkStrength($('[name="new_password"]').val())) {
        if ($('[name="new_password"]').val() != $('[name="confirm_password"]').val()) {
            $('<span class="error custom-validation-message ps-3">Password and confirm password should be same.</span>').insertAfter($('[name="confirm_password"]'));
        } else {
            loaderView();
            let formData = new FormData($forgotPasswordForm[0])
            axios
                .post(APP_URL + '/forgot-password-submit', formData)
                .then(function (response) {
                    console.log(response)
                    loaderHide();
                    setTimeout(function () {
                        window.location.href = APP_URL + '/login';
                    }, 5000);
                    notificationToast(response.data.message, 'success');
                })
                .catch(function (error) {
                    console.log(error);
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide();
                });
        }
    } else {
        var message = "Your password isn't quite ready yet. Check the requirements list – the items that aren't green need your attention. You can do it!";
        $('<span class="error custom-validation-message ps-3">' + message + '</span>').insertAfter($('[name="password"]'));
    }
})
$('#send_mail').on('click', function () {
    let email = $('#forgot_email').val();
    var has_error = false;
    $('span.error').remove();
    if ($.trim($('#forgot_email').val()) == '') {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter email address.</span>').insertAfter($('#forgot_email'));
        has_error = true;
    } else if (!is_valid_email($.trim($('#forgot_email').val()))) {
        //notificationToast("Please Enter Your Email", 'warning')
        $('<span class="error custom-validation-message ps-3">Please enter valid email address.</span>').insertAfter($('#forgot_email'));
        has_error = true;
    }

    if (!has_error) {
        loaderView()
        axios
            .post(APP_URL + '/send-mail', {
                email: email,
            })
            .then(function (response) {
                loaderHide()
                $('#email_msg').removeClass('d-none')
                //$('#email_msg').text(response.data.message)
                $('#email_msg').text("Please check your email for reset password instruction.")
                $('#forgot_email').val('')
                setTimeout(function () {
                    $('#email_msg').addClass('d-none');
                }, 2000);
                // notificationToast(response.data.message, 'success')
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    }
})

function addAttribute(rowNo) {
    $('span.error').remove();
    var has_error = false;
    $('.child-name').each(function () {
        var childName = $(this).val(); // Find the input field inside each attribute-row
        if ($.trim(childName) == '') {
            $('<span class="error custom-validation-message ps-3">Please enter child name.</span>').insertAfter($(this));
            has_error = true;
        }
    });
    $('.child-sex').each(function () {
        var childName = $(this).val(); // Find the input field inside each attribute-row
        if ($.trim(childName) == '') {
            $('<span class="error custom-validation-message ps-3">Please select gender.</span>').insertAfter($(this));
            has_error = true;
        }
    });
    if (!has_error) {
        // addChildBtnRefresh()
        loaderView()
        rowNo = $(document).find('.child-name').length;
        $.ajax({
            url: APP_URL + '/getAttributeRow/' + rowNo,
            method: 'GET',

        }).done(function (data) {
            loaderHide()
            $('.attribute-row').append(data.data)

        }).fail(function (jqXHR, textStatus) {
            loaderHide()
            console.log('Request failed: ' + textStatus)
        })
    }
}


function addAttributeForPlan(rowNo) {
    // addChildBtnRefresh()
    $('span.error').remove();
    var has_error = false;
    $('.child-name').each(function () {
        var childName = $(this).val(); // Find the input field inside each attribute-row
        if ($.trim(childName) == '') {
            $('<span class="error custom-validation-message ps-3 mt-0">Please enter child name.</span>').insertAfter($(this));
            has_error = true;
        }
    });
    $('.child-sex').each(function () {
        var childName = $(this).val(); // Find the input field inside each attribute-row
        if ($.trim(childName) == '') {
            $('<span class="error custom-validation-message ps-3">Please select gender.</span>').insertAfter($(this));
            has_error = true;
        }
    });
    if (!has_error) {
        loaderView()
        rowNo = $(document).find('.child-name').length;
        $.ajax({
            url: APP_URL + '/getAttributeRowForPlan/' + rowNo,
            method: 'GET',

        }).done(function (data) {
            loaderHide()
            //$('.attribute-row:last').after(data.data)
            $(data.data).insertBefore($('#add-child-btn'));
        }).fail(function (jqXHR, textStatus) {
            loaderHide()
            console.log('Request failed: ' + textStatus)
        })
    }
}

function deleteAttribute(rowNo, attributeNo) {
    $('#attribute-row-value-' + rowNo + '-' + attributeNo).remove()

}

function is_valid_email(email) {
    var regex = /^([a-zA-Z0-9_\'\+\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).on('click', '.subscriptionFormSubmit', function () {
    loaderView();
    let $paymentForm = $('#payment-form')
    let plan_id = $(this).data('plan-id');
    let user_id = $(this).data('user-id');
    let formData = new FormData($paymentForm[0])
    formData.append('plan_id', plan_id);
    formData.append('user_id', user_id);
    if (user_id == 0) {
        setTimeout(function () {
            window.location.href = APP_URL + '/login';
        }, 5000);
    } else {
        axios
            .post(APP_URL + '/session', formData)
            .then(function (response) {
                setTimeout(function () {
                    window.location.href = response.data.redirect_url;
                }, 5000);
                loaderHide();
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }

})


function addChildBtnRefresh() {
    $.ajax({
        url: APP_URL + '/addChildBtnRefresh',
        method: 'GET',

    }).done(function (data) {
        $('#add-child-btn').html(data.data)

    }).fail(function (jqXHR, textStatus) {
        loaderHide()
        console.log('Request failed: ' + textStatus)
    })
}