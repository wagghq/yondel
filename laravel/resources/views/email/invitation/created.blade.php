@component('mail::message')
  # Invitation Created

  {{ $invitation->inviter->name }} has created an invitation for you to {{ $invitation->team->name }} on YONDEL.

  @component('mail::button', ['url' => route('auth.register', ['code' => $invitation->code])])
    Join {{ $invitation->team->name }}
  @endcomponent

  Thanks,
  YONDEL Team
@endcomponent