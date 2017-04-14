<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Wagg\Yondel\Model\Book;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('book.index');
    }
}
