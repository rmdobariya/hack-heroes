@component('mail::message')
# Hello {{ $details['name'] }},
Please click on the link below to reset your password.
@component('mail::button', ['url' => $details['actionUrl']])
Reset password
@endcomponent
Thanks,<br/>
HackHeroes Support 
@endcomponent
