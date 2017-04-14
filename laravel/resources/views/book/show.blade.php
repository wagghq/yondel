@extends('layout.app')

@section('content')
  <div class="row">
    <div class="columns full">
      <header>
        <h2>{{ $book->title }}</h2>
        <p>Recommended by {{ $book->recommender->name }}</p>
      </header>
    </div>
  </div>
  <div class="row">
    <div class="columns medium-6">

      <section id="comments">
        <header>
          <h3>Comments</h3>
        </header>

        @foreach ($comments as $comment)
          <section>
            <h4>{{ $comment->user->name }} says:</h4>
            <p>{{ $comment->body }}</p>
          </section>
        @endforeach

        <form action="{{ route('bookComment.store', $book->id) }}" method="POST">
          {{ csrf_field() }}

          <textarea name="body" required="required" rows="3" placeholder="Any thoughts?"></textarea>

          <button type="submit" class="button">Add</button>
        </form>
      </section>

    </div>

    <hr />f

    <div class="row">
      <div class="columns full">

        <section id="readers">
          <h2>Who’s read this?</h2>

          <table>
            <thead>
              @foreach ($users as $user)
                <th>{{ $user->name }}</th>
              @endforeach
            </thead>
            <tbody>
            @foreach ($users as $user)
              <td class="{{ $readers->contains($user) ? 'read' : 'unread' }}">
                {{ $readers->contains($user) ? 'Read' : 'Unread' }}
              </td>
            @endforeach
            </tbody>
          </table>

          <form action="{{ route('book.read', $book->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="button">I've read this!</button>
          </form>
        </section>

      </div>
    </div>
  </div>
@endsection