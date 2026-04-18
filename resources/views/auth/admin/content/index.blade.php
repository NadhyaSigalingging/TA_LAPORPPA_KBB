@extends('auth.admin.layouts.main')
@section('title', 'Kontent & Edukasi | Public Complaints')

@section('css')
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

<style>
:root {
    --navy: #0B3C91;
}

h3 {
    color: var(--navy);
    font-weight: 700;
}

.search-box {
    position: relative;
}

.search-box input {
    border-radius: 10px;
    padding-left: 35px;
}

.search-box i {
    position: absolute;
    top: 10px;
    left: 10px;
    color: #999;
}

.card {
    border-radius: 12px;
    transition: 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.btn-navy {
    background: var(--navy);
    color: white;
    border-radius: 8px;
}

.btn-navy:hover {
    background: #082b6b;
}

.btn-action {
    width: 36px;
    height: 36px;
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
</style>
@endsection


@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Informasi dan Edukasi</h3>

        <a href="{{route('auth.admin.content.create')}}" class="btn btn-navy">
            + Tambah
        </a>
    </div>

    {{-- SEARCH + FILTER --}}
    <div class="row mb-3">

        <div class="col-md-4">
            <div class="search-box">
                <i class="bx bx-search"></i>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari judul konten...">
            </div>
        </div>

        <div class="col-md-3">
            <select id="filterType" class="form-select">
                <option value="">Semua Jenis</option>
                <option value="edukasi">Edukasi</option>
                <option value="informasi">Informasi</option>
                <option value="berita">Berita</option>
            </select>
        </div>

    </div>

    {{-- LIST --}}
    @foreach ($contents as $item)
    <div class="card mb-3 p-3 shadow-sm d-flex flex-row align-items-center content-item"
         data-type="{{$item->type}}">

        <img src="{{url('content/'.$item->image)}}" width="80" class="me-3 rounded">

        <div class="flex-grow-1">
            <h5 class="content-title">{{$item->title}}</h5>
            <p class="mb-1">{{ Str::limit($item->description, 100) }}</p>

            <small class="text-muted">
                {{$item->type}} | {{$item->tanggal_upload}}
            </small>
        </div>

        <div class="d-flex gap-2">

            <a href="{{route('auth.admin.content.edit',$item->id)}}" class="btn-action btn-edit">
                ✏️
            </a>

            <button class="btn-action btn-delete btn-delete-action"
                data-url="{{route('auth.admin.content.delete',$item->id)}}">
                🗑️
            </button>

        </div>

    </div>
    @endforeach

</div>
@endsection


@push('script')
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ================= DELETE =================
    document.querySelectorAll('.btn-delete-action').forEach(button => {
        button.addEventListener('click', function () {

            let url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0B3C91',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });

        });
    });

    // ================= SEARCH =================
    let searchInput = document.getElementById('searchInput');
    let filterType = document.getElementById('filterType');

    if (!searchInput) return;

    function filterContent() {

        let keyword = searchInput.value.toLowerCase();
        let type = filterType.value;

        document.querySelectorAll('.content-item').forEach(item => {

            let title = item.querySelector('.content-title').innerText.toLowerCase();
            let itemType = item.getAttribute('data-type');

            let matchTitle = title.includes(keyword);
            let matchType = type === "" || itemType === type;

            item.style.display = (matchTitle && matchType) ? "flex" : "none";

        });
    }

    searchInput.addEventListener('keyup', filterContent);
    filterType.addEventListener('change', filterContent);

});
</script>
@endpush