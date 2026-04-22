<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 🔐 belum login
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // 🔐 cek status aktif
        if ($user->status !== 'active') {
            abort(403, 'Akun belum aktif');
        }

        // 🔐 cek role (STRING, bukan angka)
        if (!in_array($user->role, $roles)) {
            abort(403, 'Anda tidak punya akses');
        }

        return $next($request);
    }
}
