@component('mail::message')
  # Book Created

  {{ $book->recommender->name }} has created a new book “{{ $book->title }}” on YONDEL.

  > {{ $book->recommendation_comment }}

  @component('mail::button', ['url' => route('book.index')])
    Check the team books out
  @endcomponent

  Thanks,
  YONDEL Team
@endcomponent