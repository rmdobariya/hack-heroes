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
            // window.location.href = APP_URL + '/home';
            if (response.data.success == true){
                $getInTouchForm[0].reset();
                // notificationToast(response.data.message, 'success');
                $('#get-in-touch-msg').removeClass('d-none')
                window.location.reload();
            }

        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

$('#button-addon2').on('click',function (){
    var email = $('#subscribe_email').val();
    if (email == ''){
        notificationToast("Please Enter Your Email", 'warning')
    }else{
        loaderView();
        axios
            .post(APP_URL + '/subscribe',{email:email})
            .then(function (response) {
                loaderHide();
                $('#subscribe_email').val('');
                notificationToast(response.data.message, 'success');
            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    }
})
