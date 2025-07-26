@component('mail::message')
#
Dear {{ $userName }},

{!! $msg !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent