<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'society_id',
        'complaint_id',
        'judul',
        'pesan',
        'status_laporan',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relasi ke Society (pelapor)
    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id');
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }


}