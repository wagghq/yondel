@component('mail::message')

# Invitation Created

{{ $inviter->name }} has created an invitation for you to {{ $team->name}} on YONDEL.

@component('mail::button', ['url' => $url])
Join {{ $team->name}}
@endcomponent

Thanks,
YONDEL Team
@endcomponent