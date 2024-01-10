@extends('website.layouts.after-login.master')
@section('title')
    Matrix
@endsection
@section('content')
    <section class="feature dashboard contactus-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-white">
                    <div class="f-caption">
                        <h1 data-aos="fade-right" data-aos-delay="200">Results for {{$child->name}}</h1>
                        <h3 data-aos="fade-up" data-aos-delay="400">We’ve broken down what you’ve told us, and generated
                            a personalised cyberbullying prevention plan for {{$child->name}}</h3>
                        @if($impact_score == 0)
                            <h3 data-aos="fade-up" data-aos-delay="400">Click on the link below to complete your signup process is incomplete
                            </h3>
                            <a data-aos="fade-up" data-aos-delay="400" class="line-button" href="#">Signup</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 offset-md-2">
                    <img src="{{asset('assets/web/images/hero-img.png')}}" data-aos="fade-left" data-aos-delay="300">
                </div>
            </div>
        </div>

    </section>
    @if($impact_score != 0)
        <div id="main">
            <section id="summary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="summary-block">
                                <div class="summary-left" data-aos="fade-right" data-aos-delay="300">
                                    <h2>Summary</h2>
                                    <b>{{$child->name}}’s top 5 risks </b>
                                    <p>Click on the risk to view detailed description</p>
                                    <div class="summary-list">
                                        @foreach($risks as $key=>$risk)
                                            <div class="list-box risk_event @if($loop->first) active @endif"
                                                 data-id="{{$risk->id}}" data-child-id="{{$child->id}}">
                                                <p style="cursor: pointer"><img src="{{asset('assets/web/emoji/'.$risk->icon)}}"> {{$risk->name}}</a></p>
                                            </div>
                                        @endforeach
                                        <p>{{$child->name}}’s other risks </p>
                                        @foreach($other_risks as $other_risk)
                                            <div class="list-box risk_event" data-id="{{$other_risk->id}}"
                                                 data-child-id="{{$child->id}}">
                                                <p style="cursor: pointer"><img src="{{asset('assets/web/emoji/'.$other_risk->icon)}}"> {{$other_risk->name}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="summary-right risk_wise_detail" id="risk_wise_detail" data-aos="fade-left"
                                     data-aos-delay="300">
                                    <div class="downloads">
                                        <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank"><img
                                                src="{{asset('assets/web/images/download.svg')}}" alt="download"></a>
                                    </div>
                                    @php
                                        $first_risk = DB::table('risks')->where('id',1)->first();

                                    @endphp
                                    <h4>{{$first_risk->name}}</h4>
                                    <p>{{$first_risk->description}}</p>
                                    <h4>Research We Trust</h4>
                                    <p>{{$first_risk->research_we_trust}}</p>
                                    <div class="rating-box">
                                        <h4>{{$child->name}}’s age risk rating</h4>
                                        <p>Likelihood <span>{{$likelihood_score}}</span></p>
                                        <p>Impact <span>{{$impact_score}}</span></p>
                                    </div>
                                    <div class="text-center">
                                        <a href="#recommendations" class="btn btn-viewrecom recommendation"
                                           data-name="{{$first_risk->name}}" data-id="{{$child->id}}">View
                                            Recommendations</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="riskmatrix" style="display:none;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="matrix-box">
                                <div class="heading">
                                    <h2>Risk Matrix </h2>
                                    <p>Explore the risks by clicking on the emojis for details</p>
                                </div>
                                <div class="matrix-table">
                                    <!-- Developer-code Delete next image div-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="delete-div">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="myChart" width="400" height="400"></canvas>
{{--                            <img src="{{asset('assets/web/images/risk-matrix.png')}}" alt="risk-matrix">--}}
                        </div>
                    </div>
                </div>
            </div>

            <div id="render_recommendation_part">
                <section id="recommendations">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading">
                                    <h2 data-aos="fade-right" data-aos-delay="100">Recommendations
                                        for {{$child->name}}</h2>
                                    <div class="form-filter" data-aos="fade-left" data-aos-delay="200">
                                        <select class="form-control form-select">
                                            <option>All Categories</option>
                                            <option>Risk categories</option>
                                            <option>Age</option>
                                            <option>Frequency</option>
                                        </select>
                                        <i class="las la-filter"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                @foreach($recommendations as $recommendation)
                                    <div class="recomm-box" data-aos="fade-up" data-aos-delay="200">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2>{{$recommendation->title_for_recommendation}}</h2>
                                                <b>{{$recommendation->sub_text_for_recommendation}}</b>
                                                <p>{{$recommendation->recommendation}}<a
                                                        href="javascript:void(0);">more</a>
                                                </p>
                                                @php
                                                    $tags = explode('; ',$recommendation->tags_for_associated_risk);
                                                @endphp
                                                @foreach($tags as $tag)
                                                    <span>{{$tag}}</span>
                                                @endforeach
                                            </div>
                                            <div class="col-md-4">
                                                <div class="options-btn">
                                                    <a href="javascript:void(0);" class="line-btns">More</a>
                                                    <a href="https://calendar.google.com/" target="_blank"
                                                       class="dark-btns"><i
                                                            class="las la-calendar-alt"></i> Add to Calendar</a>
                                                    <a href="{{asset('assets/web/images/privacy-policy.pdf')}}"
                                                       target="_blank"
                                                       class="dark-btns"><i class="las la-arrow-down"></i> Download
                                                        Resource</a>
                                                    <a href="{{ route('dashboard') }}" class="dark-btns">Done</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <section id="upgrade">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <h2 data-aos="fade-right" data-aos-delay="200">Find value in the above? Upgrade for
                                    more</h2>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="upgrade-plan" data-aos="fade-up" data-aos-delay="200">
                                <h3>Teach your child about online privacy and help them adjust...</h3>
                                <a href="pricing.html">Upgrade Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/matrix.js')}}?v={{time()}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var data = {
            labels: ['Age', 'Sex', 'Geographic location','Current mental health','Previous mental health','Language','Online behaviour','Socioeconomic status','Sexual orientation','School attendance','Parental involvement','Support system','access the Internet','School climate','Family structure','Academic performance','Online activity frequency','Peer relationships','Relationship status'],
            datasets: [{
                label: 'Possible',
                data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], // Replace with your data for 'Possible'
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Likely',
                data: [19,18,17,16,15,14,13,12,11,10,9,8,7,6,5,4,3,2,1], // Replace with your data for 'Likely'
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Unlikely',
                data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], // Replace with your data for 'Unlikely'
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Impact Levels'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: ['Unlikely','Likely','possible']
                    }
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
@endsection
