<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password, 'state' => '1'];

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('/dashboard');
        } else {
            return redirect('login');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
