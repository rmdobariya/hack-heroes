<script src="{{asset('assets/web/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.min.js')}}"></script>
<script src='https://unpkg.com/aos@2.3.0/dist/aos.js'></script>
<script src="{{asset('assets/web/js/script.js')}}"></script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>

<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>x
<script src="{{ asset('assets/web/custom/custom.js') }}"></script>
<script>
    AOS.init({
        duration: 1200,
    })
</script>
<script>
    // function validate(event){
    //     event.preventDefault();
    //     $("form [data-required]").each(function(index){
    //         var $_this = $(this);
    //         var $_error = $_this.next(".error");
    //         if($_this.val().length == 0) {
    //             if($_error.length == 0){
    //                 $_this.after('<span class="error">'+$_this.data("error-message")+'</span>');
    //             }
    //         } else
    //             $_error.remove();
    //     });
    // }

    // $("form").on({"submit": function(){
    //         validate(event);
    //     },
    //     "change": function(){
    //         validate(event);
    //     }
    // });
</script>
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
    var JS_URL = '{{url('/')}}';
</script>
