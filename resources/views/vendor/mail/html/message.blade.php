@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => 'https://hackheroes-dev.projectdemo.click'])
            @php
            $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
            @endphp
            @if(!is_null($logo))
                <img src="{{asset($logo)}}">
            @else
                <img src="{{asset('media/logos/logo.png')}}">
            @endif
        @endcomponent
    @endslot

    {{ $slot }}

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
