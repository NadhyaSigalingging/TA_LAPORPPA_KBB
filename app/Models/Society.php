<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class Society extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'society';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'name',
        'username',
        'email',
        'password',
        'photo',
        'birth_date',
        'gender',
        'phone_number',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'   => 'hashed',
            'birth_date' => 'date',
        ];
    }

    /**
     * Relasi: Satu masyarakat bisa punya banyak laporan
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'society_id', 'id');
    }
}