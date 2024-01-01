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
                        <h2>Keep your information safe by creating a password</h2>
                        <form id="signup4" method="post">
                            <input type="password" name="password" placeholder="Create a Password" class="form-control">
                            <ul>
                                <li>Number</li>
                                <li>Symbol</li>
                                <li>Uppercase letter</li>
                                <li>At least 12 characters long</li>
                                <li>Lowercase letter</li>
                            </ul>
                            <button class="btn signup-btn" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row darkbg">
                        <div class="col-md-12">
                            <div class="what-get text-center">
                                <h2>Our Affiliates</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <a href="https://bitdefender.f9tmep.net/Nkoq2q" target="_blank">
                                                <img src="{{asset('assets/web/images/our-affiliates-1.png')}}"
                                                     alt="our-affiliates">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <a href="https://nordvpn.com/special/?utm_medium=affiliate&utm_term&utm_content&utm_campaign=off15&utm_source=aff89536"
                                               target="_blank">
                                                <img src="{{asset('assets/web/images/our-affiliates-2.png')}}"
                                                     alt="our-affiliates">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <a href="http://www.awin1.com/cread.php?awinmid=7874&awinaffid=1376793"
                                               target="_blank">
                                                <img src="{{asset('assets/web/images/our-affiliates-3.png')}}"
                                                     alt="our-affiliates">
                                            </a>
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
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection

