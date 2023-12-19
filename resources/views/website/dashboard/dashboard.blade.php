<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes - Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{asset('assets/web/images/bar.png')}}" alt="menu">
            </button>
            <div class="collapse navbar-collapse fix-header" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img src="{{asset('assets/web/images/grid.png')}}" alt="grid"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('assets/web/images/box.png')}}" alt="box"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}#getintouch"><img src="{{asset('assets/web/images/contact-us.png')}}" alt="contact-us"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}"><img src="{{asset('assets/web/images/user.png')}}" alt="user"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div id="main">
    <section class="feature dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-white">
                    <div class="f-caption" data-aos="fade-up" data-aos-delay="100">
                        <h1>Dashboard</h1>
                        <h2>Enjoy the program, {{$user->full_name}}</h2>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{asset('assets/web/images/hero-img.png')}}">
                </div>
            </div>
        </div>
    </section>

    <section class="next-task">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1 data-aos="fade-right" data-aos-delay="200">Your next tasks</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="next-tasklist" data-aos="fade-up" data-aos-delay="200">
                        <div class="user-box">
                            <img src="{{asset('assets/web/images/alex.svg')}}" alt="user">
                            <h3>Alex</h3>
                        </div>
                        <div class="task-list">
                            <ul>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                        <label class="form-check-label" for="flexCheckDefault1">
                                            Questionnaire
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            Unique Risk Profile
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                        <label class="form-check-label" for="flexCheckDefault3">
                                            Modules for Month #1
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                        <label class="form-check-label" for="flexCheckDefault4">
                                            View Recommendations for Month #1
                                        </label>
                                    </div>
                                </li>
                            </ul>
                            <div class="btnlinks">
                                <a href="#">> Continue</a>
                            </div>
                        </div>
                    </div>
                    <div class="next-tasklist" data-aos="fade-up" data-aos-delay="400">
                        <div class="user-box">
                            <img src="{{asset('assets/web/images/taylor.svg')}}" alt="user">
                            <h3>Taylor</h3>
                        </div>
                        <div class="task-list">
                            <ul>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Questionnaire
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                                        <label class="form-check-label" for="flexCheckDefault6">
                                            Unique Risk Profile
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                                        <label class="form-check-label" for="flexCheckDefault7">
                                            Modules for Month #1
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                                        <label class="form-check-label" for="flexCheckDefault8">
                                            View Recommendations for Month #1
                                        </label>
                                    </div>
                                </li>
                            </ul>
                            <div class="btnlinks">
                                <a href="#">> Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section id="progress">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-heading-1">
                    <h1 data-aos="fade-right" data-aos-delay="200">Your progress</h1>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="progress-box active" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{asset('assets/web/images/progress-1.svg')}}" alt="progress">
                    <h2>Month #1</h2>
                    <p>18 Done</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="progress-box" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{asset('assets/web/images/progress-2.svg')}}" alt="progress">
                    <h2>Month #2</h2>
                    <p>0 Done</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="progress-box" data-aos="fade-up" data-aos-delay="500">
                    <img src="{{asset('assets/web/images/progress-3.svg')}}" alt="progress">
                    <h2>Month #3</h2>
                    <p>0 Done</p>
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
                        <li><a href="{{route('dashboard')}}" class="active">Dashboard</a></li>
                        <li><a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Terms & Conditions</a></li>
                        <li><a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank">Privacy Policy</a></li>
                        <li>Copyright &copy; HackHeroes 2023</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="signup-footerlogo">
                    <a href="{{route('dashboard')}}">
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
