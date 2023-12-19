<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes - Profile</title>
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel='stylesheet' href='https://unpkg.com/aos@2.3.0/dist/aos.css'>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/style.css')}}">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('assets/web/images/logo-txt.png')}}" alt="logo" class="logo">
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
                        <a class="nav-link" href="#"><img src="{{asset('assets/web/images/grid.png')}}" alt="grid"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('assets/web/images/box.png')}}" alt="box"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}#getintouch"><img src="{{asset('assets/web/images/contact-us.png')}}"
                                                                              alt="contact-us"></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('profile')}}"><img src="{{asset('assets/web/images/user.png')}}" alt="user"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section class="feature dashboard contactus-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-white">
                <div class="f-caption">
                    <h1 data-aos="fade-right" data-aos-delay="200">Hello {{$user->full_name}}</h1>
                    <h2 data-aos="fade-right" data-aos-delay="500">Congrats on your progress</h2>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-plan" data-aos="fade-left" data-aos-delay="400">
                    <div class="plan-header">
                        <h2>Plan</h2>
                        <a href="#">> Upgrade</a>
                    </div>
                    <div class="plan-details">
                        <h2>$39 <span>p/month</span></h2>
                        <ul>
                            <li>Full access</li>
                            <li>Top risks</li>
                            <li>20 actionable recommendations</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="main">
    <section class="next-task">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1 data-aos="fade-right" data-aos-delay="200">Your Children</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="children-list" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset('assets/web/images/alex.svg')}}" alt="user">
                        <h3>Alex</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="children-list" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{asset('assets/web/images/taylor.svg')}}" alt="user">
                        <h3>Taylor</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="add-child" data-aos="fade-right" data-aos-delay="300">
                        <a href="#">+ Child</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section id="settings">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="your-settings" data-aos="fade-up" data-aos-delay="200">
                    <h1>Your Settings <a href="settings.html"><img src="{{asset('assets/web/images/edit.svg')}}" alt="edit"></a></h1>
                    <div class="det">
                        <b>Your Name</b>
                        <p>{{$user->full_name}}</p>
                    </div>
                    <div class="det">
                        <b>Your Email</b>
                        <p>{{$user->email}}</p>
                    </div>
                    <div class="det">
                        <b>Your Child #1</b>
                        <p>Alex</p>
                    </div>
                    <div class="det">
                        <b>Your Child #2</b>
                        <p>Taylor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="your-settings" data-aos="fade-up" data-aos-delay="400">
                    <h1>Help & Support</h1>
                    <div class="det">
                        <a href="contact-us.html">Contact Us</a>
                    </div>
                    <div class="det">
                        <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Terms & Conditions</a>
                    </div>
                    <div class="det">
                        <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Privacy Policy</a>
                    </div>
                    <div class="det">
                        <a href="{{route('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="page-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="footer-menu">
                    <ul>
                        <li><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Terms & Conditions</a></li>
                        <li><a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Privacy Policy</a></li>
                        <li>Copyright &copy; HackHeroes 2023</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="signup-footerlogo">
                    <a href="index.html">
                        <img src="{{asset('assets/web/images/logo-txt.png')}}" alt="logo" class="f-logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets/web/js/jquery-3.7.1.min.js')}}"></script>
<script src='https://unpkg.com/aos@2.3.0/dist/aos.js'></script>
<script src="{{asset('assets/web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/web/js/script.js')}}"></script>
<script>
    AOS.init({
        duration: 1200,
    })
</script>
</body>
</html>
