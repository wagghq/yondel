<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Wagg\Yondel\Mail\BookCommentCreated;
use Wagg\Yondel\Mail\BookCreated;
use Wagg\Yondel\Model\Book;
use Wagg\Yondel\Model\BookComment;
use Wagg\Yondel\Model\User;

class BookCommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'body' => ['required', 'string'],
        ]);

        $comment = BookComment::create([
            'book_id' => $id,
            'user_id' => Auth::user()->id,
            'body' => $request->input('body'),
        ]);

        $book = Book::where('id', $id)->with('comments.user')->first();

        $users = new Collection;

        foreach ($book->comments as $comment) {
            $users->add($comment->user);
        }

        $users = $users->unique();

        Mail::to($users)->send(new BookCommentCreated($book, $comment));

        return back();
    }
}
