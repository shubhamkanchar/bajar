@component('mail::message')
# Your OTP Code

Hello {{ $user->name }},

Your One-Time Password (OTP) is:

@component('mail::panel')
**{{ $otp }}**
@endcomponent

Please do not share it with anyone.

{{-- @component('mail::button', ['url' => 'https://yourwebsite.com'])
Go to Website
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
