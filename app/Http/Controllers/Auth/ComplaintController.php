<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    // =====================
    // LIST + SEARCH + PAGINATION
    // =====================
    public function index(Request $request)
    {
        $query = Complaint::with(['society']);

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%")
                    ->orWhere('nama_korban', 'like', "%$search%")
                    ->orWhereHas('society', function ($s) use ($search) {
                        $s->where('name', 'like', "%$search%");
                    });
            });
        }

        $complaints = $query
            ->latest('date_complaint')
            ->paginate(10)
            ->withQueryString();

        return view('auth.admin.pengaduan.index', compact('complaints'));
    }

    // =====================
    // DETAIL
    // =====================
    public function show(Complaint $complaint)
    {
        $complaint->load([
            'society',
            'response.admin' // WAJIB biar bukti kebaca
        ]);

        return view('auth.admin.pengaduan.show', compact('complaint'));
    }

    // =====================
    // EDIT (AUTO RESPONSE)
    // =====================
    public function edit(Complaint $complaint)
    {
        $complaint->load(['society', 'response.admin']);

        // 🔥 Auto create response jika belum ada
        if (!$complaint->response) {
            $complaint->response()->create([
                'admin_id' => auth()->id(),
                'response' => null,
                'bukti'    => null,
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

        DB::beginTransaction();

        try {

            // update status complaint
            $complaint->update([
                'status' => $request->status
            ]);

            // ambil / buat response
            $response = Response::firstOrCreate(
                ['complaint_id' => $complaint->id],
                ['admin_id' => auth()->id()]
            );

            // 📸 Upload bukti (pakai Storage - BEST PRACTICE)
            if ($request->hasFile('bukti')) {

                // hapus file lama jika ada
                if ($response->bukti && Storage::disk('public')->exists($response->bukti)) {
                    Storage::disk('public')->delete($response->bukti);
                }

                $path = $request->file('bukti')->store('bukti_laporan', 'public');

                $response->bukti = $path;
            }

            // update response
            $response->update([
                'response' => $request->response,
                'admin_id' => $response->admin_id ?? auth()->id()
            ]);

            DB::commit();

            return back()->with('success', 'Respon berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =====================
    // UPDATE STATUS CEPAT
    // =====================
    public function updateStatus(Complaint $complaint, $status)
    {
        $allowed = ['process', 'finished', 'rejected'];

        abort_unless(in_array($status, $allowed), 404);

        $complaint->update([
            'status' => $status
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }
}
