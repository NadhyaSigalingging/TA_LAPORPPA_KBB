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
    | LOGIN ADMIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // ✅ VALIDASI INDONESIA
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // ✅ FILTER LANGSUNG ADMIN (INI YANG PALING PENTING)
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin' // 🔥 hanya admin yang bisa login
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔒 CEK STATUS SAJA (ROLE SUDAH TERFILTER)
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum disetujui')->withInput();
            }

            return redirect()->route('auth.admin.dashboard.index')
                ->with('success', 'Selamat datang kembali, ' . $user->username);
        }

        // ❌ GAGAL LOGIN
        return back()->with('error', 'Username atau password salah')->withInput();
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
        ], [
            'name.required' => 'Nama lengkap wajib diisi',

            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',

            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sama',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',     // 🔥 tetap admin
            'status' => 'pending'  // 🔥 harus di-approve
        ]);

        return redirect()->route('admin.pending')
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

        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout');
    }
}
