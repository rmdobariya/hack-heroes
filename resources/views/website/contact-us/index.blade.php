@extends('website.layouts.after-login.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <section class="feature dashboard contactus-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-white">
                    <div class="f-caption" data-aos="fade-right" data-aos-delay="200">
                        <h1>Contact Us</h1>
                        <h2>We’re here to help you</h2>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1" data-aos="fade-left" data-aos-delay="300">
                    <img src="{{asset('assets/web/images/hero-img.png')}}">
                </div>
            </div>
        </div>
    </section>
    <div id="main">
        <section class="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="heading">
                            <p data-aos="fade-right" data-aos-delay="200">Our dedicated HackHeroes team will reply to you promptly.</p>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3 text-center" data-aos="fade-up" data-aos-delay="300">
                        <form id="getInTouchForm" class="error-message">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <textarea class="form-control" name="message" placeholder="Message" rows="3"></textarea>
                            <button class="btn btn-themecolor" type="submit">Send</button>
                            <br><span class="success d-none" id="get-in-touch-msg">Form submitted successfully</span>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="social-media">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="heading">
                            <h1 data-aos="fade-left" data-aos-delay="100">We’re on social media</h1>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="socialm-links">
{{--                                <a href="{{$facebook_link}}" target="_blank" data-aos="fade-up" data-aos-delay="100"><img--}}
{{--                                        src="{{asset('assets/web/images/facebook.png')}}" alt="facebook"></a>--}}
{{--                                <a href="#" target="_blank" data-aos="fade-up" data-aos-delay="200"><img--}}
{{--                                        src="{{asset('assets/web/images/linkedin.png')}}" alt="linkedin"></a>--}}
{{--                                <a href="{{$insta_link}}" target="_blank" data-aos="fade-up" data-aos-delay="300"><img--}}
{{--                                        src="{{asset('assets/web/images/instagram.png')}}" alt="instagram"></a>--}}
                            <a href="https://www.facebook.com/hackheroes" target="_blank" data-aos="fade-up" data-aos-delay="100"><img src="{{asset('assets/web/images/facebook.png')}}" alt="facebook"></a>
                            <a href="https://www.linkedin.com/company/hackheroes/about/" target="_blank" data-aos="fade-up" data-aos-delay="200"><img src="{{asset('assets/web/images/linkedin.png')}}" alt="linkedin"></a>
                            <a href="https://www.instagram.com/hackheroes/" target="_blank" data-aos="fade-up" data-aos-delay="300"><img src="{{asset('assets/web/images/instagram.png')}}" alt="instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/home.js')}}?v={{time()}}"></script>
@endsection
