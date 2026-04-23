<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
   
    public function baca($id)
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        $notif = Notification::where('id', $id)
                             ->where('society_id', Session::get('society_id'))
                             ->firstOrFail();

        $notif->update(['is_read' => true]);

        return redirect()->route('detail_complaint', $notif->complaint_id);
    }


    public function bacaSemua(Request $request)
    {
        if (!Session::has('society_id')) {
            return response()->json(['success' => false], 401);
        }

        Notification::where('society_id', Session::get('society_id'))
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Ambil data notifikasi terbaru via AJAX (untuk polling)
     */
    public function ambilNotifikasi(Request $request)
    {
        if (!Session::has('society_id')) {
            return response()->json(['success' => false], 401);
        }

        $notifikasi = Notification::where('society_id', Session::get('society_id'))
                                  ->latest()
                                  ->take(15)
                                  ->get()
                                  ->map(function ($n) {
                                      return [
                                          'id'             => $n->id,
                                          'judul'          => $n->judul,
                                          'pesan'          => $n->pesan,
                                          'status_laporan' => $n->status_laporan,
                                          'is_read'        => $n->is_read,
                                          'waktu'          => $n->created_at->diffForHumans(),
                                          'waktu_detail'   => $n->created_at->translatedFormat('d M Y, H:i'),
                                          'url'            => route('notif.baca', $n->id),
                                      ];
                                  });

        $jumlahBelumDibaca = Notification::where('society_id', Session::get('society_id'))
                                         ->where('is_read', false)
                                         ->count();

        return response()->json([
            'success'            => true,
            'notifikasi'         => $notifikasi,
            'jumlah_belum_baca'  => $jumlahBelumDibaca,
        ]);
    }

    
}