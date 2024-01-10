<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset($logo)}}" alt="logo" class="logo">
                <img src="{{asset('assets/web/images/logo.png')}}" alt="logo" class="hover-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{asset('assets/web/images/bar.png')}}" alt="menu">
            </button>
            <div class="collapse navbar-collapse fix-header" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link icon-contact" href="{{route('home')}}#getintouch"><img
                                src="{{asset('assets/web/images/contact-us.png')}}" alt="contact-us"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
