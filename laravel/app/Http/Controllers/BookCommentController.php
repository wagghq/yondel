<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        BookComment::create([
            'book_id' => $id,
            'user_id' => Auth::user()->id,
            'body' => $request->input('body'),
        ]);

        return back();
    }
}
