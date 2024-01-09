<section id="page-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="footer-menu">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{asset($terms_condition)}}" target="_blank">Terms & Conditions</a></li>
                        <li><a href="{{asset($privacy_policy)}}" target="_blank">Privacy Policy</a></li>
                        <li>Copyright &copy; HackHeroes Pty Ltd {{date('Y')}} | All rights reserved. HackHeroes® and our mascot logo are protected under trademark law.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="signup-footerlogo">
                    <a href="{{route('home')}}">
                        <img src="{{asset($logo)}}" alt="logo" class="f-logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
