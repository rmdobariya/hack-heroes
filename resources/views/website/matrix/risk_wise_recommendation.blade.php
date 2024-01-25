<section id="recommendations">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 data-aos="fade-right" data-aos-delay="100">Recommendations for {{$child->name}}</h2>
                    <div class="form-filter" data-aos="fade-left" data-aos-delay="200">
                        <select class="form-control form-select risk_change_event">
                            <option>All Categories</option>
                            @foreach($top_risks as $key=>$top_risk)
                                <option value="{{str_replace('_',' ',ucfirst($top_risk->risk_key))}}"
                                        data-child-id="{{$child->id}}">{{$risk_array[$top_risk->risk_key]}} {{str_replace('_',' ',ucfirst($top_risk->risk_key))}}</option>
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
                                @endphp
                                @foreach($tags as $tag)
                                    <span>{{$tag}}</span>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <div class="options-btn">
                                    <a href="{{route('recommendation',[$recommendation->id,$child->id])}}" class="line-btns">More</a>
                                    <a class="dark-btns add_to_calendar" data-rec-title="{{$recommendation->title_for_recommendation}}" data-rec-des="{{$recommendation->sub_text_for_recommendation}}">
                                        <i class="las la-calendar-alt"></i> Add to Calendar
                                    </a>
                                    @if(!is_null($recommendation->pdf))
                                    <a href="{{asset($recommendation->pdf)}}" target="_blank"
                                       class="dark-btns"><i class="las la-arrow-down"></i> Download Resource</a>
                                    @endif
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
<script>
    AOS.init({
        duration: 1200,
    })

</script>
<script src="{{asset('assets/web/custom/matrix.js')}}?v={{time()}}"></script>
