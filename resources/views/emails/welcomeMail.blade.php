@component('mail::message')
# Hello {{ $details['name'] }},
Welcome to Hackheroes!<br>
it`s great to have you on board<br>
HackHeroes is personalised cyberbullying Prevention, focused on Cyber safety, designed for your child<br>
@component('mail::button', ['url' => $details['actionUrl']])
Continue
@endcomponent
Warm regards,<br/>
HackHeroes Care Team
@endcomponent
