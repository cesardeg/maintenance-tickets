<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm() {
        return view('login.login');
    }
    
    public function login() {
        $validator = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validator, request('remember') == 1)) {
            return redirect()->intended('/dashboard');
        }

        return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput(request(['email']));
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
