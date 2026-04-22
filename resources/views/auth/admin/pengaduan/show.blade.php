@extends('auth.admin.layouts.main')
@section('title', 'Detail Pengaduan')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 
        text-white p-6 rounded-2xl shadow-md flex flex-col md:flex-row justify-between items-center gap-4">

        <div>
            <h1 class="text-2xl font-bold">Detail Pengaduan</h1>
            <p class="text-blue-100 text-sm mt-1">
                Kode: <span class="font-semibold text-white">
                    {{ $complaint->unique_code ?? '-' }}
                </span>
            </p>
        </div>

        <span class="px-5 py-2 rounded-full text-sm font-semibold backdrop-blur bg-white/20 border border-white/30
            @if($complaint->status == 'finished') text-green-200
            @elseif($complaint->status == 'process') text-yellow-200
            @elseif($complaint->status == 'rejected') text-red-200
            @else text-gray-200
            @endif">

            @if($complaint->status == '0') Belum Diproses
            @elseif($complaint->status == 'process') Sedang Diproses
            @elseif($complaint->status == 'finished') Selesai
            @elseif($complaint->status == 'rejected') Ditolak
            @endif

        </span>
    </div>

    <!-- ================= TIMELINE ================= -->
    <div class="bg-white rounded-2xl border shadow-sm p-6">

        <h3 class="text-sm font-semibold text-gray-700 mb-6">Progress Pengaduan</h3>

        <div class="relative flex items-center justify-between">

            <div class="absolute top-3 left-0 w-full h-1 bg-gray-200 rounded"></div>

            <div class="absolute top-3 left-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded"
                style="width:
                @if($complaint->status == '0') 10%
                @elseif($complaint->status == 'process') 55%
                @else 100%
                @endif">
            </div>

            @foreach(['Belum','Diproses','Selesai'] as $i => $step)
            <div class="relative z-10 text-center w-full">
                <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center text-sm font-bold
                    @if($i == 0) bg-blue-500 text-white
                    @elseif($i == 1 && ($complaint->status=='process'||$complaint->status=='finished')) bg-yellow-400 text-white
                    @elseif($i == 2 && $complaint->status=='finished') bg-green-500 text-white
                    @else bg-gray-300 text-gray-600
                    @endif">
                    {{ $i+1 }}
                </div>
                <p class="text-xs mt-2 text-gray-600">{{ $step }}</p>
            </div>
            @endforeach

        </div>
    </div>

    <!-- ================= GRID ================= -->
    <div class="grid lg:grid-cols-3 gap-6">

        @php
        function card() {
        return "bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md transition";
        }
        @endphp

        <!-- PELAPOR -->
        <div class="{{ card() }}">
            <h3 class="font-semibold mb-4 text-gray-800">Data Pelapor</h3>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr($complaint->society->name ?? 'U',0,1)) }}
                </div>
                <div>
                    <p class="font-semibold">{{ $complaint->society->name ?? '-' }}</p>
                    <p class="text-xs text-gray-500">Pelapor</p>
                </div>
            </div>

            <div class="text-sm space-y-1">
                <p><span class="text-gray-500">NIK:</span> {{ $complaint->nik }}</p>
                <p><span class="text-gray-500">Tanggal:</span>
                    {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <!-- KORBAN -->
        <div class="{{ card() }} lg:col-span-2">

            <h3 class="font-semibold mb-4 text-gray-800">Data Korban</h3>

            @php
            $umur = $complaint->tgl_lahir_korban
            ? \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->age
            : ($complaint->usia_korban ?? null);
            @endphp

            <div class="grid md:grid-cols-2 gap-4 text-sm">

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Nama</p>
                    <p class="font-semibold">{{ $complaint->nama_korban ?? '-' }}</p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">NIK</p>
                    <p>{{ $complaint->nik_korban ?? '-' }}</p>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border">
                    <p class="text-xs text-gray-500">Umur</p>
                    <p class="text-blue-600 font-bold text-xl">
                        {{ $umur ? $umur.' tahun' : '-' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Tanggal Lahir</p>
                    <p>
                        {{ $complaint->tgl_lahir_korban
                        ? \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->translatedFormat('d F Y')
                        : '-' }}
                    </p>
                </div>

                <div class="md:col-span-2 bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Jenis Kelamin</p>
                    <p>{{ $complaint->jenis_kelamin_korban ?? '-' }}</p>
                </div>

                <div class="md:col-span-2 bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Nomor HP</p>
                    <p>{{ $complaint->nomor_korban ?? '-' }}</p>
                </div>

            </div>
        </div>

        <!-- ALAMAT -->
        <div class="{{ card() }}">
            <h3 class="font-semibold mb-3 text-gray-800">Alamat</h3>
            <p class="text-sm"><span class="text-gray-500">Tinggal:</span> {{ $complaint->alamat_korban_tinggal ?? '-' }}</p>
            <p class="text-sm mt-2"><span class="text-gray-500">Kejadian:</span> {{ $complaint->alamat_korban ?? '-' }}</p>
        </div>

        <!-- KEJADIAN -->
        <div class="{{ card() }}">
            <h3 class="font-semibold mb-3 text-gray-800">Detail Kejadian</h3>
            <p class="text-sm"><span class="text-gray-500">Jenis:</span> {{ $complaint->jenis_kekerasan ?? '-' }}</p>
            <p class="text-sm mt-1"><span class="text-gray-500">Tanggal:</span> {{ $complaint->date_complaint ?? '-' }}</p>
            <p class="text-sm mt-1"><span class="text-gray-500">Waktu:</span> {{ $complaint->waktu_kejadian ?? '-' }}</p>
        </div>

        <!-- ISI -->
        <div class="{{ card() }} lg:col-span-3">
            <h3 class="font-semibold mb-3 text-gray-800">Isi Laporan</h3>
            <div class="bg-gray-50 p-4 rounded-lg leading-relaxed">
                {{ $complaint->contents_of_the_report ?? '-' }}
            </div>
        </div>

        <!-- FOTO -->
        @if($complaint->photo)
        <div class="{{ card() }} lg:col-span-3">
            <h3 class="font-semibold mb-3 text-gray-800">Bukti Foto</h3>
            <img src="{{ asset('storage/'.$complaint->photo) }}"
                class="rounded-xl w-full max-h-[350px] object-cover">
        </div>
        @endif

        <!-- RESPON (TIDAK DIHAPUS!) -->
        <div class="{{ card() }} lg:col-span-3">
            <h3 class="font-semibold mb-3 text-gray-800">Respon Admin</h3>

            @php $response = $complaint->response; @endphp

            <p class="text-sm text-gray-500 mb-2">
                Petugas: {{ optional(optional($response)->admin)->officer_name ?? '-' }}
            </p>

            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                {{ $response->response ?? 'Belum ada respon' }}
            </div>

            @if($response && $response->bukti)

            @php
            $file = $response->bukti;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $url = asset('bukti_laporan/'.$file);
            @endphp

            @if(in_array($ext, ['jpg','jpeg','png']))
            <img src="{{ $url }}" class="rounded-xl max-h-[320px] w-full object-cover mb-3">

            <div class="flex gap-2">
                <a href="{{ $url }}" target="_blank"
                    class="px-4 py-2 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700">
                    Lihat
                </a>

                <a href="{{ $url }}" download
                    class="px-4 py-2 bg-gray-200 text-xs rounded-lg hover:bg-gray-300">
                    Download
                </a>
            </div>
            @else
            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border">
                <p class="text-sm">{{ $file }}</p>
                <div class="flex gap-2">
                    <a href="{{ $url }}" target="_blank"
                        class="px-3 py-1 text-xs bg-blue-600 text-white rounded-lg">
                        Lihat
                    </a>
                    <a href="{{ $url }}" download
                        class="px-3 py-1 text-xs bg-gray-200 rounded-lg">
                        Download
                    </a>
                </div>
            </div>
            @endif

            @endif

        </div>

    </div>

    <!-- ACTION -->
    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('auth.admin.pengaduan.edit', $complaint->id) }}"
            class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 shadow-sm">
            Kelola
        </a>

        <a href="{{ route('auth.admin.pengaduan.index') }}"
            class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
            Kembali
        </a>
    </div>

</div>

@endsection