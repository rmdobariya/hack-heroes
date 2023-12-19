@extends('website.layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <section id="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="hero-caption">
                        <h1 data-aos="fade-up" data-aos-delay="100">HackHeroes is Personalised Cyberbullying
                            Prevention</h1>
                        <h2 data-aos="fade-up" data-aos-delay="200">Focused on Cyber Safety, Designed for Your
                            Child</h2>
                        <p data-aos="fade-up" data-aos-delay="300">Specialist-backed recommendations uniquely tailored
                            to your family empower you to safeguard your child online. Our platform addresses the
                            intricacies of cyberbullying head-on. Dive in with HackHeroes, and fortify your child’s
                            online journey.</p>
                        <a href="#" class="line-button" data-aos="fade-up" data-aos-delay="400">Join now it's free</a>
                    </div>
                </div>
                <div class="col-md-4">
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
                    <div class="col-md-5 order-22" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset('assets/web/images/HackHeroes-1.png')}}" alt="HackHeroes">
                    </div>
                    <div class="col-md-6 offset-md-1 text-white order-11" data-aos="fade-up" data-aos-delay="300">
                        <div class="f-caption">
                            <h1>Make Digital Safety Simple, Personal, and Effective</h1>
                            <p>37% of youths face online bullying; only 10% confide in parents.* Bridging the gap,
                                HackHeroes enables parents to be proactive protectors. <span>*'UNICEF poll: More than a third of young people in 30 countries report being a victim of online bullying.' UNICEF. 'Stop Cyberbullying Before it Starts.' National Crime Prevention Council.</span>
                            </p>
                            <a href="#" class="line-button">Get started</a>
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
                            <h1>How HackHeroes Works</h1>
                            <p>Begin with our in-depth survey, capturing not just your child's online habits but also
                                their personal characteristics and social environment. Based on your responses,
                                HackHeroes crafts a personalised cyberbullying prevention plan. Every plan is unique,
                                just like your child.</p>
                            <a href="#" class="line-button dark-btn">Join for free</a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('assets/web/images/HackHeroes-2.png')}}" alt="HackHeroes">
                    </div>
                </div>
            </div>
        </section>
        <section class="feature" id="benefits">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 order-22" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('assets/web/images/HackHeroes-3.png')}}" alt="HackHeroes">
                    </div>
                    <div class="col-md-6 offset-md-1 order-11">
                        <div class="f-caption" data-aos="fade-up" data-aos-delay="200">
                            <h1>The Benefits of HackHeroes</h1>
                            <p>Become the digital guardian your child needs with actionable, tailored recommendations.
                                Integrate these cyber safety steps into daily life with our 'add-to-calendar' feature.
                                Relish the peace of mind that comes with expert-backed strategies, prioritising your
                                child's digital well-being.</p>
                            <a href="#" class="line-button dark-btn">Create an account</a>
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
                        <h1 data-aos="fade-right" data-aos-delay="200">HackHeroes Pricing</h1>
                        <a href="#" data-aos="fade-left" data-aos-delay="200"> > Start now, it’s Free</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="700">
                    <div class="price-box">
                        <h2>FREE</h2>
                        <span class="line"></span>
                        <p>Take the quiz now. Only get a limited preview of solutions. Good for curious parents.</p>
                        <span class="line"></span>
                        <h1>$0</h1>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="900">
                    <div class="price-box popular">
                        <h2>MOST POPULAR</h2>
                        <span class="line"></span>
                        <p>Get full access now. You are onboard for the full 3-month program.</p>
                        <span class="line"></span>
                        <h1>$39 <span> p/month</span></h1>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="1100">
                    <div class="price-box">
                        <h2>CANCEL ANYTIME</h2>
                        <span class="line"></span>
                        <p>Get full access now. Full 3-month program, cancel anytime - no contract.</p>
                        <span class="line"></span>
                        <h1>$79 <span> p/month</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="updated">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="updated-box">
                        <h1 class="text-center" data-aos="fade-down" data-aos-delay="200">Stay Updated with
                            HackHeroes</h1>
                        <p data-aos="fade-up" data-aos-delay="100"><img src="{{asset('assets/web/images/check.png')}}"> Receive curated content
                            about the latest in online protection trends and research</p>
                        <p data-aos="fade-up" data-aos-delay="200"><img src="{{asset('assets/web/images/check.png')}}"> Be the first to hear
                            about special deals and new features from HackHeroes</p>
                        <p data-aos="fade-up" data-aos-delay="300"><img src="{{asset('assets/web/images/check.png')}}"> Learn from the
                            experiences of other parents and share in the HackHeroes journey</p>
                        <p data-aos="fade-up" data-aos-delay="400"><img src="{{asset('assets/web/images/check.png')}}"> Join our community and
                            arm yourself with knowledge</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email address"
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
                        <h1 data-aos="fade-right" data-aos-delay="200">HackHeroes FAQs</h1>
                        <a href="{{route('signup')}}" data-aos="fade-left" data-aos-delay="200">> Create Account </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Is HackHeroes suitable for parents who are not tech-savvy?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Absolutely. HackHeroes' mission is to make digital safety accessible to all parents,
                                regardless of their technical background. Our platform offers straightforward,
                                jargon-free advice and step-by-step action plans that anyone can follow to safeguard
                                their children online.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How does HackHeroes integrate with our daily lives without being intrusive?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our 'add-to-calendar' feature ensures that recommended actions and check-ins are
                                conveniently scheduled according to your routine. We strive to make online safety a
                                seamless aspect of daily life without overwhelming parents or children with constant
                                alerts or disruptions.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How involved do parents need to be in the HackHeroes process?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Parental involvement is key to the success of our plans. While HackHeroes provides the
                                roadmap, parents are the drivers. The level of involvement can vary; some steps may
                                require more engagement, such as discussing online safety with your child, while others
                                are more about monitoring and gentle guidance.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                In what ways can HackHeroes customise the prevention plan for families with multiple
                                children?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                We recognise that each child has unique needs. HackHeroes allows parents to create
                                individual profiles for each child, taking into account their specific online habits,
                                social environments, and personal characteristics. Our platform then generates
                                customised prevention plans for each profile, ensuring that strategies are tailored to
                                each child within the family.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                What measures does HackHeroes take to ensure the privacy and security of my family's
                                data?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                The privacy and security of your family's information are paramount. HackHeroes follows
                                strict data protection regulations to safeguard your data. We never share your
                                information with third parties without your explicit consent.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="getintouch">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="updated-box">
                        <h1 class="text-center" data-aos="fade-up" data-aos-delay="200">Stay Updated with
                            HackHeroes</h1>
                        <p data-aos="fade-up" data-aos-delay="200">Our dedicated HackHeroes team will reply to you
                            promptly.</p>
                        <form id="getInTouchForm">
                            <input type="text" name="name" class="form-control" placeholder="Name *" data-aos="fade-up"
                                   data-aos-delay="100" data-required
                                   data-error-message="This space needs something before we proceed!">
                            <input type="email" name="email" class="form-control" placeholder="Email *"
                                   data-aos="fade-up" data-aos-delay="200" data-required
                                   data-error-message="This space needs something before we proceed!">
                            <textarea class="form-control" name="message" placeholder="Message" rows="3"
                                      data-aos="fade-up" data-aos-delay="300"></textarea>
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
