<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HackHeroes: @yield('title')</title>
    @php
        $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $fav = DB::table('site_settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
        $terms_condition = DB::table('site_settings')->where('setting_key','TERMS_CONDITION')->first()->setting_value;
        $privacy_policy = DB::table('site_settings')->where('setting_key','PRIVACY_POLICY')->first()->setting_value;
        $fb_link = DB::table('site_settings')->where('setting_key','FACEBOOK_LINK')->first()->setting_value;
        $insta_link = DB::table('site_settings')->where('setting_key','INSTAGRAM_LINK')->first()->setting_value;
        $linkedin_link = DB::table('site_settings')->where('setting_key','LINKEDIN_LINK')->first()->setting_value;
    @endphp
    @if(!is_null($fav))
        <link rel="icon" href="{{asset($fav)}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset($fav)}}"
              type="image/x-icon">
    @else
        <link rel="icon" href="{{asset('assets/web/images/logo.png')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset('assets/web/images/logo.png')}}"
              type="image/x-icon">
    @endif
    @include('website.layouts.css')
</head>
<body>
@include('website.layouts.header')
@yield('content')
@include('website.layouts.footer')
@include('website.layouts.script')
@yield('custom-script')
</body>
</html>
