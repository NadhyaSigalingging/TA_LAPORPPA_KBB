@extends('auth.admin.layouts.main')
@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-2xl shadow flex justify-between">
        <div>
            <h2 class="text-xl font-bold">
                Selamat Datang, {{ Auth::user()->username }} 👋
            </h2>
            <p class="text-sm text-blue-100">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-sm">Total User</p>
            <b class="text-lg">{{ $totalUser }}</b>
        </div>
    </div>

    <!-- ================= STAT ================= -->
    <div class="grid md:grid-cols-4 gap-5">

        <div class="card">
            <p>Total Pengaduan</p>
            <h2 class="text-blue-600">{{ $totalPengaduan }}</h2>
        </div>

        <div class="card">
            <p>Belum Diproses</p>
            <h2 class="text-red-500">{{ $belum }}</h2>
        </div>

        <div class="card">
            <p>Sedang Diproses</p>
            <h2 class="text-yellow-500">{{ $diproses }}</h2>
        </div>

        <div class="card">
            <p>Selesai</p>
            <h2 class="text-green-500">{{ $selesai }}</h2>
        </div>

    </div>

    <!-- ================= CHART ================= -->
    <div class="grid lg:grid-cols-3 gap-6">

        <!-- LINE -->
        <div class="lg:col-span-2 box">
            <h3 class="title">
                Grafik Pengaduan Tahun {{ $tahun }}
            </h3>

            <div class="h-[320px]">
                <canvas id="chart"></canvas>
            </div>
        </div>

        <!-- PIE -->
        <div class="box">
            <h3 class="title">
                Distribusi Status
            </h3>

            <div class="h-[320px] relative">
                <canvas id="pie"></canvas>
            </div>

            <!-- LEGEND -->
            <div class="mt-4 space-y-2 text-sm">

                <div class="flex justify-between">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        Selesai
                    </span>
                    <b>{{ $selesai }}</b>
                </div>

                <div class="flex justify-between">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                        Diproses
                    </span>
                    <b>{{ $diproses }}</b>
                </div>

                <div class="flex justify-between">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        Belum
                    </span>
                    <b>{{ $belum }}</b>
                </div>

            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-4 border-b bg-gray-50">
            <h3 class="font-semibold text-gray-700">Data Pengaduan</h3>
            <span class="text-sm text-gray-500">
                Total: {{ $dataPengaduan->total() }}
            </span>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-separate border-spacing-y-2">

                <thead class="text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3">Nama Pelapor</th>
                        <th class="px-4 py-3">Nama Korban</th>
                        <th class="px-4 py-3 text-center">Jenis</th>
                        <th class="px-4 py-3">Alamat Kejadian</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($dataPengaduan as $i => $d)
                    <tr class="bg-white shadow-sm rounded-xl hover:shadow-md transition">

                        <!-- NO -->
                        <td class="px-4 py-4 text-center text-gray-500">
                            {{ $dataPengaduan->firstItem() + $i }}
                        </td>

                        <!-- PELAPOR -->
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-semibold">
                                    {{ strtoupper(substr($d->society->name ?? 'U', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-800">
                                        {{ $d->society->name ?? '-' }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        NIK: {{ $d->nik }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- KORBAN -->
                        <td class="px-4 py-4 font-medium text-gray-700">
                            {{ $d->nama_korban ?? '-' }}
                        </td>

                        <!-- JENIS -->
                        <td class="px-4 py-4 text-center">
                            <span class="badge-jenis">
                                {{ ucfirst($d->jenis_kekerasan) }}
                            </span>
                        </td>

                        <!-- ALAMAT -->
                        <td class="px-4 py-4 text-gray-500">
                            <div class="max-w-[250px] truncate">
                                {{ $d->alamat_korban }}
                            </div>
                        </td>

                        <!-- STATUS -->
                        <td class="px-4 py-4 text-center">
                            @if($d->status == 'finished')
                            <span class="badge-success">Selesai</span>
                            @elseif($d->status == 'process')
                            <span class="badge-warning">Diproses</span>
                            @elseif($d->status == 'rejected')
                            <span class="badge-danger">Ditolak</span>
                            @else
                            <span class="badge-danger">Belum</span>
                            @endif
                        </td>

                        <!-- TANGGAL -->
                        <td class="px-4 py-4 text-center text-gray-500">
                            {{ \Carbon\Carbon::parse($d->date_complaint)->translatedFormat('d M Y') }}
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        <!-- PAGINATION -->
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $dataPengaduan->links() }}
        </div>

    </div>

</div>

@endsection

@push('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ================= LINE =================
        const line = document.getElementById('chart');

        if (line) {
            new Chart(line, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: @json($data),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    maintainAspectRatio: false
                }
            });
        }

        // ================= PIE =================
        const pie = document.getElementById('pie');

        if (pie) {

            let dataPie = @json($statusChart);

            // 🔥 fallback kalau kosong
            if (dataPie.every(v => v === 0)) {
                dataPie = [1, 0, 0];
            }

            new Chart(pie, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Diproses', 'Belum'],
                    datasets: [{
                        data: dataPie,
                        backgroundColor: ['#22c55e', '#eab308', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });

        } else {
            console.error("Pie chart tidak ditemukan");
        }

    });
</script>

@endpush