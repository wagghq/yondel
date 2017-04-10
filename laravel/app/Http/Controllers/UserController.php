<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Wagg\Yondel\Model\Book;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }
}
