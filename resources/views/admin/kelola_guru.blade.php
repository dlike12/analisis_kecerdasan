@extends('layouts.app')

@section('title', 'Kelola Guru')
@section('header', 'Kelola Data Guru')

@section('content')
<!-- Full Width Container -->
<div class="w-full">
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 shadow-sm p-6 mb-6 border-l-4 border-green-500 -mt-6 -mx-6 rounded-b-xl">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">👨‍🏫 Kelola Data Guru</h2>
                <p class="text-gray-600 mt-1">Tambah, edit, atau hapus data guru</p>
            </div>
            <div class="bg-white rounded-full px-4 py-2 shadow-sm">
                <span class="text-sm text-gray-500">Total Guru: <strong class="text-green-600">{{ $guru->count() }}</strong></span>
            </div>
        </div>
    </div>

    <!-- Form Tambah Guru -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Guru Baru
            </h3>
            <p class="text-white/80 text-sm mt-1">Isi data guru dengan lengkap</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.create-guru') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIP <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">📋</span>
                        <input type="text" name="nip" required 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                               placeholder="Masukkan NIP">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">👤</span>
                        <input type="text" name="nama_lengkap" required 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                               placeholder="Masukkan nama lengkap">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">🔒</span>
                        <input type="password" name="password" required 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                               placeholder="Masukkan password">
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-2 rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Guru
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Guru -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Daftar Guru
            </h3>
            <p class="text-white/80 text-sm mt-1">Semua data guru yang terdaftar</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($guru as $index => $g)
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-mono">{{ $g->nip }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $g->nama_lengkap }}</td>
                        <td class="px-6 py-4">
                            <button onclick="openEditModal({{ $g->id }}, '{{ $g->nama_lengkap }}', '{{ $g->nip }}')" 
                                    class="text-blue-600 hover:text-blue-800 transition-colors mr-3 inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('admin.delete-guru', $g->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus guru {{ $g->nama_lengkap }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p>Belum ada data guru. Silakan tambah guru baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Guru -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 rounded-t-xl">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Data Guru
            </h3>
        </div>
        <form id="editForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="editNama" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                <input type="password" name="password" id="editPassword" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                       placeholder="Kosongkan jika tidak ingin mengubah">
                <p class="text-xs text-gray-500 mt-1">* Kosongkan jika tidak ingin mengubah password</p>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(id, nama, nip) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        form.action = `/admin/guru/${id}`;
        document.getElementById('editNama').value = nama;
        document.getElementById('editPassword').value = '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    
    // Tutup modal saat klik di luar
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeEditModal();
        }
    }
</script>
@endpush
@endsection
