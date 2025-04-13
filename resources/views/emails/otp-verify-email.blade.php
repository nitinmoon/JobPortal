@component('mail::message')
#
Hi,

{!! $msg !!}

<h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 5px 10px;color: #fff;border-radius: 4px;">{!! $otp !!}</h2>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
