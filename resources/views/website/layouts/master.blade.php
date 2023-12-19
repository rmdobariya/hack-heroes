<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes - @yield('title')</title>
    <link rel="icon" href="{{asset('assets/web/images/logo.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/web/images/logo.png')}}"
          type="image/x-icon">
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
