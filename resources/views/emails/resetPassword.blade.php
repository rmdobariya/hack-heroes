@component('mail::message')
# Hello {{ $details['name'] }},
We've received a request to reset your HackHeroes password. No worries, you can set a new one by clicking the link below:
@component('mail::button', ['url' => $details['actionUrl']])
Reset My Password
@endcomponent
<p>If you didn't request this, please ignore this email. Your password won't change unless you access the link above and create a new one.</p>
<p>Stay safe,<br/>
The HackHeroes Team</p>
@endcomponent
