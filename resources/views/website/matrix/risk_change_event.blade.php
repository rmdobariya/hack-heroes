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
                @php
                                        $tags = !empty($recommendation->tags_for_age_appropriateness) ? explode('; ',$recommendation->tags_for_age_appropriateness) : array();
                                    @endphp
                                    @foreach($tags as $tag)
                                        <span>{{$tag}}</span>
                                    @endforeach
                                    @php
                                        $tags = !empty($recommendation->tag_for_frequency) ? explode('; ',$recommendation->tag_for_frequency) : array();
                                    @endphp
                                    @foreach($tags as $tag)
                                        <span>{{$tag}}</span>
                                    @endforeach
                                    @if(!empty($recommendation->tag_if_affiliate))
                                        <span>Affiliate</span>
                                    @endif
                                    @if(!empty($recommendation->tag_if_resource))
                                        <span>Resource</span>
                                    @endif
                                    @php
                                        $tags = !empty($recommendation->tags_for_visual_grouping) ? explode('; ',$recommendation->tags_for_visual_grouping) : array();
                                    @endphp
                                    @foreach($tags as $tag)
                                        <span>{{$tag}}</span>
                                    @endforeach  
            </div>
            <div class="col-md-4">
                <div class="options-btn">
                    <a href="{{route('recommendation',[$recommendation->id,$child->id])}}"
                       class="line-btns">More</a>
                       <a class="dark-btns add_to_calendar" data-id="{{$recommendation->id}}"  data-rec-title="{{$recommendation->title_for_recommendation}}" data-rec-des="{{$recommendation->sub_text_for_recommendation}}">
                        <i class="las la-calendar-alt"></i> Add to Calendar
                    </a>
                    @if(!is_null($recommendation->pdf) && !empty($recommendation->pdf))
                    <a href="{{asset($recommendation->pdf)}}"
                       target="_blank"
                       class="dark-btns"><i class="las la-arrow-down"></i> Download
                        Resource</a>
                    @endif
                    @if(is_null($recommendation_score))
                        <a href="{{ route('done',[$child->id,$recommendation->id]) }}"
                           class="dark-btns">Done</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
