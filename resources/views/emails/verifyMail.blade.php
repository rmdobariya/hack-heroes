@component('mail::message')
# Hi {{ $details['name'] }},
You're just one step away from joining the HackHeroes family. To keep your account secure and get started, please verify your email address:<br>

@component('mail::button', ['url' => $details['actionUrl']])
Verify My Email
@endcomponent<br>

By verifying, you're gearing up to become a digital guardian for your child. Welcome aboard!<br/>

Cheers,<br/>
The HackHeroes Team
@endcomponent
