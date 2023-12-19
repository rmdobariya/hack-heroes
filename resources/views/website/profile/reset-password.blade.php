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
                        <h2>Forgot your Password? <br>Enter your Email Address</h2>
                        <form>
                            <input type="email" name="email" id="forgot_email" placeholder="Email" class="form-control" required>
                            <button class="btn signup-btn login" type="button" id="send_mail">Send</button>
                            <p class="l-link d-none" id="resetmsg">Thank you. Please check your email account.</p>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-logoimg">
                        <img src="{{asset('assets/web/images/hero-img.png')}}" alt="logo">
                        <p>A study published in the journal 'Computers in Human Behaviour' in 2021 found that parental
                            involvement in their child's online activities was associated with a lower risk of
                            cyberbullying victimisation.*<br>*'Parental Mediation, Online Activities, and Cyberbullying'
                            by Gustavo Mesch.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
