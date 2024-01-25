@extends('website.layouts.auth.master')
@section('title')
    Purchaes
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
                                        <form action="/session" method="post" id="payment-form">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="total" value="{{$plan->amount}}">
                                            <input type="hidden" name="title" value="{{$plan->title}}">
                                            <input type="hidden" name="start_date" value="{{$plan->start_date}}">
                                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                            <input type="hidden" name="end_date" value="{{$plan->end_date}}">
                                            @if($loop->first)
                                                <a href="#">Free</a>
                                            @else
                                                <a id="subscription-submit">Subscription</a>
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
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('assets/web/custom/stripe.js') }}"></script>
    {{--    <script src="{{asset('assets/web/custom/purchase.js')}}?v={{time()}}"></script>--}}
@endsection
