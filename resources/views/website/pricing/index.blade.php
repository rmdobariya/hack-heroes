@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid pricing">
            <div class="row">
                <div class="col-md-12 width-100">
                    <div class="left-signup">
                        <h1>Select HackHeroes Pricing</h1>
                        <div class="row">
                            @foreach($plans as $plan)
                            <div class="col-md-4 text-center">
                                <div class="price-box">
                                    <h2>{{$plan->title}}</h2>
                                    <span class="line"></span>
                                    <p>{{$plan->description}}</p>
                                    <span class="line"></span>
                                    <h1>${{$plan->amount}}</h1>
                                    <a href="#">Free Sign-up</a>
                                </div>
                            </div>
                            @endforeach
{{--                            <div class="col-md-4 text-center">--}}
                                {{--                                <div class="price-box popular">--}}
                                {{--                                    <h2>MOST POPULAR</h2>--}}
                                {{--                                    <span class="line"></span>--}}
                                {{--                                    <p>Get full access now. You are onboard for the full 3-month program.</p>--}}
                                {{--                                    <span class="line"></span>--}}
                                {{--                                    <h1>$39 <span> p/month</span></h1>--}}
                                {{--                                    <a href="#" class="active">Program Sign-up</a>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-md-4 text-center">--}}
{{--                                <div class="price-box">--}}
{{--                                    <h2>CANCEL ANYTIME</h2>--}}
{{--                                    <span class="line"></span>--}}
{{--                                    <p>Get full access now. Full 3-month program, cancel anytime - no contract.</p>--}}
{{--                                    <span class="line"></span>--}}
{{--                                    <h1>$79 <span> p/month</span></h1>--}}
{{--                                    <a href="#">Monthly Sign-up</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
