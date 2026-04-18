@extends('auth.admin.layouts.main')
@section('title', 'Pengaduan')

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        /* ================= BASE ================= */
        .pengaduan-page {
            font-family: 'Segoe UI', sans-serif;
        }

        /* ================= HEADER ================= */
        .header-box {
            background: linear-gradient(135deg, #0B3C91, #1E5ED7);
            border-radius: 16px;
            padding: 20px;
            color: white;
        }

        /* ================= CARD ================= */
        .custom-card {
            border-radius: 18px;
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        /* ================= TABLE ================= */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table-modern thead th {
            background: linear-gradient(90deg, #1E5ED7, #0B3C91);
            color: white;
            padding: 14px !important;
            border: none;
        }

        .table-modern tbody tr {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .table-modern td {
            padding: 14px !important;
            vertical-align: middle;
        }

        /* ================= STATUS ================= */
        .status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        /* warna soft (lebih profesional) */
        .status-selesai {
            background: rgba(39, 174, 96, 0.15);
            color: #27ae60;
        }

        .status-proses {
            background: rgba(30, 94, 215, 0.15);
            color: #1E5ED7;
        }

        .status-ditolak {
            background: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
        }

        .status-belum {
            background: rgba(148, 163, 184, 0.2);
            color: #64748b;
        }

        /* ================= BUTTON ================= */
        .btn-edit,
        .btn-view {
            border-radius: 10px;
            padding: 6px 10px;
            border: none;
        }

        .btn-view {
            background: rgba(30, 94, 215, 0.15);
            color: #1E5ED7;
        }

        .btn-view:hover {
            background: #1E5ED7;
            color: white;
        }

        .btn-edit {
            background: rgba(243, 156, 18, 0.15);
            color: #f39c12;
        }

        .btn-edit:hover {
            background: #f39c12;
            color: white;
        }

        /* ================= SEARCH ================= */
        .search-box {
            max-width: 260px;
            border-radius: 10px;
        }

        /* ================= DARK MODE FIX ================= */
        body.dark-mode {

            /* background lebih soft */
            background: #0f172a;
        }

        /* CARD */
        body.dark-mode .custom-card {
            background: #1e293b;
            border: 1px solid #334155;
        }

        /* TABLE */
        body.dark-mode .table-modern tbody tr {
            background: #1e293b;
            box-shadow: none;
        }

        body.dark-mode .table-modern td {
            color: #e5e7eb;
        }

        body.dark-mode .table-modern thead th {
            background: linear-gradient(90deg, #1d4ed8, #1e40af);
        }

        /* HOVER */
        body.dark-mode .table-modern tbody tr:hover {
            background: #334155;
        }

        /* HEADER */
        body.dark-mode .header-box {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }

        /* SEARCH */
        body.dark-mode .search-box {
            background: #334155;
            color: #e5e7eb;
            border: 1px solid #475569;
        }

        /* PAGINATION */
        body.dark-mode .dataTables_paginate .paginate_button {
            color: #e5e7eb !important;
        }

        body.dark-mode .dataTables_paginate .paginate_button.current {
            background: #1E5ED7 !important;
            color: white !important;
        }
    </style>
@endsection


@section('content')
    <div class="pengaduan-page container-fluid">

        <!-- HEADER -->
        <div class="header-box mb-4 d-flex justify-content-between align-items-center">

            <div>
                <h2 class="m-0 text-white fw-bold">Data Pengaduan </h2>
                <small>Laporan masyarakat yang masuk </small>
            </div>
        </div>

        <!-- CARD -->
        <div class="card custom-card">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover table-modern datatable w-100">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Korban</th>
                                <th>Alamat</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($complaints as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td><b>{{ $row->society->name ?? '-' }}</b></td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->nama_korban }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($row->alamat_korban, 25) }}</td>
                                    <td>{{ $row->jenis_kekerasan }}</td>

                                    <td>
                                        @if ($row->status == 'finished')
                                            <span class="status status-selesai">Selesai</span>
                                        @elseif ($row->status == 'process')
                                            <span class="status status-proses">Diproses</span>
                                        @elseif ($row->status == 'rejected')
                                            <span class="status status-ditolak">Ditolak</span>
                                        @else
                                            <span class="status status-belum">Belum</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ url('admin/complaints/' . $row->id) }}" class="btn btn-edit">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ url('admin/complaints/' . $row->id . '/edit') }}" class="btn btn-view">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            let table;

            if ($.fn.DataTable.isDataTable('.datatable')) {
                table = $('.datatable').DataTab le();
            } else {
                table = $('.datatable').DataTable({
                    responsive: true,
                    pageLength: 5,
                    dom: 'rtp'
                });
            }

            $('#searchInput').on('keyup', function () {
                table.search(this.value).draw();
            });

        });
    </script>
@endpush