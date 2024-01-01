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
                        <form id="signup2" method="post">
                            <input type="text" name="name" placeholder="Name" class="form-control">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                            <button class="btn signup-btn" type="submit">Let's go</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-logoimg">
                        <img src="{{asset('assets/web/images/hero-img.png')}}" alt="logo">
                        <p>A study published in the journal 'Computers in Human Behaviour' in 2021 found that parental involvement in their child's online activities was associated with a lower risk of cyberbullying victimisation.*<br><a href="https://www.researchgate.net/publication/26693782_Parental_Mediation_Online_Activities_and_Cyberbullying" target="_blank">*'Parental Mediation, Online Activities, and Cyberbullying' by Gustavo Mesch.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
