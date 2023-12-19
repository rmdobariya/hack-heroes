@extends('website.layouts.auth.master')
@section('title')
    Login
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-signup">
                        <h1>HackHeroes</h1>
                        <h2>Sign in to access My Account</h2>
                        <form id="loginForm">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                            <button class="btn signup-btn login">Sign-in</button>
                            <p class="l-link">Don't have an account?<a href="{{route('signup')}}"> Create Account</a></p>
                            <p class="l-link">Forgot password?<a href="{{route('forgetPassword')}}"> Reset Password</a></p>
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
