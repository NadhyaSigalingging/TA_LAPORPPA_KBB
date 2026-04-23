<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\Complaint;

class NotificationHelper
{
    /**
     * Label status dalam Bahasa Indonesia
     */
    public static function labelStatus(string $status): string
    {
        return match ($status) {
            '0'        => 'Menunggu Verifikasi',
            'process'  => 'Sedang Diproses',
            'finished' => 'Selesai',
            'rejected' => 'Ditolak',
            default    => ucfirst($status),
        };
    }

    /**
     * Buat notifikasi saat laporan baru dibuat (status awal = '0')
     */
    public static function buatLaporanBaru(Complaint $complaint): void
    {
        Notification::create([
            'society_id'    => $complaint->society_id,
            'complaint_id'  => $complaint->id,
            'judul'         => 'Laporan Berhasil Dikirim',
            'pesan'         => 'Laporan Anda dengan kode ' . $complaint->unique_code . ' telah berhasil dikirim dan sedang menunggu verifikasi dari petugas.',
            'status_laporan'=> '0',
            'is_read'       => false,
        ]);
    }

    /**
     * Buat notifikasi saat status laporan diperbarui oleh admin
     */
    public static function updateStatus(Complaint $complaint, string $statusBaru): void
    {
        $labelStatus = self::labelStatus($statusBaru);

        $pesan = match ($statusBaru) {
            'process'  => 'Laporan Anda dengan kode ' . $complaint->unique_code . ' sedang diproses oleh petugas. Kami akan segera menindaklanjuti laporan Anda.',
            'finished' => 'Laporan Anda dengan kode ' . $complaint->unique_code . ' telah selesai ditangani. Silakan cek detail laporan untuk melihat hasil penanganan.',
            'rejected' => 'Laporan Anda dengan kode ' . $complaint->unique_code . ' tidak dapat diproses. Silakan cek detail laporan untuk informasi lebih lanjut.',
            default    => 'Status laporan Anda dengan kode ' . $complaint->unique_code . ' telah diperbarui menjadi ' . $labelStatus . '.',
        };

        Notification::create([
            'society_id'    => $complaint->society_id,
            'complaint_id'  => $complaint->id,
            'judul'         => 'Status Laporan: ' . $labelStatus,
            'pesan'         => $pesan,
            'status_laporan'=> $statusBaru,
            'is_read'       => false,
        ]);
    }

    /**
     * Buat notifikasi saat admin memberikan/memperbarui respon
     */
    public static function responAdmin(Complaint $complaint): void
    {
        Notification::create([
            'society_id'    => $complaint->society_id,
            'complaint_id'  => $complaint->id,
            'judul'         => 'Petugas Memberikan Respon',
            'pesan'         => 'Petugas telah memberikan respon pada laporan Anda dengan kode ' . $complaint->unique_code . '. Silakan cek detail laporan untuk membaca respon tersebut.',
            'status_laporan'=> $complaint->status,
            'is_read'       => false,
        ]);
    }
}