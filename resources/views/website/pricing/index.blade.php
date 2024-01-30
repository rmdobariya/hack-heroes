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
                                @php
                                    if (Auth::guard('web')->user()){
                                         $user_id = Auth::guard('web')->user()->id;
                                    }else{
                                        $user_id = 0;
                                    }

                                @endphp
                                <div class="col-md-4 text-center">
                                    <div class="price-box">
                                        <h2>{{$plan->title}}</h2>
                                        <span class="line"></span>
                                        <p>{{$plan->description}}</p>
                                        <span class="line"></span>
                                        <h3>${{$plan->amount }}
                                            @if($plan->amount > 0)
                                                <span> p/month</span>
                                            @endif
                                        </h3>
                                        <form id="payment-form">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="total" value="{{$plan->amount}}">
                                            <input type="hidden" name="title" value="{{$plan->title}}">
                                            <input type="hidden" name="start_date" value="{{$plan->start_date}}">
                                            <input type="hidden" name="end_date" value="{{$plan->end_date}}">
                                            @if($loop->first)
                                                <a href="javascript:void(0);" disabled>Free</a>
                                            @else
                                                <a class="subscriptionFormSubmit" data-plan-id="{{$plan->id}}"
                                                   data-user-id="{{$user_id}}">Subscribe</a>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            @endforeach
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
