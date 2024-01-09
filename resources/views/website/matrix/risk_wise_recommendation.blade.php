<section id="recommendations">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 data-aos="fade-right" data-aos-delay="100">Recommendations for {{$child->name}}</h2>
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
                                <p{{$recommendation->recommendation}} <a href="recommendations.html">more</a></p>
                                @php
                                    $tags = explode('; ',$recommendation->tags_for_associated_risk);
                                @endphp
                                @foreach($tags as $tag)
                                    <span>{{$tag}}</span>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <div class="options-btn">
                                    <a href="recommendations.html" class="line-btns">More</a>
                                    <a href="https://calendar.google.com/" target="_blank" class="dark-btns"><i
                                            class="las la-calendar-alt"></i> Add to Calendar</a>
                                    <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank"
                                       class="dark-btns"><i class="las la-arrow-down"></i> Download Resource</a>
                                    <a href="javascript:void()" class="dark-btns">Done</a>
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
