@component('mail::message')
@component('mail::panel')
<h3>Hello!</h3>
<p>You are receiving this email because we received a password reset request for your account.</p>


@component('mail::button', ['url' => url('console/reset-password/'.$token), 'color' => 'success'])
Reset Password
@endcomponent

<p>If you did not request a password reset, no further action is required</p>

<br>Thanks,<br>
{{ config('app.name') }}
@endcomponent
@endcomponent
