@extends('auth.admin.layouts.main')

@section('title', 'Masyarakat | Public Complaints')

@section('css')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

    <style>
        :root {
            --navy: #0B3C91;
            --navy-soft: #1E5ED7;
        }

        h4 {
            color: var(--navy);
            font-weight: 700;
        }

        .custom-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(90deg, var(--navy), var(--navy-soft));
            color: white;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 16px;
        }

        .table-modern {
            font-size: 12px;
        }

        .table-modern th {
            background: #f1f5fb;
            font-weight: 600;
            text-align: center;
        }

        .table-modern td {
            padding: 6px 8px;
            vertical-align: middle;
        }

        td:nth-child(8) {
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .avatar-img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-navy {
            background: var(--navy);
            color: white;
            border-radius: 10px;
        }

        .btn-navy:hover {
            background: #082b6b;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit {
            background: #eef3ff;
            color: var(--navy);
        }

        .btn-delete {
            background: #ffecec;
            color: #e74c3c;
        }

        .dataTables_filter,
        .dataTables_length {
            display: none !important;
        }

        .dataTables_paginate .paginate_button.current {
            background: var(--navy) !important;
            color: white !important;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <div>
                <h4>Masyarakat & Korban</h4>
                <small class="text-muted">Data pelapor dan korban dalam sistem</small>
            </div>

            <a href="{{route('auth.admin.masyarakat.create')}}" class="btn btn-navy">
                + Tambah
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <div class="card custom-card mb-4">
            <div class="card-header">Data Masyarakat</div>

            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered table-modern datatable w-100">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($masyarakat as $row)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>

                                <td class="text-center">
                                    @if($row->photo)
                                        <img src="{{url('avatar_masyarakat/' . $row->photo)}}" class="avatar-img">
                                    @else
                                        <span class="badge bg-danger">No Img</span>
                                    @endif
                                </td>

                                <td>{{$row->nik}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone_number}}</td>

                                <td title="{{$row->address}}">
                                    {{ \Illuminate\Support\Str::limit($row->address, 25) }}
                                </td>

                                <td class="text-center">
                                    <a href="{{url('admin/masyarakat/edit/' . $row->id)}}" class="btn-action btn-edit">
                                        <i class="bx bx-pencil"></i>
                                    </a>

                                    <button class="btn-action btn-delete btn-delete-action" data-id="{{$row->id}}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header">Data Korban</div>

            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered table-modern w-100">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($korban as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->nik_korban}}</td>
                                <td>{{$item->nama_korban}}</td>
                                <td>{{$item->nomor_korban ?? '-'}}</td>

                                <td title="{{$item->alamat_korban_tinggal}}">
                                    {{ \Illuminate\Support\Str::limit($item->alamat_korban_tinggal, 30) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection


@push('script')
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.datatable').DataTable({
                destroy: true,
                responsive: true,
                autoWidth: false,
                dom: 'rtp',
                pageLength: 10,
                ordering: true,
                info: false
            });

            $('.btn-delete-action').click(function () {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0B3C91',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/admin/masyarakat/delete/" + id;
                    }
                });
            });

        });
    </script>
@endpush