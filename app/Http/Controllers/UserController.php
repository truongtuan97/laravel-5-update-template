<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('auth');
    }

    public function edit(User $user) {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(User $user) {
        $this->validate(request(), [
            'email' => 'required|max:255|email|unique:users,email,'.$user->id,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:11']
        ]);
        
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->phone = request('phone');
        
        $user->save();
        return redirect('/home');        
    }
}
