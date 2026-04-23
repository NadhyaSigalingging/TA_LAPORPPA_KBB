@extends('auth.admin.layouts.main')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow">

    <!-- HEADER -->
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-semibold text-gray-700">
            Manajemen Konten
        </h2>

        <div class="flex gap-2">

            <!-- TAMBAH KATEGORI -->
            <a href="{{ route('admin.category.index') }}"
                class="flex items-center gap-2 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">

                <!-- ICON CATEGORY -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7l6-4 6 4 6-4v14l-6 4-6-4-6 4V7z" />
                </svg>

                Kelola Kategori
            </a>

            <!-- TAMBAH KONTEN -->
            <a href="{{ route('auth.admin.content.create') }}"
                class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

                <!-- ICON PLUS -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4" />
                </svg>

                Tambah Konten
            </a>

        </div>

    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm border rounded-xl overflow-hidden">

            <!-- HEADER -->
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @forelse($contents as $item)

                <tr class="hover:bg-gray-50 transition">

                    <!-- JUDUL -->
                    <td class="p-3 font-medium text-gray-700">
                        {{ $item->title }}
                    </td>

                    <!-- KATEGORI -->
                    <td class="p-3 text-gray-500">
                        {{ $item->category->name ?? '-' }}
                    </td>

                    <!-- STATUS -->
                    <td class="p-3">
                        @if($item->status == 'publish')
                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">

                            <!-- ICON CHECK -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>

                            Publish
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">

                            <!-- ICON DRAFT -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="2"
                                    d="M12 8v4l3 3" />
                            </svg>

                            Draft
                        </span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="p-3 text-center">

                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('auth.admin.content.edit', $item->id) }}"
                                class="flex items-center gap-1 px-3 py-1 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">

                                <!-- ICON EDIT -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5h2M12 7v10m-7-3l9-9 3 3-9 9H5v-3z" />
                                </svg>

                                Edit
                            </a>

                            <!-- DELETE -->
                            <form id="delete-form-{{ $item->id }}"
                                action="{{ route('auth.admin.content.delete', $item->id) }}"
                                method="POST">
                                @csrf

                                <button type="button"
                                    onclick="confirmDelete({{ $item->id }})"
                                    class="flex items-center gap-1 px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">

                                    <!-- ICON DELETE -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 7h12M9 7v10m6-10v10M5 7l1-2h12l1 2M4 7h16" />
                                    </svg>

                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-400">
                        Belum ada konten yang dibuat
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


@push('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus konten?',
            text: "Data tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endpush