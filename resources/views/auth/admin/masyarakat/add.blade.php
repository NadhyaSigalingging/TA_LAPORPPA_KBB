@extends('auth.admin.layouts.main')
@section('title', 'Masyarakat | Public Complaints')

@section('css')
    <style>
        :root {
            --navy: #0B3C91;
            --navy-soft: #1E5ED7;
            --bg-soft: #F4F7FB;
        }

        h4 {
            color: var(--navy);
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .form-control {
            border-radius: 10px;
            font-size: 13px;
            padding: 10px;
        }

        label {
            font-weight: 600;
            font-size: 13px;
            color: #2c3e50;
        }
        .alert {
            border-radius: 10px;
            font-size: 13px;
        }

        .info-box {
            background: var(--bg-soft);
            border: 1px solid #e3eaf5;
            border-radius: 10px;
            padding: 14px;
            font-size: 13px;
        }

        .action-btns {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-pro {
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-save {
            background: #198754;
            color: white;
        }

        .btn-save:hover {
            background: #157347;
            transform: translateY(-2px);
        }

        .btn-save-more {
            background: var(--navy);
            color: white;
        }

        .btn-save-more:hover {
            background: #082b6b;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #f1f3f5;
            color: #495057;
        }

        .btn-cancel:hover {
            background: #e2e6ea;
            transform: translateY(-2px);
        }

        .btn-back {
            background: var(--navy);
            color: white;
            border-radius: 10px;
            padding: 8px 14px;
        }

        .btn-back:hover {
            background: #082b6b;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4>Tambah Masyarakat</h4>
                    <small class="text-muted">Input data pelapor baru ke dalam sistem</small>
                </div>

                <a href="{{route('auth.admin.masyarakat.index')}}" class="btn-back">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif

        <form action="{{route('auth.admin.masyarakat.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>NIK</label>
                                    <input class="form-control" type="number" name="nik" value="{{old('nik')}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="username" value="{{old('username')}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value="{{old('email')}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Telepon</label>
                                    <input class="form-control" type="number" name="phone_number">
                                </div>

                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Upload Foto</label>
                                <input class="form-control" type="file" name="photo">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="info-box mb-3">
                                <strong>Informasi:</strong><br>
                                Pastikan semua data yang diinput sudah benar sebelum disimpan.
                            </div>

                            <div class="action-btns">

                                <button type="submit" name="submit" value="save" class="btn-pro btn-save">
                                    <i class="bx bx-save"></i>
                                    Simpan Data
                                </button>

                                <button type="submit" name="submit" value="more" class="btn-pro btn-save-more">
                                    <i class="bx bx-plus-circle"></i>
                                    Simpan & Tambah Lagi
                                </button>

                                <a href="{{route('auth.admin.masyarakat.index')}}" class="btn-pro btn-cancel">
                                    <i class="bx bx-x-circle"></i>
                                    Batal
                                </a>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>
@endsection