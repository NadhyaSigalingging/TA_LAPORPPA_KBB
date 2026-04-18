<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('auth.admin.dashboard.index');
        }

        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {

            $request->session()->regenerate();

            return redirect()->route('auth.admin.dashboard.index')
                ->with('success', 'Welcome back ' . Auth::user()->username);
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

}

