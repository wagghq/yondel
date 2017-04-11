<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wagg\Yondel\Model\Book;
use Wagg\Yondel\Model\User;

class BookController extends Controller
{
    public function index()
    {
        $currentTeam = Auth::user()->currentTeam;

        $books = Book::where('team_id', $currentTeam->id)->get();
        $users = $currentTeam->users;

        return view('book.index', compact('books', 'users'));
    }


    public function show($id)
    {
        $book = Book::find($id);
        $readers = $book->readers;

        return view('book.show', compact('book', 'readers'));
    }


    public function create()
    {
        return view('book.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'asin' => ['required', 'string', 'unique:books', 'max:512'],
            'recommendation_comment' => ['required', 'string']
        ]);

        Book::create([
            'team_id' => Auth::user()->current_team_id,
            'recommender_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'asin' => $request->input('asin'),
            'recommendation_comment' => $request->input('recommendation_comment'),
        ]);

        return redirect()->route('book.index');
    }

    public function read($id)
    {
        $book = Book::find($id);
        $book->readers()->attach(Auth::user()->id);

        return redirect()->back();
    }
}
