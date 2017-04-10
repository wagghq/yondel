@extends('layout.app')

@section('content')
  <table>
    <thead>
      <tr>
        <td></td>
        @foreach ($users as $user)
          <th><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></th>
        @endforeach
      </tr>
    </thead>
    @foreach ($books as $book)
      <tr>
        <th><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</th>
        @foreach ($users as $user)
          <td>
            {{ $book->readers->contains($user) ? 'Yes' : 'No' }}
          </td>
        @endforeach
      </tr>
    @endforeach
  </table>
@endsection