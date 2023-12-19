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
                        <h2>Get started on your personalised cyberbullying prevention plan</h2>
                        <form id="signup5" method="post">
                            <p>Create plan for</p>
                            <div class="input-box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="plan" id="name" @if(Session::get('plan') == 'on') checked @endif required>
                                    <label class="form-check-label" for="name">
                                        Alex
                                    </label>
                                </div>
                            </div>
                            <div id="new_chq"></div>
                            <a href="javascript:void()" class="add-child" onclick="add()"><img src="{{asset('assets/web/images/plus-icon.png')}}"> Add another Child</a>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="term_condition" id="flexCheckDefault" @if(Session::get('term_condition') == 'on') checked @endif required>
                                <label class="form-check-label mb-4" for="flexCheckDefault">
                                    I have read the <a href="#">Privacy & Terms</a> and understand how the information I provide will be used.
                                </label>
                            </div>

                            <button class="btn signup-btn" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="what-get text-center">
                                <h1>How it Works</h1>
                                <h3>Our plan comes with</h3>
                                <div class="row whats-sign2">
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-1.png')}}" alt="how-it-works">
                                            <p>Help us understand your child by answering questions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-2.png')}}" alt="how-it-works">
                                            <p>View results</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-3.png')}}" alt="how-it-works">
                                            <p>Personalised plan that suits your child’s profile</p>
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
            var new_input="<div class='input-box'><div class='form-check'><input name='plan_"+new_chq_no+"'  class='form-check-input' type='checkbox' id='new_"+new_chq_no+"' required><label class='form-check-label' for='new_"+new_chq_no+"'>Alex</label></div></div>";
            //var new_input="<input type='text' class='form-control' placeholder='Child’s first name' id='new_"+new_chq_no+"'>";
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
