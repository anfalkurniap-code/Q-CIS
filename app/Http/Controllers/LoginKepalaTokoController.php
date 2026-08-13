<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginKepalaTokoController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginKepalaToko');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $request->login,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboardkepalatoko');
        }

        return back()->withErrors([
            'login' => 'Email/Username atau Kata Sandi salah.',
        ])->onlyInput('login');
    }
}