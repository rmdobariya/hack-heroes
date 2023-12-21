@extends('website.layouts.after-login.master')
@section('title')
    Update Profile
@endsection
@section('content')
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
                        @foreach($user_childrens as $user_children)
                            <div class="next-tasklist" data-aos="fade-up" data-aos-delay="200">
                                <div class="user-box">
                                    <img src="{{asset('assets/web/images/alex.svg')}}" alt="user">
                                    <h3>{{$user_children->name}}</h3>
                                </div>
                                <div class="task-list">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}">
                                                <label class="form-check-label" for="flexCheckDefault1">
                                                    Questionnaire
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}">
                                                <label class="form-check-label" for="flexCheckDefault2">
                                                    Unique Risk Profile
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}">
                                                <label class="form-check-label" for="flexCheckDefault3">
                                                    Modules for Month #1
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}">
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
                        @endforeach

{{--                        <div class="next-tasklist" data-aos="fade-up" data-aos-delay="400">--}}
{{--                            <div class="user-box">--}}
{{--                                <img src="{{asset('assets/web/images/taylor.svg')}}" alt="user">--}}
{{--                                <h3>Taylor</h3>--}}
{{--                            </div>--}}
{{--                            <div class="task-list">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                   id="flexCheckDefault5">--}}
{{--                                            <label class="form-check-label" for="flexCheckDefault5">--}}
{{--                                                Questionnaire--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                   id="flexCheckDefault6">--}}
{{--                                            <label class="form-check-label" for="flexCheckDefault6">--}}
{{--                                                Unique Risk Profile--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                   id="flexCheckDefault7">--}}
{{--                                            <label class="form-check-label" for="flexCheckDefault7">--}}
{{--                                                Modules for Month #1--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" value=""--}}
{{--                                                   id="flexCheckDefault8">--}}
{{--                                            <label class="form-check-label" for="flexCheckDefault8">--}}
{{--                                                View Recommendations for Month #1--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="btnlinks">--}}
{{--                                    <a href="#">> Continue</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
@endsection
@section('custom-script')
@endsection
