<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\Society;
use App\Models\User;

class PasswordResetController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | USER (SOCIETY)
    |--------------------------------------------------------------------------
    */

    public function showForgotForm()
    {
        return view('frontend.password.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:society,email',
        ]);

        $status = Password::broker('society')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset dikirim ke email')
            : back()->withErrors(['email' => 'Gagal kirim email']);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('frontend.password.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('society')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Society $user, string $password) {

                $user->password = Hash::make($password);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user_login')->with('success', 'Password berhasil direset')
            : back()->withErrors(['email' => 'Token tidak valid']);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function showForgotAdmin()
    {
        return view('auth.admin.forgot');
    }

    public function sendResetLinkAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $admin = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email bukan admin']);
        }

        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset admin dikirim')
            : back()->withErrors(['email' => 'Gagal kirim email']);
    }

    public function showResetAdmin(Request $request, $token)
    {
        return view('auth.admin.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetAdmin(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {

                if ($user->role !== 'admin') {
                    return;
                }

                $user->password = Hash::make($password);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', 'Password admin berhasil direset')
            : back()->withErrors(['email' => 'Token tidak valid']);
    }
}
