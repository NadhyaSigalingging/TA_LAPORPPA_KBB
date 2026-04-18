<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // 🔐 pastikan sudah login
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // 🔐 cek role / level
        if (in_array(Auth::user()->level_id, $roles)) {
            return $next($request);
        }

        // 🚫 login tapi bukan admin
        abort(403, 'Anda tidak punya akses');
    }
}
