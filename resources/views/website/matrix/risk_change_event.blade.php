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
                    <a href="{{route('recommendation',[$recommendation->id,$child->id])}}"
                       class="line-btns">More</a>
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
