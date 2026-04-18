<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate(); // ⬅️ WAJIB

            // Cek role
            if (Auth::user()->role !== 'user') {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun admin tidak bisa login di sini'
                ]);
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
