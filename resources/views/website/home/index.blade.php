@extends('website.layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <section id="hero">
        <div class="container hero-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="hero-caption">
                        <h1 data-aos="fade-up" data-aos-delay="100">HackHeroes<sup>&reg;</sup> is Personalised
                            Cyberbullying
                            Prevention</h1>
                        <h2 data-aos="fade-up" data-aos-delay="200">Focused on Cyber Safety, Designed for Your
                            Child</h2>
                        <p data-aos="fade-up" data-aos-delay="300">Specialist-backed recommendations uniquely tailored
                            to
                            your family empower you to safeguard your child online. Our platform addresses the
                            intricacies
                            of cyberbullying head-on. Dive in with HackHeroes, and fortify your child’s online
                            journey.</p>
                        <a href="{{route('signup')}}" class="line-button" data-aos="fade-up" data-aos-delay="400">Join
                            now, it's
                            free</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hero-img" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{asset('assets/web/images/hero-img.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="main">
        <section class="feature">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 order-22" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset('assets/web/images/HackHeroes-1.png')}}" alt="HackHeroes">
                    </div>
                    <div class="col-md-6 text-white order-11" data-aos="fade-up" data-aos-delay="300">
                        <div class="f-caption">
                            <h2>Make Digital Safety Simple, Personal, and Effective</h2>
                            <p>37% of youths face online bullying; only 10% confide in parents.* Bridging the gap,
                                HackHeroes enables parents to be proactive protectors. <span> <a
                                        href="https://www.unicef.org/press-releases/unicef-poll-more-third-young-people-30-countries-report-being-victim-online-bullying"
                                        target="_blank">*'UNICEF poll: More than a third of young people in 30 countries report being a victim of online bullying.' UNICEF.</a> <a
                                        href="http://archive.ncpc.org/resources/files/pdf/bullying/cyberbullying.pdf"
                                        target="_blank">'Stop Cyberbullying Before it Starts.' National Crime Prevention Council.</a></span>
                            </p>
                            <a href="{{route('signup')}}" class="line-button">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="feature" id="how_it_works">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="f-caption" data-aos="fade-up" data-aos-delay="200">
                            <h2>How HackHeroes Works</h2>
                            <p>Begin with our in-depth survey, capturing not just your child's online habits but also
                                their
                                personal characteristics and social environment. Based on your responses, HackHeroes
                                crafts
                                a personalised cyberbullying prevention plan. Every plan is unique, just like your
                                child.</p>
                            <a href="{{route('signup')}}" class="line-button dark-btn">Join for free</a>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('assets/web/images/HackHeroes-2.png')}}" alt="HackHeroes">
                    </div>
                </div>
            </div>
        </section>
        <section class="feature" id="benefits">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 order-22" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('assets/web/images/HackHeroes-3.png')}}" alt="HackHeroes">
                    </div>
                    <div class="col-md-6 order-11">
                        <div class="f-caption" data-aos="fade-up" data-aos-delay="200">
                            <h2>The Benefits of HackHeroes</h2>
                            <p>Become the digital guardian your child needs with actionable, tailored recommendations.
                                Integrate these cyber safety steps into daily life with our 'add-to-calendar' feature.
                                Relish the peace of mind that comes with expert-backed strategies, prioritising your
                                child's
                                digital well-being.</p>
                            <a href="{{route('signup')}}" class="line-button dark-btn">Create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sec-heading-1">
                        <h2 data-aos="fade-right" data-aos-delay="200">HackHeroes Pricing</h2>
                        <a href="{{route('pricing')}}" data-aos="fade-left" data-aos-delay="200"> > Start now, it’s
                            Free</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $delay = 500;
                @endphp
                @foreach($plans  as $plan)
                    @php
                        $delay += 500;
                    @endphp
                    <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="{{$delay}}">
                        <div class="price-box @if($plan->title == 'MOST POPULAR') popular @endif">
                            <h2>{{$plan->title}}</h2>
                            <span class="line"></span>
                            <p>{{$plan->description}}</p>
                            <span class="line"></span>
                            <h3>${{$plan->amount}}
                                @if($plan->amount > 0)
                                <span> p/month</span>
                                @endif
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="updated">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="updated-box">
                        <h2 class="text-center" data-aos="fade-down" data-aos-delay="200">Stay Updated with
                            HackHeroes</h2>
                        <p data-aos="fade-up" data-aos-delay="100"><img src="{{asset('assets/web/images/check.png')}}">
                            Receive curated content
                            about the latest in online protection trends and research</p>
                        <p data-aos="fade-up" data-aos-delay="200"><img src="{{asset('assets/web/images/check.png')}}">
                            Be the first to hear about
                            special deals and new features from HackHeroes</p>
                        <p data-aos="fade-up" data-aos-delay="300"><img src="{{asset('assets/web/images/check.png')}}">
                            Learn from the experiences
                            of other parents and share in the HackHeroes journey</p>
                        <p data-aos="fade-up" data-aos-delay="400"><img src="{{asset('assets/web/images/check.png')}}">
                            Join our community and arm
                            yourself with knowledge</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email address"
                                           name="subscribe_email" id="subscribe_email"
                                           aria-label="Recipient's username" aria-describedby="button-addon2"
                                           data-aos="fade-right" data-aos-delay="200">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                            data-aos="fade-left" data-aos-delay="200">Subscribe
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sec-heading-1">
                        <h2 data-aos="fade-right" data-aos-delay="200">HackHeroes FAQs</h2>
                        <a href="{{route('signup')}}" data-aos="fade-left" data-aos-delay="200">> Create Account </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    @php
                        $delay = 0;
                    @endphp
                    @foreach($faqs as $key =>$faq)
                        @php
                            $delay += 100;
                        @endphp
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{$delay}}">
                            <h2 class="accordion-header" id="heading_{{$key}}">
                                <button class="accordion-button @if($key != 0) collapsed @endif" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse_{{$key}}"
                                        aria-expanded="@if($key != 0) ? 'false' @else 'true' @endif"
                                        aria-controls="collapse_{{$key}}">
                                    {{$faq->question}}
                                </button>
                            </h2>
                            <div id="collapse_{{$key}}" class="accordion-collapse collapse @if($key == 0) show @endif"
                                 aria-labelledby="heading_{{$key}}"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{$faq->answer}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="getintouch">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="updated-box">
                        <h2 class="text-center" data-aos="fade-up" data-aos-delay="200">Get in Touch Now</h2>
                        <h3 data-aos="fade-up" data-aos-delay="200">Our dedicated HackHeroes team will reply to you
                            promptly.</h3>
                        <form id="getInTouchForm">
                            <input type="text" name="name" class="form-control" placeholder="Name" data-aos="fade-up"
                                   data-aos-delay="100" data-required
                                   data-error-message="Name is required!">
                            <input type="email" name="email" class="form-control" placeholder="Email" data-aos="fade-up"
                                   data-aos-delay="200" data-required
                                   data-error-message="Email is required!">
                            <textarea class="form-control" name="message" placeholder="Message" rows="3"
                                      data-aos="fade-up"
                                      data-aos-delay="300" data-required
                                      data-error-message="Message is required!"></textarea>
                            <button class="btn btn-themecolor" type="submit" data-aos="fade-up" data-aos-delay="400">
                                Send
                            </button>
                            <br><span class="success d-none" id="get-in-touch-msg">Form submitted successfully</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/home.js')}}?v={{time()}}"></script>
@endsection
