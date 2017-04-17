@component('mail::message')
# Book Comment Created

{{ $comment->user->name }} has added a comment to “{{ $book->title }}” on YONDEL.

> {{ $comment->body }}

@component('mail::button', ['url' => route('book.show', $book->id)])
Go to the book
@endcomponent

Thanks,
YONDEL Team
@endcomponent