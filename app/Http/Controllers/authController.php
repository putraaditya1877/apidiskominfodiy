<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class authController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }

        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard()->attempt($credentials)) {
            $user = Auth::guard()->user();

            $sessionId = uniqid();
            $user->id_session = $sessionId;
            $user->save();

            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'Login Berhasil!');
        }

        return back()->withErrors([
            'username' => 'Username atau Password tidak terdaftar!',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $user = $request->user();
        if ($user) {
            $user->id_session = null;
            $user->save();
        }
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah berhasil logout');
    }
}
