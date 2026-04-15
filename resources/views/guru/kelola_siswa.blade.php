@extends('layouts.app')

@section('title', 'Kelola Siswa')
@section('header', 'Kelola Data Siswa')

@section('content')
<!-- Full Width Container -->
<div class="w-full">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 shadow-sm p-6 mb-6 border-l-4 border-green-500 -mt-6 -mx-6 rounded-b-xl">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">👨‍🎓 Kelola Data Siswa</h2>
                <p class="text-gray-600 mt-1">Tambah, edit, atau hapus data siswa</p>
            </div>
            <div class="bg-white rounded-full px-4 py-2 shadow-sm">
                <span class="text-sm text-gray-500">Total Siswa: <strong class="text-green-600">{{ $siswa->count() }}</strong></span>
            </div>
        </div>
    </div>

    <!-- Form Tambah Siswa (sama seperti sebelumnya, tidak diubah) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Siswa Baru
            </h3>
            <p class="text-white/80 text-sm mt-1">Password default = NIK siswa</p>
        </div>
        <div class="p-6">
            <form action="{{ route('guru.create-siswa') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @csrf
                <div><label class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label><input type="text" name="nik" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label><input type="text" name="nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label><input type="text" name="kelas" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500" placeholder="Contoh: 7A"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label><select name="jenis_kelamin" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"><option value="">Pilih</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Umur <span class="text-red-500">*</span></label><input type="number" name="umur" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-green-500"></div>
                <div class="flex items-end"><button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2 rounded-lg hover:opacity-90 transition flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>Tambah Siswa</button></div>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Siswa (sama seperti sebelumnya) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg">📋 Daftar Siswa</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">No</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">NIK</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">JK</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Umur</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status Tes</th><th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($siswa as $index => $s)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $index+1 }}</td>
                        <td class="px-6 py-4 text-sm">{{ $s->nik }}</td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $s->nama }}</td>
                        <td class="px-6 py-4 text-sm">{{ $s->kelas }}</td>
                        <td class="px-6 py-4 text-sm">{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $s->umur }}</td>
                        <td class="px-6 py-4">@if($s->hasilAnalisis)<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">✅ Sudah</span>@else<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">⏳ Belum</span>@endif</td>
                        <td class="px-6 py-4">@if($s->hasilAnalisis)<a href="{{ route('guru.hasil-siswa', $s->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">📊 Lihat</a>@endif<button type="button" onclick="showDeleteModal({{ $s->id }}, '{{ $s->nama }}')" class="text-red-600 hover:text-red-800">🗑️ Hapus</button></td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-12 text-center text-gray-500">Belum ada data siswa. Silakan tambah siswa baru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus - Ukuran lebih kecil (max-w-xs) -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-xl shadow-xl max-w-xs w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-4 py-3 rounded-t-xl">
            <h3 class="text-white font-semibold text-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Konfirmasi Hapus
            </h3>
        </div>
        <div class="p-4">
            <p class="text-gray-700 text-sm text-center">Apakah Anda yakin ingin menghapus siswa <strong id="deleteSiswaName"></strong>?</p>
            <p class="text-gray-500 text-xs text-center mt-2">Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeDeleteModal()" class="px-3 py-1.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition text-xs">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-xs">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(id, nama) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');
        const siswaName = document.getElementById('deleteSiswaName');
        deleteForm.action = `/guru/siswa/${id}`;
        siswaName.innerText = nama;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) closeDeleteModal();
    }
</script>
@endsection
