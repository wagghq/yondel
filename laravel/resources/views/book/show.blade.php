@extends('layout.app')

@section('content')
  <div class="row">
    <div class="columns full">
      <header>
        <h1>{{ $book->title }}</h1>
        <p>Recommended by {{ $book->recommender->name }}</p>
      </header>
    </div>
  </div>
  <div class="row">
    <div class="columns medium-6">

      <section id="comments">
        <header>
          <h2>Comments</h2>
        </header>
        @if (count($comments))
          @foreach ($comments as $comment)
            <section>
              <h4>{{ $comment->user->name }} says:</h4>
              <p>{{ $comment->body }}</p>
            </section>
          @endforeach
        @else
          <p>No comments.</p>
        @endif
        <form action="{{ route('bookComment.store', $book->id) }}" method="POST">
          {{ csrf_field() }}

          <textarea name="body" required="required" rows="3" placeholder="Any thoughts?"></textarea>

          <button type="submit" class="button">Add</button>
        </form>
      </section>

    </div>

    <div class="columns medium-6">

      <section id="readers">
        <h2>Readers</h2>
        @if (count($readers))
          <ul>
            @foreach ($readers as $reader)
              <li>{{ $reader->name }}</li>
            @endforeach
          </ul>
        @else
          <p>Nobody has read this book.</p>
        @endif

        <form action="{{ route('book.read', $book->id) }}" method="POST">
          {{ csrf_field() }}
          <button type="submit" class="button">I've read this!</button>
        </form>
      </section>

    </div>
  </div>
@endsection