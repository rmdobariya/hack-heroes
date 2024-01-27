@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-signup">
                        <h1>HackHeroes</h1>
                        <h2>Get started on your personalised cyberbullying prevention plan</h2>
                        <form id="signup5" method="post">
                            <p>Create plan for</p>
                            @if(!is_null($childrens))
                                @foreach($childrens as $key=>$children)
                                    <div class="input-box attribute-row attribute-row-{{$key}}">
                                        <div class="form-check">
                                            <input type="hidden" name="child[{{$key}}]" value="{{$children}}">
                                            <input class="form-check-input" type="checkbox" name="create_plan[{{$key}}]"
                                                   id="create_plan_{{$key}}">
                                            <label class="form-check-label" for="create_plan_{{$key}}">
                                                {{$children}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            {{--                        <div id="new_chq"></div>--}}
                            <div id="add-child-btn">
                                <a href="javascript:void()" class="add-child"
                                   onclick="addAttributeForPlan({{count($childrens)}})"><img
                                        src="{{asset('assets/web/images/plus-icon.png')}}"> Add another Child</a>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="term_condition"
                                       id="flexCheckDefault" @if(Session::get('term_condition') == 'on') checked
                                       @endif required>
                                <label class="form-check-label mb-4" for="flexCheckDefault">
                                    I have read the <a href="{{$privacy_policy}}"
                                                       target="_blank">Privacy</a> & <a href="{{$terms_condition}}"
                                                                                        target="_blank">Terms</a> and
                                    understand how the information I provide will be used.
                                </label>
                            </div>

                            <button class="btn signup-btn" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="what-get text-center">
                                <h2>How it Works</h2>
                                <h3>Our plan comes with</h3>
                                <div class="row whats-sign2">
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-1.png')}}"
                                                 alt="how-it-works">
                                            <p>Help us understand your child by answering questions</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-2.png')}}"
                                                 alt="how-it-works">
                                            <p>View results</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/how-it-works-3.png')}}"
                                                 alt="how-it-works">
                                            <p>Personalised plan that suits your child’s profile</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection

