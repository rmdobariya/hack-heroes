@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-signup">
                        <h1>HackHeroes</h1>
                        <h2>Join us today & get your personalised cyberbullying prevention plan</h2>
                        <form id="signup3" method="post">
                            <input type="text" name="name" placeholder="Child’s first name" value="{{Session::get('child_name') ? Session::get('child_name') : ''}}" class="form-control" required>
                            <div id="new_chq"></div>
                            <a href="javascript:void()" class="add-child" onclick="add()"><img src="{{asset('assets/web/images/plus-icon.png')}}"> Add another Child</a>
                            <button class="btn signup-btn" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="what-get text-center">
                                <h1>What you'll get</h1>
                                <h3>Our plan comes with</h3>
                                <div class="row whats-sign2">
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-1.png')}}" alt="what">
                                            <p>Tailored plan that suits your child’s profile</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-2.png')}}" alt="what">
                                            <p>Actionable recommendations</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-3.png')}}" alt="what">
                                            <p>Tracking feature to help monitor your actions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script>
        function add(){
            var new_chq_no = parseInt($('#total_chq').val())+1;
            var new_input="<input type='text' class='form-control' placeholder='Child’s first name' id='new_"+new_chq_no+"'required>";
            $('#new_chq').append(new_input);
            $('#total_chq').val(new_chq_no)
        }
        function remove(){
            var last_chq_no = $('#total_chq').val();
            if(last_chq_no>1){
                $('#new_'+last_chq_no).remove();
                $('#total_chq').val(last_chq_no-1);
            }
        }
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
