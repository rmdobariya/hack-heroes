@extends('website.layouts.after-login.master')
@section('title')
Matrix
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/web/css/matrix.css')}}">
<section class="feature dashboard contactus-page">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-white">
                <div class="f-caption">
                    <h1 data-aos="fade-right" data-aos-delay="200">Results for {{$child->name}}</h1>
                    <h3 data-aos="fade-up" data-aos-delay="400">We’ve broken down what you’ve told us, and generated
                        a personalised cyberbullying prevention plan for {{$child->name}}</h3>
                    @if($impact_score == 0)
                    <h3 data-aos="fade-up" data-aos-delay="400">Click on the link below to complete your signup
                        process is incomplete
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
@if($impact_score != 'pending_questionnaire')
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
                                @foreach($top_risks as $key=>$top_risk)
                                <div class="list-box risk_event @if($loop->first) active @endif" data-id="{{$top_risk->risk_id}}" data-child-id="{{$child->id}}">
                                    <p style="cursor: pointer">{{$risk_array[$top_risk->risk_key]}} {{isset($risk_titles[$top_risk->risk_key]) ? $risk_titles[$top_risk->risk_key] : ''}}</a>
                                    </p>
                                </div>
                                @endforeach
                                @php
                                $o_risks = DB::table('risk_score')->where('user_child_id', $child->id)->whereNotIn('id',$top_risks_ids)->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')->get();
                                @endphp
                                <p>{{$child->name}}’s other risks </p>
                                @foreach($o_risks as $o_risk)
                                <div class="list-box risk_event" data-id="{{$o_risk->risk_id}}" data-child-id="{{$child->id}}">
                                    <p style="cursor: pointer">{{$risk_array[$o_risk->risk_key]}} {{isset($risk_titles[$o_risk->risk_key]) ? $risk_titles[$o_risk->risk_key] : ''}}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="summary-right risk_wise_detail" id="risk_wise_detail" data-aos="fade-left" data-aos-delay="300">
                            <div class="downloads" style="display: none;">
                                <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank"><img src="{{asset('assets/web/images/download.svg')}}" alt="download"></a>
                            </div>
                            @php
                            $first_risk = DB::table('risks')->where('id',$first_risks->risk_id)->first();
                            @endphp
                            <h4>{{$first_risk->name}}</h4>
                            <p>{{$first_risk->description}}</p>
                            <h4>Research we trust</h4>
                            <p>{{$first_risk->research_we_trust}}</p>
                            <div class="rating-box">
                                <h4>{{$child->name}}’s age risk rating</h4>
                                <p>Likelihood <span>{{$likelihood_score}}</span></p>
                                <p>Impact <span>{{$impact_score}}</span></p>
                            </div>
                            <div class="text-center">
                                <a href="#recommendations" class="btn btn-viewrecom recommendation" data-name="{{$first_risk->name}}" data-id="{{$child->id}}">View
                                    Recommendations</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="riskmatrix" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="matrix-box overflow-auto">
                        <div class="heading">
                            <h2>Risk Matrix </h2>
                            <p>Explore the risks by clicking on the emojis for details</p>
                        </div>

                        <div class="matrix-table">
                            <table class="">
                                <tr>
                                    <td rowspan="3" class="p-0">
                                        <p class="rotate fw-bold h4">Likelihood</p>
                                    </td>
                                    <td style="width: 85px;text-align: center;">Likely</td>
                                    <td style="padding: 15px;border-left:3px solid #c5cad4;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 3 && $score->impact_score == 1)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="likely_1_{{$loop->parent->index}}_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 3 && $score->impact_score == 2)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="likely_2_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 3 && $score->impact_score == 3)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="likely_3_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="width: 85px;text-align: center;">Possible</td>
                                    <td style="padding: 15px;border-left:3px solid #c5cad4;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 2 && $score->impact_score == 1)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="possible_1_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 2 && $score->impact_score == 2)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="possible_2_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 2 && $score->impact_score == 3)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="possible_3_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 85px;text-align: center;">Unlikely</td>
                                    <td style="padding: 15px;border-left:3px solid #c5cad4;border-bottom:3px solid #c5cad4;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 1 && $score->impact_score == 1)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="unlikely_1_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;border-bottom:3px solid #c5cad4;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 1 && $score->impact_score == 2)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="unlikely_2_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="padding: 15px;border-bottom:3px solid #c5cad4;">
                                        <div style="width:200px;height: 200px;position: relative;border: 1px solid #eff4fa;border-bottom: 3px solid #c5cad4;">
                                            @foreach($risk_array as $key=>$array)
                                            @foreach($child_score as $score)
                                            @if($score->risk_key == $key)
                                            @if($score->likely_hood_score == 1 && $score->impact_score == 3)
                                            <p role="button" data-bs-toggle="tooltip" data-child-id="{{$child->id}}" id="unlikely_3_{{$key}}" data-key="{{str_replace('_',' ',ucfirst($key))}}" class="@if($score->likely_hood_score == 0) d-none @endif risk_wise_filter" data-bs-placement="top" title="{{isset($risk_titles[$key]) ? $risk_titles[$key] : ''}}" style="{{$style_array[$key]}}">{{$array}}</p>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="padding: 15px;">
                                        Minor
                                    </td>
                                    <td style="padding: 15px;">
                                        Moderate
                                    </td>
                                    <td style="padding: 15px;">
                                        Major
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3" class="text-center fw-bold h4 p-0">
                                        Impact
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="render_recommendation_part">
        <section id="recommendations">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2 data-aos="fade-right" data-aos-delay="100">Recommendations
                                for {{$child->name}}</h2>
                            <div class="form-filter" data-aos="fade-left" data-aos-delay="200">
                                <select class="form-control form-select risk_change_event">
                                    <option value="all_category" data-child-id="{{$child->id}}">All Categories</option>
                                    @foreach($top_risks as $key=>$top_risk)
                                    <option value="{{isset($risk_titles[$top_risk->risk_key]) ? $risk_titles[$top_risk->risk_key] : ''}}" data-child-id="{{$child->id}}">{{$risk_array[$top_risk->risk_key]}} {{isset($risk_titles[$top_risk->risk_key]) ? $risk_titles[$top_risk->risk_key] : ''}}</option>
                                    @endforeach
                                </select>
                                <i class="las la-filter"></i>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 risk_wise_recommendation_part">
                        @foreach($recommendations as $recommendation)
                        <div class="recomm-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2>{{$recommendation->title_for_recommendation}}</h2>
                                    <b>{{$recommendation->sub_text_for_recommendation}}</b>
                                    <p>{{substr($recommendation->recommendation,0,200)}}
                                        @if(strlen($recommendation->recommendation) > 200)
                                        <a href="{{route('recommendation',[$recommendation->id,$child->id])}}">...more</a>
                                        @endif
                                    </p>
                                    @php
                                    $tags = explode('; ',$recommendation->tags_for_associated_risk);
                                    $recommendation_score = DB::table('recommendation_score')->where('recommendation_id',$recommendation->id)->where('child_id',$child->id)->first();
                                    @endphp
                                    @foreach($tags as $tag)
                                    <span>{{$tag}}</span>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <div class="options-btn">
                                        <a href="{{route('recommendation',[$recommendation->id,$child->id])}}" class="line-btns">More</a>
                                        <a class="dark-btns add_to_calendar" data-id="{{$recommendation->id}}" data-rec-title="{{$recommendation->title_for_recommendation}}" data-rec-des="{{$recommendation->sub_text_for_recommendation}}">
                                            <i class="las la-calendar-alt"></i> Add to Calendar
                                        </a>
                                        {{-- <a class="dark-btns add_to_apple_calendar"--}}
                                        {{-- data-rec-title="{{$recommendation->title_for_recommendation}}"--}}
                                        {{-- data-rec-des="{{$recommendation->sub_text_for_recommendation}}">--}}
                                        {{-- <i class="las la-calendar-alt"></i> Add to Apple Calendar--}}
                                        {{-- </a>--}}
                                        @if(!is_null($recommendation->pdf))
                                        <a href="{{asset($recommendation->pdf)}}" target="_blank" class="dark-btns"><i class="las la-arrow-down"></i> Download
                                            Resource</a>
                                        @endif
                                        @if(is_null($recommendation_score))
                                        <a href="{{ route('done',[$child->id,$recommendation->id]) }}" class="dark-btns">Done</a>
                                        @endif
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
    {{--
    @if(!is_null($user))
    @if(!is_null($user->plan_id))
    @if($user->plan_created_at < date('Y-m-d')) 
--}}
    <section id="upgrade">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2 data-aos="fade-right" data-aos-delay="200">Find value in the above?
                            Upgrade for
                            more</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="upgrade-plan" data-aos="fade-up" data-aos-delay="200">
                        <h3>Teach your child about online privacy and help them adjust...</h3>
                        <a href="{{route('subscription')}}">Upgrade Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--
        @endif
        @endif
        @endif
        --}}
</div>
@else
<div id="main">
    <section id="upgrade">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="display: none;">
                    <div class="heading">
                        <h2 data-aos="fade-right" data-aos-delay="200">Your questionnaire process is not complete</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="upgrade-plan" data-aos="fade-up" data-aos-delay="200">
                        <h3>Your questionnaire process is not complete</h3>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    AOS.init({
        duration: 1200,
    })
    $(document).ready(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    });
</script>
{{-- <script>--}}
{{-- $(function () {--}}
{{-- $('[data-bs-toggle="tooltip"]').tooltip();--}}
{{-- });--}}
{{-- </script>--}}
@endsection