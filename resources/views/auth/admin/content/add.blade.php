@extends('auth.admin.layouts.main')
@section('title', 'Kontent & Edukasi | Public Complaints')

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
        }

        .form-control,
        .form-select {
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
        }

        .preview-img {
            width: 120px;
            border-radius: 10px;
            display: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            background: var(--bg-soft);
            border: 1px solid #e3eaf5;
            border-radius: 10px;
            padding: 14px;
            font-size: 13px;
        }

        .btn-pro {
            border-radius: 10px;
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: 0.2s;
        }

        .btn-save {
            background: #198754;
            color: white;
        }

        .btn-save:hover {
            background: #157347;
        }

        .btn-back {
            background: #f1f3f5;
            color: #495057;
        }

        .btn-back:hover {
            background: #e2e6ea;
        }

        .btn-navy {
            background: var(--navy);
            color: white;
            border-radius: 10px;
        }

        .btn-navy:hover {
            background: #082b6b;
        }

        .action-area {
            display: flex;
            gap: 10px;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4>Tambah Konten Edukasi</h4>
                <small class="text-muted">Tambahkan informasi atau edukasi untuk masyarakat</small>
            </div>

            <a href="{{route('auth.admin.content.index')}}" class="btn btn-navy">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('auth.admin.content.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label>Judul Konten</label>
                                <input type="text" name="title" class="form-control" placeholder="Masukkan judul..."
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Jenis Konten</label>
                                <select name="type" class="form-select" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="edukasi">Edukasi</option>
                                    <option value="informasi">Informasi</option>
                                    <option value="berita">Berita</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Upload Gambar</label>
                                <input type="file" name="image" class="form-control" id="imageInput">
                            </div>

                            <img id="preview" class="preview-img">

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="info-box mb-3">
                                <strong>Informasi:</strong><br>
                                Pastikan konten yang diinput jelas, singkat, dan bermanfaat bagi masyarakat.
                            </div>

                            <div class="action-area">

                                <button type="submit" class="btn-pro btn-save w-100" id="btnSubmit">
                                    <i class="bx bx-save"></i>
                                    Simpan
                                </button>

                                <a href="{{route('auth.admin.content.index')}}" class="btn-pro btn-back w-100">
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


@push('script')
    <script>
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('btnSubmit').disabled = true;
        });

        document.getElementById('imageInput').addEventListener('change', function (e) {
            let reader = new FileReader();
            reader.onload = function () {
                let preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endpush