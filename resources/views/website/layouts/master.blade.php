<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes - @yield('title')</title>
    @php
        $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $fav = DB::table('site_settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
    @endphp
    @if(!is_null($logo))
        <link rel="icon" href="{{asset($logo)}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset($logo)}}"
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
