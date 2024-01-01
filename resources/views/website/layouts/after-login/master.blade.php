<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes</title>
    @include('website.layouts.after-login.css')
</head>
<body>
@include('website.layouts.after-login.header')
@yield('content')
@include('website.layouts.after-login.footer')
@include('website.layouts.after-login.script')
@yield('custom-script')
</body>
</html>
