<form class="team-switcher">
  <select id="{{ $selectId = uniqid() }}">
    @foreach ($teams as $team)
      <option
        value="{{ route('team.switch', $team->id) }}"
        @if (Auth::user()->current_team_id === $team->id)
          selected="selected"
        @endif
      >{{ $team->name }}</option>
    @endforeach
    <option value="{{ route('team.create') }}">Create a new team</option>
  </select>
</form>

@section('script')
  (function () {
    var $select = $('#{{ $selectId }}');
    $select.on('change', function () {
      window.location.href = $select.val();
    });
  })();
@endsection