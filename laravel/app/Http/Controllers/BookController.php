<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Wagg\Yondel\Mail\BookCreated;
use Wagg\Yondel\Model\Book;
use Wagg\Yondel\Model\BookComment;
use Wagg\Yondel\Model\User;

class BookController extends Controller
{
    public function index()
    {
        $currentTeam = Auth::user()->currentTeam;

        $books = Book::where('team_id', $currentTeam->id)->get();

        return view('book.index', compact('books'));
    }


    public function show($id)
    {
        $book = Book::find($id);
        $users = Auth::user()->currentTeam->users;
        $readers = $book->readers;
        $comments = $book->comments;

        return view('book.show', compact('book', 'users', 'readers', 'comments'));
    }


    public function create()
    {
        return view('book.create');
    }


    public function store(Request $request)
    {
        $team = Auth::user()->currentTeam;

        $this->validate($request, [
            'title' => ['required', 'string'],
            'asin' => ['required', 'string', 'unique:books', 'max:512'],
            'recommendation_comment' => ['required', 'string']
        ]);

        $book = Book::create([
            'team_id' => $team->id,
            'recommender_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'asin' => $request->input('asin'),
        ]);

        BookComment::create([
            'book_id' => $book->id,
            'user_id' => Auth::user()->id,
            'body' => $request->input('recommendation_comment'),
        ]);

        Mail::to($team->users)->send(new BookCreated($book));

        return redirect()->route('book.index');
    }

    public function read($id)
    {
        $book = Book::find($id);
        $book->readers()->attach(Auth::user()->id);

        return redirect()->back();
    }
}
