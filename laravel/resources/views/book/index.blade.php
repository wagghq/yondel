@extends('layout.app')

@section('content')

  <div class="row">
    <div class="columns">
      <section>
        <header>
          <h2>Books</h2>
        </header>
        @if (count($books) === 0)
          <p>Well, no books are shared yet…</p>
        @else
          <div class="table-scroll">
            <table class="scroll">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>ASIN</th>
                  <th>Comments</th>
                  <th>Read</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($books as $book)
                  <tr>
                    <th class="text-left"><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></th>
                    <th><a href="https://www.amazon.co.jp/dp/{{ $book->asin }}" target="_blank">{{ $book->asin }}</a></th>
                    <td><a href="{{ route('book.show', $book->id) }}#comments">{{ count($book->comments) }}</td>
                    <td><a href="{{ route('book.show', $book->id) }}#readers">{{ count($book->readers) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </section>
    </div>
  </div>
@endsection