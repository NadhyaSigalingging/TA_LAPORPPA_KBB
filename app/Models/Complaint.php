<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaint';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * =====================
     * CASTING (BIAR DATE RAPI)
     * =====================
     */
    protected $casts = [
        'tgl_lahir_korban' => 'date',
        'date_complaint'   => 'date',
        'waktu_kejadian'   => 'datetime',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /**
     * =====================
     * RELASI
     * =====================
     */

    // Pelapor
    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id', 'id');
    }

    // Response (admin)
    public function response()
    {
        return $this->hasOne(Response::class, 'complaint_id', 'id');
    }

    /**
     * =====================
     * ACCESSOR (BIAR LEBIH CLEAN DI VIEW)
     * =====================
     */

    // 🔥 Umur otomatis dari tanggal lahir
    public function getUmurKorbanAttribute()
    {
        if ($this->tgl_lahir_korban) {
            return Carbon::parse($this->tgl_lahir_korban)->age;
        }

        return $this->usia_korban;
    }

    // 🔥 Status versi Indonesia
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            '0'        => 'Belum Diproses',
            'process'  => 'Diproses',
            'finished' => 'Selesai',
            'rejected' => 'Ditolak',
            default    => 'Tidak Diketahui',
        };
    }

    // 🔥 Warna status (biar gak nulis if di blade)
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            '0'        => 'bg-gray-100 text-gray-600',
            'process'  => 'bg-yellow-100 text-yellow-700',
            'finished' => 'bg-green-100 text-green-700',
            'rejected' => 'bg-red-100 text-red-700',
            default    => 'bg-gray-100 text-gray-600',
        };
    }

    // 🔥 Cek ada lampiran
    public function getHasBuktiAttribute()
    {
        return $this->response && $this->response->bukti;
    }
}
