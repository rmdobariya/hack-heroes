@extends('website.layouts.after-login.master')
@section('title')
Update Profile
@endsection
@section('content')
<section class="feature dashboard contactus-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-white">
                <div class="f-caption">
                    <h1 data-aos="fade-right" data-aos-delay="200">Settings</h1>
                    <h2 data-aos="fade-right" data-aos-delay="400">Update your Settings</h2>
                </div>
            </div>
            <div class="col-md-3 offset-md-1" data-aos="fade-left" data-aos-delay="400">
                <img src="{{asset('assets/web/images/hero-img.png')}}">
            </div>
        </div>
    </div>
</section>
<div id="main">
    <section class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="heading">
                        <p data-aos="fade-up" data-aos-delay="200">Update and Save your Settings</p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3 text-center">
                    <form id="updateProfileForm">
                        <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}" data-aos="fade-up" data-aos-delay="200">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}" data-aos="fade-up" data-aos-delay="300">
                        @foreach($user_childrens as $key=>$user_children)
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="children_name[{{$user_children->id}}]" placeholder="Child Name" value="{{$user_children->name}}" data-aos="fade-up" data-aos-delay="400">
                            <select name="gender[{{$user_children->id}}]" class="form-control with-arrow" data-aos="fade-up" data-aos-delay="400">
                                <option value="male" @if($user_children->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if($user_children->gender == 'female') selected @endif>Female</option>
                                <option value="intersex" @if($user_children->gender == 'intersex') selected @endif>Intersex</option>
                            </select>
                        </div>
                        @endforeach

                        <button class="btn btn-themecolor" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('custom-script')
<script src="{{asset('assets/web/custom/update-profile.js')}}?v={{time()}}"></script>
@endsection