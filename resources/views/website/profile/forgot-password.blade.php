@extends('website.layouts.auth.master')
@section('title')
    Forget Password
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-signup">
                        <h1>HackHeroes</h1>
                        <h2>Enter a New Password</h2>
                        <form id="forgotPasswordForm">
                            <input type="hidden" name="email" placeholder="Email" class="form-control" value="{{$email}}">
                            <input type="password" name="new_password" placeholder="Enter new password" class="form-control">
                            <input type="password" name="confirm_password" placeholder="Confirm new password" class="form-control">
                            <ul>
                                <li>One number</li>
                                <li>One special character</li>
                                <li>Uppercase character</li>
                                <li>12 characters minimum</li>
                                <li>Lowercase character</li>
                            </ul>
                            <button class="btn signup-btn login" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-logoimg">
                        <img src="{{asset('assets/web/images/hero-img.png')}}" alt="logo">
                        <p>A study published in the journal 'Computers in Human Behaviour' in 2021 found that parental involvement in their child's online activities was associated with a lower risk of cyberbullying victimisation.*<br>*'Parental Mediation, Online Activities, and Cyberbullying' by Gustavo Mesch.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection