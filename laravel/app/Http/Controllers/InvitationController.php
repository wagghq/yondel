<?php

namespace Wagg\Yondel\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Wagg\Yondel\Mail\InvitationCreated;
use Wagg\Yondel\Model\Book;
use Wagg\Yondel\Model\Invitation;

class InvitationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $team = $user->currentTeam;

        $invitations = Invitation
            ::withTrashed()
            ->where('inviter_id', $user->id)
            ->where('team_id', $team->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('invitation.index', compact('invitations', 'team'));
    }

    public function create()
    {
        $team = Auth::user()->currentTeam;

        return view('invitation.create', compact('team'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        $user = Auth::user();

        Mail::to($user)->send(new InvitationCreated(Auth::user()->currentTeam, $user));

        Invitation::create([
            'team_id' => $user->current_team_id,
            'inviter_id' => $user->id,
            'invitee_email' => $request->input('email'),
            'code' => Uuid::uuid4()->toString(),
        ]);

        return redirect()->route('invitation.index');
    }

    public function destroy(Request $request)
    {
        $invitation = Invitation::find($request->input('id'));
        $invitation->delete();

        return redirect()->route('invitation.index');
    }
}
