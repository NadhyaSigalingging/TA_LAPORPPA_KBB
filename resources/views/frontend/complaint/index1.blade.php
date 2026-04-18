@extends('frontend.layouts.app')
@section('title', 'Riwayat Laporan - LAPORPPA-KBB')

@section('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<style>
    .table-card {
        border-radius: 16px !important;
        border: 1.5px solid rgba(216,145,181,0.15) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        overflow: hidden;
        animation: fadeUp 0.6s ease both;
    }

    .table-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .table-card-header .header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .table-card-header .header-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.3);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; color: #1a1a2e;
    }
    .table-card-header h5 { margin: 0; font-size: 15px; font-weight: 700; color: #1a1a2e; }

    #datatable thead th {
        background: #f8f0f5 !important;
        color: #1a1a2e !important;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        border-bottom: 2px solid rgba(216,145,181,0.3) !important;
        padding: 14px 12px;
        font-size: 13.5px;
    }
    #datatable tbody td {
        vertical-align: middle;
        text-align: center;
        padding: 13px 12px;
        font-size: 13.5px;
        border-bottom: 1px solid #f5f0f5;
        color: #1a1a2e;
    }
    #datatable tbody tr { transition: background 0.2s; }
    #datatable tbody tr:hover { background-color: #fdf8fc; }

    .btn-detail {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 12.5px;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(26,26,46,0.25);
        color: white;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #ddd;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 13.5px;
        transition: border-color 0.2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #D891B5;
        outline: none;
        box-shadow: 0 0 0 3px rgba(216,145,181,0.15);
    }
    .dataTables_wrapper .dataTables_info {
        font-size: 13px;
        color: #6c757d;
        padding-top: 14px;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 14px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 7px !important;
        padding: 5px 11px !important;
        margin: 0 2px !important;
        font-size: 13px;
        border: 1px solid #e0e0e0 !important;
        transition: all 0.2s;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(216,145,181,0.15) !important;
        border-color: #D891B5 !important;
        color: #1a1a2e !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #D891B5, #B5618E) !important;
        border-color: #D891B5 !important;
        color: white !important;
    }

    .empty-state {
        padding: 64px 20px;
        text-align: center;
        animation: fadeUp 0.6s ease both;
    }
    .empty-state .empty-icon {
        width: 90px; height: 90px;
        background: rgba(216,145,181,0.1);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
        color: #D891B5;
    }
    .empty-state h5 { font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
    .empty-state p  { color: #6c757d; font-size: 14px; margin-bottom: 24px; }

    .btn-buat-laporan {
        background: linear-gradient(135deg, #D891B5, #B5618E);
        color: #fff; border: none; border-radius: 50px;
        padding: 11px 28px; font-size: 14px; font-weight: 600;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(184,97,142,0.3);
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-buat-laporan:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(184,97,142,0.42);
        color: #fff;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        #datatable thead th,
        #datatable tbody td { font-size: 12px; padding: 10px 8px; }
        .table-card-header { padding: 14px 16px; flex-direction: column; align-items: flex-start; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<x-hero
    title="Riwayat Laporan Anda"
    subtitle="Pantau status semua laporan yang telah Anda buat"
/>

<div class="container pb-5">

    <div class="card table-card">
        <div class="table-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-history"></i></div>
                <h5>Daftar Laporan</h5>
            </div>
            <a href="{{ route('choose_victim') }}" class="btn-buat-laporan">
                <i class="fas fa-plus"></i> Buat Laporan Baru
            </a>
        </div>

        <div class="card-body p-4">
            @if($complaint->count() > 0)
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="min-width:60px;">No</th>
<th style="min-width:170px;">Kode Laporan</th>
<th style="min-width:120px;">Tanggal</th>
<th style="min-width:180px;">Nama Korban</th>
<th style="min-width:160px;">Jenis Kekerasan</th>
<th style="min-width:180px;">Status</th>
<th style="min-width:120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaint as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
<td>
    <span style="background:#1a1a2e; color:#fff; font-size:11px; font-weight:700; padding:3px 10px; border-radius:50px; letter-spacing:0.5px;">
        {{ $row->unique_code ?? '-' }}
    </span>
</td>
<td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
<td>{{ $row->nama_korban ?? '-' }}</td>
<td>
    @if($row->jenis_kekerasan)
        <span style="background:#e8f4fd; color:#1a5276; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600;">
            {{ ucfirst($row->jenis_kekerasan) }}
        </span>
    @else
        <span class="text-muted">-</span>
    @endif
</td>
<td>
    <x-status-badge status="{{ $row->status }}" />
</td>
<td>
    <a href="{{ url('user/complaint/detail/'.$row->id) }}" class="btn-detail">
        <i class="fas fa-eye"></i> Detail
    </a>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h5>Belum Ada Laporan</h5>
                    <p>Anda belum membuat laporan apapun.<br>Mulai buat laporan sekarang jika Anda atau seseorang membutuhkan bantuan.</p>
                    <a href="{{ route('choose_victim') }}" class="btn-buat-laporan">
                        <i class="fas fa-plus"></i> Buat Laporan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('script')
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                },
                emptyTable: "Tidak ada data yang tersedia",
                zeroRecords: "Data tidak ditemukan"
            },
            pageLength: 10,
            order: [[1, 'desc']],
 columnDefs: [
    { orderable: false, targets: [6] },
    { className: "text-center", targets: "_all" },
    { width: "120px", targets: [6] }
],
        });
    });
</script>
@endpush