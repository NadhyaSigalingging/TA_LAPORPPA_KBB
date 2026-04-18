<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses'; // pastikan sesuai database
    protected $primaryKey = 'id';

    protected $fillable = [
        'complaint_id',
        'admin_id',
        'response',
        'bukti'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION: Complaint
    |--------------------------------------------------------------------------
    */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION: Admin (User)
    |--------------------------------------------------------------------------
    */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
