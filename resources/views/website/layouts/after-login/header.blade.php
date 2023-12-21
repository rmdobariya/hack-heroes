<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                @php
                    $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
                @endphp
                <img src="{{asset('assets/web/images/logo-txt.png')}}" alt="logo" class="logo">
                <img src="{{asset('assets/web/images/logo.png')}}" alt="logo" class="hover-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{asset('assets/web/images/bar.png')}}" alt="menu">
            </button>
            <div class="collapse navbar-collapse fix-header" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('assets/web/images/grid.png')}}" alt="grid"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('assets/web/images/box.png')}}" alt="box"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact-us')}}"><img src="{{asset('assets/web/images/contact-us.png')}}" alt="contact-us"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('profile')}}"><img src="{{asset('assets/web/images/user.png')}}" alt="user"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
