<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Helpers\NotificationHelper;

class ComplaintController extends Controller
{
    // =====================
    // LIST DATA + FILTER
    // =====================
    public function index(Request $request)
    {
        $query = Complaint::with(['society', 'response.admin']);

        if ($request->filled('nik')) {
            $query->where('nik', 'like', '%' . $request->nik . '%');
        }

        if ($request->filled('nama')) {
            $query->whereHas('society', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('jenis_kekerasan', $request->kategori);
        }

        $complaints = $query->latest()->get();

        return view('auth.admin.pengaduan.index', compact('complaints'));
    }

    // =====================
    // DETAIL
    // =====================
    public function show(Complaint $complaint)
    {
        $complaint->load([
            'society',
            'response.admin'
        ]);

        return view('auth.admin.pengaduan.show', compact('complaint'));
    }

    // =====================
    // EDIT (AUTO ASSIGN ADMIN)
    // =====================
    public function edit(Complaint $complaint)
    {
        $complaint->load(['society', 'response.admin']);

        // Jika belum ada response → assign admin login
        if (!$complaint->response) {
            Response::create([
                'complaint_id' => $complaint->id,
                'admin_id'     => auth()->id(),
                'response'     => null,
                'bukti'        => null,
            ]);

            $complaint->load('response.admin');
        }

        return view('auth.admin.pengaduan.edit', compact('complaint'));
    }

    // =====================
    // SIMPAN RESPON ADMIN
    // =====================
   public function save(Request $request, Complaint $complaint)
{
    $request->validate([
        'status'   => 'required|in:process,finished,rejected',
        'response' => 'nullable|string',
        'bukti'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
    ]);

    $statusLama = $complaint->status;

    // Update status laporan
    $complaint->update([
        'status' => $request->status
    ]);

    // Ambil atau buat response jika belum ada
    $response = Response::firstOrCreate(
        ['complaint_id' => $complaint->id],
        ['admin_id' => auth()->id()]
    );

    // Upload bukti jika ada
    if ($request->hasFile('bukti')) {
        $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
        $request->file('bukti')->move(public_path('bukti_laporan'), $fileName);
        $response->bukti = $fileName;
    }

    // Update isi response
    $response->update([
        'response' => $request->response,
    ]);

    // Kirim notifikasi perubahan status (jika status berubah)
    if ($statusLama !== $request->status) {
        NotificationHelper::updateStatus($complaint->fresh(), $request->status);
    }

    // Kirim notifikasi respon admin (jika ada isi response)
    if ($request->filled('response')) {
        NotificationHelper::responAdmin($complaint->fresh());
    }

    return back()->with('success', 'Respon berhasil disimpan');
}

    // =====================
    // UPDATE STATUS VIA BUTTON
    // =====================
  public function updateStatus(Complaint $complaint, $status)
{
    $allowedStatus = ['process', 'finished', 'rejected'];
    abort_unless(in_array($status, $allowedStatus), 404);

    $statusLama = $complaint->status;

    $complaint->update([
        'status' => $status
    ]);

    // Kirim notifikasi jika status berubah
    if ($statusLama !== $status) {
        NotificationHelper::updateStatus($complaint->fresh(), $status);
    }

    return back()->with('success', 'Status pengaduan berhasil diperbarui');
}
}
