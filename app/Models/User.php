<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | HIDDEN
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | CAST
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔥 OVERRIDE RESET PASSWORD (INI KUNCI)
    |--------------------------------------------------------------------------
    */
    public function sendPasswordResetNotification($token)
    {
        $url = url(route('admin.password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        $this->notify(new class($url) extends ResetPassword {

            protected $url;

            public function __construct($url)
            {
                $this->url = $url;
            }

            public function toMail($notifiable)
            {
                return (new MailMessage)
                    ->subject('Reset Password Admin')
                    ->greeting('Halo Admin!')
                    ->line('Anda menerima email ini karena meminta reset password.')
                    ->action('Reset Password', $this->url)
                    ->line('Jika tidak merasa meminta reset, abaikan email ini.');
            }
        });
    }
}