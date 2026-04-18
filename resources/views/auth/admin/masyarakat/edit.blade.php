@extends('auth.admin.layouts.main')
@section('title', 'Edit Masyarakat')

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

        .preview-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
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

        .btn-update {
            background: #0B3C91;
            color: white;
        }

        .btn-update:hover {
            background: #082b6b;
            transform: translateY(-2px);
        }

        .btn-reset {
            background: #b9362f;
            color: black;
        }

        .btn-reset:hover {
            background: #e0a800;
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
                    <h4>Edit Masyarakat</h4>
                    <small class="text-muted">Perbarui data pelapor dalam sistem</small>
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

        <form action="{{url('admin/masyarakat/update/' . $masyarakat->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>NIK</label>
                                    <input class="form-control" type="number" name="nik" value="{{$masyarakat->nik}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="username"
                                        value="{{$masyarakat->username}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value="{{$masyarakat->email}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="name" value="{{$masyarakat->name}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Telepon</label>
                                    <input class="form-control" type="number" name="phone_number"
                                        value="{{$masyarakat->phone_number}}">
                                </div>

                                <div class="col-md-6">
                                    <label>Password (Opsional)</label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" rows="3">{{$masyarakat->address}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Upload Foto</label>
                                <input class="form-control" type="file" name="photo">

                                @if($masyarakat->photo)
                                    <img src="{{url('avatar_masyarakat/' . $masyarakat->photo)}}" class="preview-img">
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="info-box mb-3">
                                <strong>Informasi:</strong><br>
                                Perubahan data akan langsung disimpan ke sistem.
                            </div>

                            <div class="action-btns">

                                <button type="submit" class="btn-pro btn-update">
                                    <i class="bx bx-save"></i>
                                    Update Data
                                </button>

                                <button type="reset" class="btn-pro btn-reset">
                                    <i class="bx bx-refresh"></i>
                                    Reset
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