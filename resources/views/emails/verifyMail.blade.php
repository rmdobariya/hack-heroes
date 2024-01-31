@component('mail::message')
# Hello {{ $details['name'] }},
How are you?<br>
Please verify your email address for HackHeroes!<br>
@component('mail::button', ['url' => $details['actionUrl']])
Verify now
@endcomponent
Warm regards,<br/>
HackHeroes Care Team
@endcomponent
