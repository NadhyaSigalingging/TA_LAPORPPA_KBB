<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST ADMIN PENDING
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $users = User::where('role', 'admin')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('auth.admin.approval', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE ADMIN
    |--------------------------------------------------------------------------
    */
    public function approve(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        // ❗ kalau sudah active jangan di-approve lagi
        if ($user->status === 'active') {
            return back()->with('error', 'Admin sudah aktif');
        }

        $user->status = 'active';
        $user->save();

        return back()->with('success', 'Admin berhasil diaktifkan');
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT ADMIN
    |--------------------------------------------------------------------------
    */
    public function reject(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return back()->with('success', 'Admin ditolak dan dihapus');
    }
}
