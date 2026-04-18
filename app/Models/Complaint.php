<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaint';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * Relasi: Setiap laporan punya satu masyarakat (pelapor)
     */
    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id', 'id');
    }

    /**
     * Relasi: Setiap laporan bisa punya satu respons
     */

    public function response()
{
    return $this->hasOne(\App\Models\Response::class, 'complaint_id', 'id');
}
}