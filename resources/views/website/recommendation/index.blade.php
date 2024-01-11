@extends('website.layouts.after-login.master')
@section('title')
    Recommendation
@endsection
@section('content')
    <section class="feature dashboard contactus-page">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 text-center text-white">
                    <div class="f-caption">
                        <h1 data-aos="fade-up" data-aos-delay="200">{{$recommendation->title_for_recommendation}}</h1>
                        <h2 data-aos="fade-up" data-aos-delay="400">{{$recommendation->sub_text_for_recommendation}}</h2>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($recommendation->image))
        <div class="rec-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset($recommendation->image)}}" style="width: -webkit-fill-available" alt="{{$recommendation->title_for_recommendation}}">
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
    <div id="main">
        <section id="recommendations">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2 data-aos="fade-right" data-aos-delay="200">Recommendation for Taylor</h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="recomm-box active">
                            <div class="row">
                                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                                    <b>{{$recommendation->recommendation}}</b>
                                    @php
                                        $tags = explode('; ',$recommendation->tags_for_associated_risk);
                                    @endphp
                                    @foreach($tags as $tag)
                                        <span>{{$tag}}</span>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <div class="options-btn">
                                        <a href="https://calendar.google.com/" target="_blank" class="dark-btns" data-aos="fade-up" data-aos-delay="200"><i class="las la-calendar-alt"></i> Add to Calendar</a>
                                        <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank" class="dark-btns" data-aos="fade-up" data-aos-delay="400"><i class="las la-arrow-down"></i> Download Resource</a>
                                        <a href="{{route('matrix',$child_id)}}" class="dark-btns" data-aos="fade-up" data-aos-delay="600">Done</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back-link">
                            <a href="{{route('matrix',$child_id)}}">< Back to Results</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('custom-script')

@endsection
