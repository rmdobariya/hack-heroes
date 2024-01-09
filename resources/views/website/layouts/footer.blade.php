<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="links">
                            <h2>HackHeroes</h2>
                            <ul>
                                <li><a href="{{route('home')}}" class="active">Home</a></li>
                                <li><a href="#hero">About Us</a></li>
                                <li><a href="#how_it_works">How it Works</a></li>
                                <li><a href="#benefits">Benefits</a></li>
                                <li><a href="#updated">Stay Updated</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="links">
                            <h2>Join us</h2>
                            <ul>
                                <li><a href="{{route('signup')}}">Create Account</a></li>
                                <li><a href="{{route('login')}}">Login Now</a></li>
                                <li><a href="{{asset($terms_condition)}}" target="_blank">Terms &
                                        Conditions</a></li>
                                <li><a href="{{asset($privacy_policy)}}" target="_blank">Privacy
                                        Policy</a></li>
                                <li><a class="icon-contact" href="#getintouch" data-href="{{route('contact-us')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="links">
                            <h2>Connect</h2>
                            <ul>
                                <li><a target="_blank" href="https://www.facebook.com/hackheroes"><img
                                            src="{{asset('assets/web/images/facebook.png')}}">Facebook</a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/company/hackheroes/about/"><img
                                            src="{{asset('assets/web/images/linkedin.png')}}">LinkedIn</a></li>
                                <li><a target="_blank" href="https://www.instagram.com/hackheroes/"><img
                                            src="{{asset('assets/web/images/instagram.png')}}">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-8 offset-md-4">
                        <div class="f-logo">
                            <a href="{{route('home')}}" data-aos="fade-up" data-aos-delay="200">
                                <img src="{{asset('assets/web/images/footer-logo.png')}}" alt="footer-logo">
                                <img src="{{asset($logo)}}" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <p class="copyright">
                    Copyright &copy; HackHeroes Pty Ltd {{date('Y')}} | All rights reserved. HackHeroes® and our mascot logo are
                    protected under trademark law.
                </p>
            </div>
        </div>
    </div>
</footer>
