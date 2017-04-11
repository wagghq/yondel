@extends('layout.app')

@section('content')
  <div class="row">
    <div class="columns">
      <section>
        <header>
          <h2>Invitations to {{ $team->name }} you’ve sent</h2>
        </header>
        @if (0 === count($invitations))
          <p>You haven’t invited anybody to {{ $team->name }}. <a href="{{ route('invitation.create') }}">Invite</a></p>
        @else
          <table>
            <thead>
              <tr>
                <th>Email address</th>
                <th>Invited at</th>
                <th>Registered at</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($invitations as $invitation)
                <tr>
                  <td>{{ $invitation->invitee_email }}</td>
                  <td>{{ $invitation->created_at }}</td>
                  <td>{{ $invitation->deleted_at ?: 'Not registered' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </section>
    </div>
  </div>
@endsection