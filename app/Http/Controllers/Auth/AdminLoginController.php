<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('auth.admin.dashboard.index');
        }

        return view('auth.admin.login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ CEK ROLE
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun ini bukan admin'
                ]);
            }

            // ✅ CEK STATUS
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun belum disetujui admin'
                ]);
            }

            return redirect()->route('auth.admin.dashboard.index')
                ->with('success', 'Welcome back ' . $user->username);
        }

        return back()->with('error', 'Username atau password salah')
             ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER ADMIN (PENDING)
    |--------------------------------------------------------------------------
    */
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'pending'
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Akun berhasil dibuat, menunggu persetujuan admin');
    }
    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
