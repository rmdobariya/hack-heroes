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
                        <h2>Join us today & get your personalised cyberbullying prevention plan</h2>
                        <form id="signup3" method="post">
                            <input type="hidden"
                                   value="{{ !is_null(Auth::guard('web')->user()) ? Auth::guard('web')->user()->id : 0}}"
                                   name="user_id" id="user_id">
                            {{--                            <input type="text" name="name[1]"  placeholder="Child’s first name"--}}
                            {{--                                   value="" class="form-control attribute-row attribute-row-1">--}}
                            <div class="attribute-row attribute-row-1">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name[1]"
                                           placeholder="Child’s first name">
                                    <select name="gender[1]" class="form-control">
                                        <option value="female" selected>Female</option>
                                        <option value="intersex">Intersex</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>

                            <div id="new_chq"></div>
                            <a href="javascript:void()" class="add-child" onclick="addAttribute(1)"><img
                                    src="{{asset('assets/web/images/plus-icon.png')}}"> Add another Child</a>
                            <button class="btn signup-btn" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="what-get text-center">
                                <h2>What you'll get</h2>
                                <h3>Our plan comes with</h3>
                                <div class="row whats-sign2">
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-1.png')}}" alt="what">
                                            <p>Tailored plan that suits your child’s profile</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-2.png')}}" alt="what">
                                            <p>Actionable recommendations</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="whats-box">
                                            <img src="{{asset('assets/web/images/what-3.png')}}" alt="what">
                                            <p>Tracking feature to help monitor your actions</p>
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
    <script>
        var rowNo = 1
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
