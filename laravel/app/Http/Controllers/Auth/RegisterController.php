<?php

namespace Wagg\Yondel\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wagg\Yondel\Model\Invitation;
use Wagg\Yondel\Model\User;
use Wagg\Yondel\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers {
        register as traitRegister;
    }

    public function showRegistrationForm($invitationCode = null)
    {
        $invitationIsInvalid = false;

        if (null !== $invitationCode) {
            if (null === Invitation::where('code', $invitationCode)->first()) {
                $invitationIsInvalid = true;
            }
        }

        return view('auth.register', compact('invitationIsInvalid', 'invitationCode'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'invitation_code' => 'sometimes|required|exists:invitations,code',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

    public function register(Request $request)
    {
        $redirect = $this->traitRegister($request);

        $user = Auth::user();


        if (null !== $request->input('invitation_code')) {
            $invitation = Invitation::where('code', $request->input('invitation_code'))->first();
            $user->teams()->attach($invitation->team_id);
            $user->current_team_id = $invitation->team_id;
            $user->save();
            $invitation->delete();
        }

        return $redirect;
    }
}
