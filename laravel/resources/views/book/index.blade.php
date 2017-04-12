@extends('layout.app')

@section('content')

  <div class="row">
    <div class="columns">
      <section>
        <header>
          <h2>So who’s read what?</h2>
        </header>
        @if (count($books) === 0)
          <p>Well, no books are shared yet…</p>
        @else
          <div class="table-scroll">
            <table class="scroll">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Recommendation</th>
                  @foreach ($users as $user)
                    <th>{{ $user->name }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($books as $book)
                  <tr>
                    <th><a href="https://www.amazon.co.jp/dp/{{ $book->asin }}" target="_blank">{{ $book->title }}</a></th>
                    <td>{{ $book->recommendation_comment }} by {{ $book->recommender->name }}</td>
                    @foreach ($users as $user)
                      <td>
                        @if ($book->readers->contains($user))
                          Read
                        @else
                          @if (Auth::user()->id === $user->id)
                            <form action="{{ route('book.read', $book->id) }}" method="POST">
                              {{ csrf_field() }}
                              <button type="submit" class="button small">I've read this!</button>
                            </form>
                          @else
                            Unread
                          @endif
                        @endif
                      </td>
                    @endforeach
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