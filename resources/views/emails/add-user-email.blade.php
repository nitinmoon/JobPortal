@component('mail::message')
#
Dear {{ $user }},

{!! $msg !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent