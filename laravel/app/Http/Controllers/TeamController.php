<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wagg\Yondel\Model\Team;

class TeamController extends Controller
{
    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team = Team::create([
            'name' => $request->input('name'),
        ]);

        $user = Auth::user();
        $user->teams()->attach($team);
        $user->current_team_id = $team->id;
        $user->save();

        return redirect()->route('book.index');
    }

    public function switch($id)
    {
        Auth::user()->current_team_id = $id;

        return redirect()->back();
    }
}
