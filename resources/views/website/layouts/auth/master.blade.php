<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $fav = DB::table('site_settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
        $terms_condition = DB::table('site_settings')->where('setting_key','TERMS_CONDITION')->first()->setting_value;
        $privacy_policy = DB::table('site_settings')->where('setting_key','PRIVACY_POLICY')->first()->setting_value;
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
    @include('website.layouts.auth.css')
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3728812060682073');
        fbq('track', 'PageView');
    </script>
    <noscript><img height=“1” width=“1" style=“display:none” src=“https://www.facebook.com/tr?id=3728812060682073&ev=PageView&noscript=1” /></noscript>
    <!-- End Meta Pixel Code -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S6BSBRT80Y"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'G-S6BSBRT80Y');
    </script>
</head>
<body>
@include('website.layouts.auth.header')
@yield('content')
@include('website.layouts.auth.footer')
@include('website.layouts.auth.script')
@yield('custom-script')
</body>
</html>
