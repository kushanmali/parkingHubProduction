<x-mail::message>

<p>Hello {{ $user->name }},</p>
<p>Your password is: {{ $password }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
