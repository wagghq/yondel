@extends('layout.app')

@section('content')
  <div class="row align-center">
    <div class="columns">
      <section>
        <header>
          <h2>Invite a member to {{ $team->name }}</h2>
        </header>
      </section>
      <form action="{{ route('invitation.store') }}" method="POST">
        {{ csrf_field() }}
        <label>
          Enter the email address of the invitee
          <input type="email" name="email" required="required" value="{{ old('email') }}" />
        </label>
        @if ($errors->has('email'))
          <p class="help-text">{{ $errors->first('email') }}</p>
        @endif
        <button type="submit" class="button">Invite</button>
      </form>
    </div>
  </div>
@endsection