@extends('auth.admin.layouts.main')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Manajemen Admin</h2>
    </div>

    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Username</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($users as $index => $user)

                <tr class="hover:bg-gray-50 transition">

                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3 font-medium">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->username }}</td>
                    <td class="p-3">{{ $user->email }}</td>

                    <!-- STATUS -->
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                            Pending
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td class="p-3 text-center">
                        <div class="flex justify-center gap-2">

                            <!-- APPROVE -->
                            <button onclick="openModal('approve', {{ $user->id }})"
                                class="flex items-center gap-1 px-3 py-1.5 bg-green-500 text-white text-xs rounded-lg hover:bg-green-600 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                Approve
                            </button>

                            <!-- REJECT -->
                            <button onclick="openModal('reject', {{ $user->id }})"
                                class="flex items-center gap-1 px-3 py-1.5 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>

                                Reject
                            </button>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">
                        Tidak ada admin yang perlu di-approve
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

<!-- ================= MODAL ================= -->
<div id="modalConfirm" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl p-6 w-full max-w-sm shadow-lg">

        <h3 id="modalTitle" class="text-lg font-semibold text-gray-700 mb-2"></h3>

        <p id="modalText" class="text-sm text-gray-500 mb-5"></p>

        <form id="modalForm" method="POST">
            @csrf

            <div class="flex justify-end gap-2">

                <button type="button" onclick="closeModal()"
                    class="px-3 py-1.5 text-sm bg-gray-200 rounded-lg hover:bg-gray-300">
                    Batal
                </button>

                <button type="submit" id="confirmBtn"
                    class="px-3 py-1.5 text-sm text-white rounded-lg">
                    Ya, Lanjutkan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('script')
<script>
    function openModal(type, id) {

        const modal = document.getElementById('modalConfirm');
        const title = document.getElementById('modalTitle');
        const text = document.getElementById('modalText');
        const form = document.getElementById('modalForm');
        const btn = document.getElementById('confirmBtn');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (type === 'approve') {
            title.innerText = "Konfirmasi Persetujuan";
            text.innerText = "Apakah Anda yakin ingin menyetujui admin ini?";
            form.action = `/admin/approve/${id}`;
            btn.className = "px-3 py-1.5 text-sm bg-green-500 hover:bg-green-600 text-white rounded-lg";
        } else {
            title.innerText = "Konfirmasi Penolakan";
            text.innerText = "Apakah Anda yakin ingin menolak admin ini?";
            form.action = `/admin/reject/${id}`;
            btn.className = "px-3 py-1.5 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg";
        }
    }

    function closeModal() {
        document.getElementById('modalConfirm').classList.add('hidden');
    }
</script>
@endpush