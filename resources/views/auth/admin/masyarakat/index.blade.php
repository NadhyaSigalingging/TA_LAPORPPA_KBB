@extends('auth.admin.layouts.main')

@section('title', 'Masyarakat | Public Complaints')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 
        text-white p-6 rounded-2xl shadow flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">Masyarakat & Korban</h1>
            <p class="text-blue-100 text-sm">Data pelapor dan korban dalam sistem</p>
        </div>

        <a href="{{route('auth.admin.masyarakat.create')}}"
            class="px-5 py-2 bg-white text-blue-600 font-semibold rounded-xl shadow hover:bg-gray-100">
            + Tambah
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
        {{session('success')}}
    </div>
    @endif

    <!-- ================= CARD MASYARAKAT ================= -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h3 class="font-semibold text-gray-800">Data Masyarakat</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm datatable">

                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                        <th class="p-4 text-center">No</th>
                        <th class="p-4 text-center">Foto</th>
                        <th class="p-4">NIK</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Username</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Telepon</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach ($masyarakat as $row)
                    <tr class="hover:bg-blue-50 transition">

                        <td class="p-4 text-center">{{$loop->iteration}}</td>

                        <!-- FOTO / AVATAR -->
                        <td class="p-4 text-center">
                            @if($row->photo)
                            <img src="{{url('avatar_masyarakat/' . $row->photo)}}"
                                class="w-10 h-10 rounded-full object-cover mx-auto border">
                            @else
                            <div class="w-10 h-10 mx-auto rounded-full bg-blue-100 text-blue-600 
                                flex items-center justify-center font-bold">
                                {{ strtoupper(substr($row->name,0,1)) }}
                            </div>
                            @endif
                        </td>

                        <td class="p-4">{{$row->nik}}</td>

                        <td class="p-4 font-semibold text-gray-800">
                            {{$row->name}}
                        </td>

                        <td class="p-4 text-gray-600">{{$row->username}}</td>

                        <td class="p-4 text-gray-600">{{$row->email}}</td>

                        <td class="p-4 text-gray-600">{{$row->phone_number}}</td>

                        <!-- ALAMAT -->
                        <td class="p-4 max-w-[200px] truncate text-gray-600"
                            title="{{$row->address}}">
                            {{$row->address}}
                        </td>

                        <!-- AKSI -->
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-2">

                                <a href="{{url('admin/masyarakat/edit/' . $row->id)}}"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                    ✏️
                                </a>

                                <button class="btn-delete-action w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition"
                                    data-id="{{$row->id}}">
                                    🗑️
                                </button>

                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <!-- ================= CARD KORBAN ================= -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h3 class="font-semibold text-gray-800">Data Korban</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                        <th class="p-4 text-center">No</th>
                        <th class="p-4">NIK</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Telepon</th>
                        <th class="p-4">Alamat</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach ($korban as $item)
                    <tr class="hover:bg-blue-50 transition">

                        <td class="p-4 text-center">{{$loop->iteration}}</td>
                        <td class="p-4">{{$item->nik_korban}}</td>

                        <td class="p-4 font-semibold text-gray-800">
                            {{$item->nama_korban}}
                        </td>

                        <td class="p-4 text-gray-600">{{$item->nomor_korban ?? '-'}}</td>

                        <td class="p-4 max-w-[220px] truncate text-gray-600"
                            title="{{$item->alamat_korban_tinggal}}">
                            {{$item->alamat_korban_tinggal}}
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection


@push('script')
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

<script>
$(document).ready(function () {

    $('.datatable').DataTable({
        destroy: true,
        responsive: true,
        autoWidth: false,
        dom: 'rtp',
        pageLength: 10,
        ordering: true,
        info: false
    });

    $('.btn-delete-action').click(function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/admin/masyarakat/delete/" + id;
            }
        });
    });

});
</script>
@endpush