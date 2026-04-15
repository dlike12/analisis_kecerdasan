@extends('layouts.app')

@section('title', 'Laporan Hasil Analisis')
@section('header', 'Laporan Hasil Analisis Kecerdasan')

@section('content')
<!-- Tombol Export -->
<div class="flex justify-end space-x-3 mb-6">
    <a href="{{ route('export.semua-siswa') }}" 
       class="bg-gradient-to-r from-green-600 to-green-800 text-white px-4 py-2 rounded-lg hover:opacity-90 transition shadow-md flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m-6 4H5a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
        <span>📄 Export PDF Semua Siswa</span>
    </a>
    
    <form action="{{ route('export.per-kelas') }}" method="GET" class="inline-flex space-x-2">
        <select name="kelas" required class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
            <option value="">Pilih Kelas</option>
            @php
                $kelasList = App\Models\Siswa::select('kelas')->distinct()->pluck('kelas');
            @endphp
            @foreach($kelasList as $k)
                <option value="{{ $k }}">Kelas {{ $k }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-4 py-2 rounded-lg hover:opacity-90 transition shadow-md flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m-6 4H5a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>📄 Export PDF Per Kelas</span>
        </button>
    </form>
</div>

<!-- Statistik Card -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow p-4 text-white">
        <div class="text-2xl font-bold">{{ $hasil->count() }}</div>
        <div class="text-sm">Total Siswa Tes</div>
    </div>
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 rounded-lg shadow p-4 text-white">
        <div class="text-2xl font-bold">{{ $statistik['cluster1'] }}</div>
        <div class="text-sm">Cluster 1 (Perlu Pendampingan)</div>
    </div>
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow p-4 text-white">
        <div class="text-2xl font-bold">{{ $statistik['cluster2'] }}</div>
        <div class="text-sm">Cluster 2 (Berkembang)</div>
    </div>
    <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow p-4 text-white">
        <div class="text-2xl font-bold">{{ $statistik['cluster3'] }}</div>
        <div class="text-sm">Cluster 3 (Optimal)</div>
    </div>
</div>

<!-- Tabel Hasil -->
<div class="bg-white rounded-lg shadow-lg">
    <div class="p-6 border-b bg-gradient-to-r from-blue-50 to-cyan-50">
        <h3 class="text-lg font-semibold text-gray-800">📋 Detail Hasil Tes Siswa</h3>
    </div>
    <div class="overflow-x-auto p-6">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe Kecerdasan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cluster</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($hasil as $index => $h)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm">{{ $h->siswa->nik }}</td>
                    <td class="px-6 py-4 text-sm">{{ $h->siswa->nama }}</td>
                    <td class="px-6 py-4 text-sm">{{ $h->siswa->kelas }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                            {{ ucfirst(str_replace('_', ' ', $h->tipe_kecerdasan_utama)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($h->cluster == 1)
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Cluster 1</span>
                        @elseif($h->cluster == 2)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Cluster 2</span>
                        @else
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Cluster 3</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data hasil tes.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
