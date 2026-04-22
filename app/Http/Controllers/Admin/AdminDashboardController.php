<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // ================= TAHUN =================
        $tahun = $request->input('year', now()->year);

        // ================= STATISTIK =================
        $totalPengaduan = Complaint::count();

        // ⚠️ pastikan konsisten string (sesuai DB kamu)
        $belum    = Complaint::where('status', '0')->count();
        $diproses = Complaint::where('status', 'process')->count();
        $selesai  = Complaint::where('status', 'finished')->count();

        $totalUser       = User::count();
        $totalMasyarakat = Society::count();

        // ================= GRAFIK BULAN =================
        $chart = Complaint::selectRaw('MONTH(date_complaint) as bulan, COUNT(*) as total')
            ->whereYear('date_complaint', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $data   = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()
                ->month($i)
                ->locale('id')
                ->translatedFormat('F');

            $data[] = (int) ($chart[$i] ?? 0);
        }

        // ================= PIE CHART (FIX BUG) =================
        // 🔥 HARUS ARRAY NUMERIC (bukan associative)
        $statusChart = [
            (int) $selesai,
            (int) $diproses,
            (int) $belum
        ];

        // ================= QUERY =================
        $query = Complaint::with('society:id,name');

        // ================= SEARCH =================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_korban', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhereHas('society', function ($s) use ($search) {
                        $s->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // ================= DATA TABEL =================
        $dataPengaduan = $query
            ->orderByDesc('date_complaint')
            ->paginate(10)
            ->withQueryString();

        // ================= RETURN =================
        return view('auth.admin.dashboard.index', [
            'totalPengaduan'  => $totalPengaduan,
            'belum'           => $belum,
            'diproses'        => $diproses,
            'selesai'         => $selesai,
            'totalUser'       => $totalUser,
            'totalMasyarakat' => $totalMasyarakat,

            // chart
            'labels'          => $labels,
            'data'            => $data,
            'statusChart'     => $statusChart,

            // tabel
            'dataPengaduan'   => $dataPengaduan,

            'tahun'           => $tahun,
        ]);
    }
}
