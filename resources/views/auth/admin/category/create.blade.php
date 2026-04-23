@extends('auth.admin.layouts.main')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-md">

<h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>

<form method="POST" action="{{ route('admin.category.store') }}">
@csrf

<input name="name"
    placeholder="Nama kategori"
    class="w-full p-2 border rounded mb-3">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>

</div>

@endsection