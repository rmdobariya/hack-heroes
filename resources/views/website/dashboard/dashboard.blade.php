@extends('website.layouts.after-login.master')
@section('title')
    Update Profile
@endsection
@section('content')
    <div id="main">
        <section class="feature dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-white">
                        <div class="f-caption" data-aos="fade-up" data-aos-delay="100">
                            <h1>Dashboard</h1>
                            <h2>Enjoy the program, {{$user->name}}</h2>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-3 " data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset('assets/web/images/hero-img.png')}}" class="hero-mascot">
                    </div>
                </div>
            </div>
        </section>

        <section class="next-task">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h3 data-aos="fade-right" data-aos-delay="200">Your next tasks</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @php
                            $delay = 0;
                        @endphp
                        @foreach($user_childrens as $user_children)
                            @php
                                $delay += 200;
                            @endphp
                            <div class="next-tasklist" data-aos="fade-up" data-aos-delay="{{$delay}}">
                                <div class="user-box">
                                    <img src="{{asset('assets/web/images/alex.svg')}}" alt="user">
                                    <h3>{{$user_children->name}}</h3> 
                                </div>
                                <div class="task-list">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault__{{$user_children->id}}" checked disabled>
                                                <label class="form-check-label"
                                                       for="flexCheckDefault__{{$user_children->id}}">
                                                    Questionnaire
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}" disabled>
                                                <label class="form-check-label"
                                                       for="flexCheckDefault_{{$user_children->id}}">
                                                    Unique Risk Profile
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}" disabled>
                                                <label class="form-check-label"
                                                       for="flexCheckDefault_{{$user_children->id}}">
                                                    Modules for Month #1
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="flexCheckDefault_{{$user_children->id}}" disabled>
                                                <label class="form-check-label"
                                                       for="flexCheckDefault_{{$user_children->id}}">
                                                    View Recommendations for Month #1
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="btnlinks">
                                        <a href="{{route('matrix',$user_children->id)}}">> Continue</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                        <h2 data-aos="fade-right" data-aos-delay="200">Your progress</h2>
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
