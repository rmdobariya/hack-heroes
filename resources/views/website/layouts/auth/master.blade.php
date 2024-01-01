<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HackHeroes</title>
    @include('website.layouts.auth.css')
</head>
<body>
@include('website.layouts.auth.header')
@yield('content')
@include('website.layouts.auth.footer')
@include('website.layouts.auth.script')
@yield('custom-script')
</body>
</html>
