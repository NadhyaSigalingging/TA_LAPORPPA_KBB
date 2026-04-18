<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\Society;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('frontend.password.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:society,email',
        ], [
            'email.exists' => 'Email ini tidak terdaftar di sistem kami.',
        ]);

        $status = Password::broker('society')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox.');
        }

        return back()->withErrors(['email' => 'Gagal mengirim link reset. Coba lagi.']);
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
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
        ]);

        $status = Password::broker('society')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Society $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('user_login')
                ->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
        }

        return back()->withErrors(['email' => 'Link reset tidak valid atau sudah kadaluarsa.']);
    }
}