@extends('website.layouts.after-login.master')
@section('title')
    Update Profile
@endsection
@section('content')
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
                            <h2>{{$plan->title}}</h2>
                            @if(!is_null($user))
                            @if(is_null($user->plan_id) || empty($user->plan_id))    
                            <a href="{{route('subscription')}}">> Upgrade</a>
                            @endif
                            @endif
                        </div>
                        <div class="plan-details">
                            <h2>${{$plan->amount }} <span>p/month</span></h2>
                            <ul>
                                @if($plan->id == 1)
                                    <li>Limited preview</li>
                                    <li>Top risks</li>
                                    <li>3 actionable recommendations</li>
                                @else
                                    <li>Full access</li>
                                    <li>Top risks</li>
                                    <li>20 actionable recommendations</li>
                                @endif
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
                            <h3 data-aos="fade-right" data-aos-delay="200">Your Children</h3>
                        </div>
                    </div>
                    @foreach($user_childrens as $key=>$user_children)
                        <div class="col-md-6">
                            <div class="children-list" data-aos="fade-up" data-aos-delay="200">
                                @if((string)$user_children->gender === 'male' || (string)$user_children->gender === 'intersex')
                                    <img src="{{asset('assets/web/images/alex.svg')}}" alt="user">
                                @else
                                    <img src="{{asset('assets/web/images/taylor.svg')}}" alt="user">
                                @endif
                                <h3>{{$user_children->name}}</h3>
                            </div>
                        </div>
                    @endforeach
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="children-list" data-aos="fade-up" data-aos-delay="400">--}}
                    {{--                            <img src="{{asset('assets/web/images/taylor.svg')}}" alt="user">--}}
                    {{--                            <h3>Taylor</h3>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-md-12">
                        <div class="add-child" data-aos="fade-right" data-aos-delay="300">
                            <a href="{{route('add-child-info')}}">+ Child</a>
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
                        <h1>Your Settings <a href="{{route('updateProfile')}}"><img
                                    src="{{asset('assets/web/images/edit.svg')}}" alt="edit"></a></h1>
                        <div class="det">
                            <b>Your Name</b>
                            <p>{{$user->full_name}}</p>
                        </div>
                        <div class="det">
                            <b>Your Email</b>
                            <p>{{$user->email}}</p>
                        </div>

                        @foreach($user_childrens as $key=>$user_children)
                            <div class="det">
                                <b>Your Child #{{$key+1}}</b>
                                <p>{{$user_children->name}} ({{$user_children->gender}})</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="your-settings" data-aos="fade-up" data-aos-delay="400">
                        <h1>Help & Support</h1>
                        <div class="det">
                            <a class="icon-contact" href="{{route('contact-us')}}">Contact Us</a>
                        </div>
                        <div class="det">
                            <a href="{{asset($terms_condition)}}" target="_blank">Terms & Conditions</a>
                        </div>
                        <div class="det">
                            <a href="{{asset($privacy_policy)}}" target="_blank">Privacy Policy</a>
                        </div>
                        <div class="det">
                            <a href="{{route('logout')}}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
