<div class="downloads" style="display: none;">
    <a href="{{asset('assets/web/images/privacy-policy.pdf')}}" target="_blank"><img
            src="{{asset('assets/web/images/download.svg')}}" alt="download"></a>
</div>
<h4>{{$risk->name}}</h4>
<p>{{$risk->description}}</p>
<h4>Research We Trust</h4>
<p>{{$risk->research_we_trust}}</p>
<div class="rating-box">
    <h4>{{$child->name}}'s {{strtolower($risk->name)}} risk rating</h4>
    <p>Likelihood <span>{{$likelihood_score}}</span></p>
    <p>Impact <span>{{$impact_score}}</span></p>
</div>
<div class="text-center">
    <a href="#recommendations" class="btn btn-viewrecom recommendation" data-name="{{$risk->name}}" data-id="{{$child->id}}">View Recommendations</a>
</div>
