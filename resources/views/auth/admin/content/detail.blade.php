<h1 class="text-2xl font-bold">{{ $post->title }}</h1>

@if($post->image)
<img src="{{ asset('storage/'.$post->image) }}">
@endif

<div class="mt-4">{!! $post->body !!}</div>

<hr class="my-6">

<h3>Komentar</h3>

@foreach($post->comments as $c)
<div class="mb-2">
    <b>{{ $c->name }}</b>
    <p>{{ $c->comment }}</p>
</div>
@endforeach

<form method="POST" action="{{ route('comment.store') }}">
@csrf
<input type="hidden" name="content_id" value="{{ $post->id }}">

<input name="name" placeholder="Nama" class="border p-2 w-full mb-2">
<textarea name="comment" placeholder="Komentar" class="border p-2 w-full mb-2"></textarea>

<button class="bg-blue-500 text-white px-4 py-2">Kirim</button>
</form>