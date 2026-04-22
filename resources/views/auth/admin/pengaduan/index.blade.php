@extends('auth.admin.layouts.main')
@section('title', 'Pengaduan')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-2xl shadow flex justify-between">

        <div>
            <h2 class="text-lg font-semibold text-white">Data Pengaduan</h2>
            <p class="text-sm text-white/70">Kelola laporan masyarakat</p>
        </div>

        <form method="GET" class="flex items-center gap-2">

            <div class="relative">
                <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari pelapor / korban..."
                    class="pl-10 pr-4 py-2 w-[240px]
                       bg-black/10 border border-blue-200 
                       rounded-lg text-sm
                       focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <span class="absolute left-3 top-2 text-black text-sm">🔍</span>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                Cari
            </button>

        </form>

    </div>

    <!-- INFO -->
    <div class="flex justify-between text-sm text-gray-500">
        <span>Total: <b>{{ $complaints->total() }}</b></span>
        <span>Halaman {{ $complaints->currentPage() }} / {{ $complaints->lastPage() }}</span>
    </div>

    <!-- TABLE -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-center w-12">No</th>
                    <th class="px-4 py-3 text-left">Nama Pelapor</th>
                    <th class="px-4 py-3 text-left">NamaKorban</th>
                    <th class="px-4 py-3 text-center">Jenis</th>
                    <th class="px-4 py-3 text-left">Alamat Kejadian</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @forelse ($complaints as $row)

                <tr onclick="window.location='{{ route('auth.admin.pengaduan.show', $row->id) }}'"
                    class="hover:bg-gray-50 cursor-pointer transition">

                    <!-- NO -->
                    <td class="px-4 py-4 text-center text-gray-400">
                        {{ $complaints->firstItem() + $loop->index }}
                    </td>

                    <!-- PELAPOR -->
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">

                            <div class="avatar">
                                {{ strtoupper(substr($row->society->name ?? 'U', 0, 1)) }}
                            </div>

                            <div class="leading-tight">
                                <p class="font-medium text-gray-800">
                                    {{ $row->society->name ?? '-' }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $row->nik }}
                                </p>
                            </div>

                        </div>
                    </td>

                    <!-- KORBAN -->
                    <td class="px-4 py-4 text-gray-700">
                        {{ $row->nama_korban ?? '-' }}
                    </td>

                    <!-- JENIS -->
                    <td class="px-4 py-4 text-center">
                        <span class="badge-jenis">
                            {{ ucfirst($row->jenis_kekerasan) }}
                        </span>
                    </td>

                    <!-- ALAMAT -->
                    <td class="px-4 py-4 text-gray-500">
                        <div class="truncate max-w-[220px]">
                            {{ $row->alamat_korban }}
                        </div>
                    </td>

                    <!-- STATUS -->
                    <td class="px-4 py-4 text-center">
                        @if ($row->status == 'finished')
                        <span class="badge-success">Selesai</span>
                        @elseif ($row->status == 'process')
                        <span class="badge-warning">Diproses</span>
                        @elseif ($row->status == 'rejected')
                        <span class="badge-danger">Ditolak</span>
                        @else
                        <span class="badge-neutral">Belum</span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="px-4 py-4 text-center">

                        <div class="flex justify-center items-center gap-2">

                            <!-- VIEW -->
                            <a href="{{ route('auth.admin.pengaduan.show', $row->id) }}"
                                onclick="event.stopPropagation()"
                                class="icon-btn icon-blue"
                                title="Lihat Detail">

                                <i class="bx bx-show text-lg"></i>

                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('auth.admin.pengaduan.edit', $row->id) }}"
                                onclick="event.stopPropagation()"
                                class="icon-btn icon-yellow"
                                title="Edit Data">

                                <i class="bx bx-edit text-lg"></i>

                            </a>

                        </div>

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

        <!-- PAGINATION -->
        <div class="p-4 border-t bg-gray-50">
            {{ $complaints->links() }}
        </div>

    </div>

</div>

@endsection