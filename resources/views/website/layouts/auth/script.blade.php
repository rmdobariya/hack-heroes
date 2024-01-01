<script src="{{asset('assets/web/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/web/js/script.js')}}"></script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>

<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('assets/admin/custom/custom.js') }}"></script>
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
    var JS_URL = '{{url('/')}}';
 </script>
