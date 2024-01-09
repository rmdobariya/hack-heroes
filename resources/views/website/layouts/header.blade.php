<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset($logo)}}" alt="logo" class="logo">
                <img src="{{asset('assets/web/images/logo.png')}}" alt="logo" class="hover-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{asset('assets/web/images/bar.png')}}" alt="menu">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how_it_works">How it Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#benefits">Benefits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#updated">Subscribe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link icon-contact" href="#getintouch"  data-href="{{route('contact-us')}}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link login" href="{{route('login')}}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signup" href="{{route('signup')}}">Create Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
