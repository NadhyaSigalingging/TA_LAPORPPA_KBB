<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Society;
use Illuminate\Http\Request;  
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        
        $complaints = Complaint::count();
        $unprocessed = Complaint::where('status', 0)->count();
        $process = Complaint::where('status', 'process')->count();
        $finished = Complaint::where('status', 'finished')->count();
        $users = User::count();
        $society = Society::count();

       
        $year = $request->year ?? date('Y');

        
        $chart = DB::table('complaint')
            ->selectRaw('MONTH(date_complaint) as bulan, COUNT(*) as total')
            ->whereYear('date_complaint', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('F', mktime(0, 0, 0, $i, 1));
            $found = $chart->firstWhere('bulan', $i);
            $data[] = $found ? $found->total : 0;
        }

        return view('auth.admin.dashboard.index', compact(
            'complaints',
            'unprocessed',
            'process',
            'finished',
            'users',
            'society',
            'labels',
            'data',
            'year'
        ));
    }
}