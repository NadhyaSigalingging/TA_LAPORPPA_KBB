@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
    <br>
    Kode laporan: <strong>{{ session('kode') }}</strong>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
    <i class="fas fa-exclamation-circle"></i>
    {{ session('error') }}
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    <div class="d-flex align-items-start gap-2">
        <i class="fas fa-exclamation-circle mt-1"></i>
        <div>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach($errors->all() as $error)
                    <li style="font-size:13.5px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif