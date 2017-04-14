@extends('layout.app')

@section('content')
  <div class="row align-center">
    <div class="medium-6 columns">
      <section>
        <header>
          <h2>Login</h2>
        </header>
        <form action="{{ route('auth.login') }}" method="POST">
          {{ csrf_field() }}

          <label>
            Email address
            <input type="email" name="email" required="required" value="{{ old('email') }}" />
          </label>
          @if ($errors->has('email'))
            <p class="help-text">{{ $errors->first('email') }}</p>
          @endif

          <label>
            Password
            <input type="password" name="password" required="required" />
          </label>
          @if ($errors->has('password'))
            <p class="help-text">{{ $errors->first('password') }}</p>
          @endif

          <button type="submit" class="success button">Login</button>

          <p><a href="{{ route('password.forgot') }}">Forgot password?</a></p>
        </form>
      </section>
    </div>
  </div>
@endsection

