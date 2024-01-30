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
                                         $user = DB::table('users')->where('id',$user_id)->first();
                                    }else{
                                        $user_id = 0;
                                        $user = null;
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
                                                <a href="javascript:void(0);" class="show-message" data-message="You are already on the free plan">Free Sign-up</a>
                                            @else
                                                @if(!is_null($user))
                                                    @if($user->plan_id == $plan->id)
                                                        @if(!is_null($user->plan_created_at))
                                                            @if(\Carbon\Carbon::parse($user->plan_created_at)->addMonths(1)->lt(\Carbon\Carbon::now()))
                                                                <a class="subscriptionFormSubmit"
                                                                   data-plan-id="{{$plan->id}}"
                                                                   data-user-id="{{$user_id}}">Upgrade
                                                                </a>
                                                            @else
                                                                <a class="show-message" data-message="You are already on the {{$plan->title}} plan">Subscribe</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <a class="subscriptionFormSubmit" data-plan-id="{{$plan->id}}"
                                                           data-user-id="{{$user_id}}">Subscribe
                                                        </a>
                                                    @endif
                                                @else
                                                    <a class="subscriptionFormSubmit" data-plan-id="{{$plan->id}}"
                                                       data-user-id="{{$user_id}}">Subscribe
                                                    </a>
                                                @endif

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
    <script>
        $(document).ready(function(){
            $('.show-message').click(function(){
                toastr.remove();
                toastr.error($(this).attr('data-message'));
            });
        });
    </script>
@endsection
