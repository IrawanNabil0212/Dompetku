<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'admin@gmail.com' && 
            $request->password === 'admin') {
            session([
                'is_logged_in' => true,
                'tipe_user' => 'vip'
            ]);

            return redirect('/');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        session()->forget(['is_logged_in', 'tipe_user']);
        return redirect('/login');
    }
}