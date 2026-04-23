@extends('auth.admin.layouts.main')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-700">
            Manajemen Kategori
        </h2>

        <a href="{{ route('admin.category.create') }}"
            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

            <!-- ICON PLUS -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4v16m8-8H4" />
            </svg>

            Tambah Kategori
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm rounded-xl overflow-hidden border">

            <!-- HEADER -->
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Slug</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @forelse($categories as $cat)

                <tr class="hover:bg-gray-50 transition">

                    <td class="p-3 font-medium text-gray-700">
                        {{ $cat->name }}
                    </td>

                    <td class="p-3 text-gray-500">
                        {{ $cat->slug }}
                    </td>

                    <td class="p-3 text-center">

                        <form id="delete-form-{{ $cat->id }}"
                            action="{{ route('admin.category.delete',$cat->id) }}"
                            method="POST">
                            @csrf

                            <button type="button"
                                onclick="confirmDelete({{ $cat->id }})"
                                class="flex items-center gap-1 px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition mx-auto">

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

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-400">
                        Data kategori belum tersedia
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


@push('script')

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus kategori?',
            text: "Data yang dihapus tidak bisa dikembalikan",
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