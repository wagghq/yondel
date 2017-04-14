@extends('layout.app')

@section('content')
    <div class="row align-center">
        <div class="medium-6 columns">
            <section>

                @if (session('status'))
                    <div class="callout success">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                    <header>
                        <h2>Reset password?</h2>
                    </header>

                    <form method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <label>
                            Registered email address
                            <input type="email" name="email" required="required" value="{{ $email or old('email') }}" autofocus="autofocus" />
                        </label>
                        @if ($errors->has('email'))
                            <p class="help-text">{{ $errors->first('email') }}</p>
                        @endif

                        <label>
                            Choose a new password
                            <input type="password" name="password" required="required" />
                        </label>
                        @if ($errors->has('password'))
                            <p class="help-text">{{ $errors->first('password') }}</p>
                        @endif

                        <label>
                            Confirm the new password
                            <input type="password" name="password_confirmation" required="required" />
                        </label>
                        @if ($errors->has('password_confirmation'))
                            <p class="help-text">{{ $errors->first('password_confirmation') }}</p>
                        @endif

                        <button type="submit" class="success button">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
