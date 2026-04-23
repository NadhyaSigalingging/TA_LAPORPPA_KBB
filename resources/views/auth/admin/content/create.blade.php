@extends('auth.admin.layouts.main')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-3xl">

    <h2 class="text-xl font-bold mb-4">Tambah Konten</h2>

    <form method="POST" action="{{ route('auth.admin.content.store') }}" enctype="multipart/form-data">
        @csrf

        <input name="title" placeholder="Judul"
            class="w-full mb-3 p-2 border rounded">

        <input name="slug" placeholder="Slug (opsional)"
            class="w-full mb-3 p-2 border rounded">

        <select name="category_id" class="w-full mb-3 p-2 border rounded">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <div id="editor" class="bg-white mb-3 h-40"></div>
        <input type="hidden" name="body" id="body">

        <input type="file" name="image" class="mb-3">

        <h3 class="font-bold mt-4">SEO</h3>

        <input name="meta_title" placeholder="Meta Title"
            class="w-full mb-2 p-2 border rounded">

        <textarea name="meta_description"
            placeholder="Meta Description"
            class="w-full mb-3 p-2 border rounded"></textarea>

        <select name="status" class="w-full mb-3 p-2 border rounded">
            <option value="draft">Draft</option>
            <option value="publish">Publish</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

    </form>

</div>

<!-- QUILL -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    document.querySelector("form").onsubmit = function() {
        document.getElementById('body').value = quill.root.innerHTML;
    };
</script>

@endsection