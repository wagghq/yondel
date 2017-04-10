@extends('layout.app')

@section('content')
  <h1>{{ $book->amazon_url }}</h1>
  <p>{{ $book->recommendation_comment }}</p>

  <h2>Readers</h2>
  @if (count($readers))
    <ul>
      @foreach ($readers as $reader)
        <li>{{ $reader->name }}</li>
      @endforeach
    </ul>
  @else
    Nobody has read this book.
  @endif

  <form action="{{ route('book.read', $book->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit">I've read this!</button>
  </form>
@endsection