<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.index');
    }

    public function auth(Request $request)
    {
        $payload = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($payload)) {
            $request->session()->regenerate();

            return redirect()->route('user.index');
        }

        return back()->withErrors('username atau password salah')->onlyInput('email');
    }
}
