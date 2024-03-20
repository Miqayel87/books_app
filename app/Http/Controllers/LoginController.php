<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'login' => $request->login,
            "password" => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withInput($request->only('login'))
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
