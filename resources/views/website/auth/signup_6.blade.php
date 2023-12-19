@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 width-100">
                    <div class="left-signup info-pragraph">
                        <h1>HackHeroes</h1>
                        <b>Please select the option that you feel best represents Alex</b>
                        <div class="text-centers">
                            <form id="signupStore" method="post">
                                <div class="form-check mt-5">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Alex does not experience, or experiences occasional, mild conflicts or disagreements with peers at school
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Alex faces some negative interactions or discomfort at school due to cyberbullying, resulting in noticeable changes in their behaviour, such as increased anxiety or reluctance to attend school.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Alex experiences persistent and severe cyberbullying victimisation at school, leading to significant  emotional distress, social withdrawal, academic decline, and potentially impacting their overall attendance and educational experience.
                                    </label>
                                </div>
                                <button class="btn signup-btn link-btn" type="submit">Submit</button>
                            </form>
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
            var new_input="<div class='input-box'><div class='form-check'><input name='name_"+new_chq_no+"'  class='form-check-input' type='checkbox' id='new_"+new_chq_no+"'><label class='form-check-label' for='new_"+new_chq_no+"'>Alex</label></div></div>";
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
