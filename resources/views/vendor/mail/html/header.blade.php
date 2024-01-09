<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @php
                $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
            @endphp
            @if (trim($slot) === 'header')
                @if(!is_null($logo))
                    <img src="{{asset($logo)}}">
                @else
                    <img src="{{asset('media/logos/logo.png')}}">
                @endif
            @else
                @if(!is_null($logo))
                    <img src="{{asset($logo)}}">
                @else
                    <img src="{{asset('media/logos/logo.png')}}">
                @endif
            @endif
        </a>
    </td>
</tr>
