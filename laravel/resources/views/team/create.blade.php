@extends('layout.app')

@section('content')
  <div class="row align-center">
    <div class="columns">
      <section>
        <header>
          <h2>Create a team to share reading with</h2>
        </header>
      </section>
        <form action="{{ route('team.store') }}" method="POST">
          {{ csrf_field() }}
          <label>
            Name of the team
            <input type="text" name="name" required="required" value="{{ old('name') }}" />
            <p class="hide" id="amazon-api-result__error">Failed to fetch the information. <a href="#" id="amazon-api-retry">Retry</a></p>
          </label>
          @if ($errors->has('name'))
            <p class="help-text">{{ $errors->first('name') }}</p>
          @endif
          <button type="submit" class="button">Create</button>
        </form>
    </div>
  </div>
@endsection

