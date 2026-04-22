@extends('auth.admin.layouts.main')
@section('title', 'Respon Pengaduan')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white 
        p-6 rounded-2xl shadow-md flex flex-col md:flex-row justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">Respon Pengaduan</h1>
            <p class="text-blue-100 text-sm">Kelola dan tindak lanjuti laporan masyarakat</p>
        </div>

    </div>

    <!-- ================= ALERT ================= -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <!-- ================= FORM ================= -->
    <form action="{{ route('auth.admin.pengaduan.save', $complaint->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid lg:grid-cols-2 gap-6">

            <!-- ================= LEFT ================= -->
            <div class="bg-white rounded-2xl border shadow-sm p-5">

                <h3 class="font-semibold text-gray-800 mb-4">Informasi Laporan</h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <p class="text-gray-500">Nama Pelapor</p>
                        <p class="font-medium">{{ $complaint->society->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">NIK</p>
                        <p class="font-medium">{{ $complaint->nik }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jenis</p>
                        <p class="font-medium">{{ ucfirst($complaint->jenis_kekerasan) }}</p>
                    </div>

                    <!-- STATUS -->
                    <div>
                        <p class="text-gray-500 mb-1">Status</p>

                        @php
                        $statusText = match ($complaint->status) {
                            'finished' => 'Selesai',
                            'rejected' => 'Ditolak',
                            'process', 'onprogres' => 'Diproses',
                            default => ucfirst($complaint->status)
                        };
                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if(in_array($complaint->status, ['process','onprogres'])) bg-blue-100 text-blue-600
                            @elseif($complaint->status == 'finished') bg-green-100 text-green-600
                            @elseif($complaint->status == 'rejected') bg-red-100 text-red-600
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ $statusText }}
                        </span>
                    </div>

                </div>

                <!-- ================= DESKRIPSI FIX ================= -->
                <div class="mt-6">
                    <p class="text-gray-500 text-sm mb-2">Deskripsi</p>

                    <div class="bg-gray-50 border rounded-xl p-4 text-sm leading-relaxed 
                                break-words whitespace-pre-wrap overflow-auto max-h-[250px]">

                        {!! nl2br(e($complaint->contents_of_the_report)) !!}

                    </div>
                </div>

                <!-- ================= FOTO ================= -->
                @if($complaint->photo)
                <div class="mt-6">
                    <p class="text-gray-500 text-sm mb-2">Foto Bukti</p>
                    <img src="{{ asset('avatar_complaint/' . $complaint->photo) }}"
                        class="rounded-xl w-full max-h-[300px] object-cover shadow">
                </div>
                @endif

            </div>

            <!-- ================= RIGHT ================= -->
            <div class="bg-white rounded-2xl border shadow-sm p-5">

                <h3 class="font-semibold text-gray-800 mb-4">Form Respon Admin</h3>

                <!-- ADMIN -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Admin</label>
                    <input type="text"
                        value="{{ $complaint->response->admin->officer_name ?? auth()->user()->officer_name }}"
                        class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                        readonly>
                </div>

                <!-- STATUS -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Status</label>
                    <select name="status"
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="process">Diproses</option>
                        <option value="finished">Selesai</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>

                <!-- KETERANGAN -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Keterangan</label>
                    <textarea name="response" rows="5"
                        class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500">{{ optional($complaint->response)->response }}</textarea>
                </div>

                <!-- UPLOAD -->
                <div class="mb-4">
                    <label class="text-sm text-gray-600">Upload Bukti</label>
                    <input type="file" name="bukti"
                        class="w-full mt-1 text-sm">
                </div>

                <!-- ACTION -->
                <div class="flex gap-3 mt-6">

                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg shadow-sm transition">
                        Simpan
                    </button>

                    <a href="{{ route('auth.admin.pengaduan.index') }}"
                        class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg text-center">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection