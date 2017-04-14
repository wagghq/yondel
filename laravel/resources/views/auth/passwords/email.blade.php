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
                    <h2>Forgot password?</h2>
                </header>

                <p>No problem, you can reset it.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <label>
                        Registered email address
                        <input type="email" name="email" required="required" value="{{ old('email') }}" />
                    </label>
                    @if ($errors->has('email'))
                        <p class="help-text">{{ $errors->first('email') }}</p>
                    @endif

                    <button type="submit" class="success button">Send Password Reset Link</button>

                </form>
            </section>
        </div>
    </div>
@endsection
