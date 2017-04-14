@extends('layout.app')

@section('content')
  <div class="row align-center">
    <div class="medium-6 columns">
      <section>
        <header>
          <h2>Register</h2>
        </header>
        @if ($invitationIsInvalid)
          <div class="callout secondary">
            <h5>Invalid invitation code</h5>
            <p>InvitationCode is not valid or has already been consumed.</p>
            <p><a href="{{ route('auth.register') }}">Register without invitation?</a></p>
          </div>
        @else
          <form action="{{ route('auth.register') }}" method="POST">
            {{ csrf_field() }}
            @if (isset($invitationCode) || old('invitation_code'))
              <input type="hidden" name="invitation_code" value="{{ $invitationCode ?? old('invitation_code') }}" />
            @endif
            <label>
              Your name
              <input type="text" name="name" required="required" value="{{ old('name') }}" />
            </label>
            @if ($errors->has('name'))
              <p class="help-text">{{ $errors->first('name') }}</p>
            @endif

            <label>
              Email address
              <input type="email" name="email" required="required" value="{{ old('email') }}" />
            </label>
            @if ($errors->has('email'))
              <p class="help-text">{{ $errors->first('email') }}</p>
            @endif

            <label>
              Choose a password
              <input type="password" name="password" required="required" />
            </label>
            @if ($errors->has('password'))
              <p class="help-text">{{ $errors->first('password') }}</p>
            @endif

            <label>
              Confirm the password
              <input type="password" name="password_confirmation" required="required" />
            </label>
            @if ($errors->has('password_confirmation'))
              <p class="help-text">{{ $errors->first('password_confirmation') }}</p>
            @endif

            <button type="submit" class="success button">Register</button>
          </form>
        @endif
      </section>
    </div>
  </div>
@endsection

