@extends('layouts.app')

@section('title', 'Hasil Analisis Kecerdasan')
@section('header', 'Hasil Analisis Kecerdasan Jamak')

@section('content')
<div class="w-full max-w-7xl mx-auto px-6"> <!-- Tambah margin horizontal -->
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-sm p-8 mb-8 border-l-4 border-green-500">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">📊 Hasil Tes Kecerdasan Jamak</h2>
                <p class="text-gray-600 text-base mt-2">{{ auth()->user()->siswa->nama }} - Kelas {{ auth()->user()->siswa->kelas }}</p>
            </div>
            <div class="bg-white rounded-full px-5 py-2 shadow-sm">
                <span class="text-base text-gray-500">📅 {{ date('d F Y', strtotime($hasil->tanggal_tes)) }}</span>
            </div>
        </div>
    </div>

    <!-- Spider Chart - diperkecil -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-5">
            <h3 class="text-white font-semibold text-xl flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Grafik Kecerdasan Jaring (Spider Chart)
            </h3>
        </div>
        <div class="p-8 flex justify-center">
            <div class="relative w-full max-w-lg"> <!-- Batasi lebar maksimal grafik -->
                <canvas id="spiderChart" class="w-full h-auto"></canvas>
            </div>
        </div>
    </div>

    <!-- 3 Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 text-center border border-purple-200 hover:shadow-lg transition-all">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h4 class="text-2xl font-bold text-purple-700">{{ ucfirst(str_replace('_', ' ', $hasil->tipe_kecerdasan_utama)) }}</h4>
            <p class="text-gray-500 text-sm mt-2">Tipe Kecerdasan Utama</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-6 text-center border border-yellow-200 hover:shadow-lg transition-all">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h4 class="text-2xl font-bold text-gray-800">Cluster {{ $hasil->cluster }}</h4>
            <p class="text-gray-500 text-sm mt-2">
                @if($hasil->cluster == 1)
                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Perlu Pendampingan</span>
                @elseif($hasil->cluster == 2)
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Berkembang</span>
                @else
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Optimal</span>
                @endif
            </p>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 text-center border border-blue-200 hover:shadow-lg transition-all">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-2xl font-bold text-blue-700">{{ date('d/m/Y', strtotime($hasil->tanggal_tes)) }}</h4>
            <p class="text-gray-500 text-sm mt-2">Tanggal Tes</p>
        </div>
    </div>

    <!-- Tabel Skor Per Kategori (font lebih besar) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-5">
            <h3 class="text-white font-semibold text-xl flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Skor Per Kategori Kecerdasan
            </h3>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($skorPerKategori as $kategori => $skor)
                <div class="bg-gray-50 rounded-lg p-5 hover:shadow-md transition-all">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold text-gray-700 text-base">{{ ucfirst(str_replace('_', ' ', $kategori)) }}</span>
                        <span class="text-xl font-bold text-green-600">{{ $skor }} / 100</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-3 rounded-full transition-all duration-500" style="width: {{ $skor }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Rekomendasi Aktivitas Belajar (font lebih besar) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-5">
            <h3 class="text-white font-semibold text-xl flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                Rekomendasi Aktivitas Belajar
            </h3>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($rekomendasi as $index => $r)
                <div class="border-l-4 border-green-500 bg-gradient-to-r from-green-50 to-white rounded-lg p-5 hover:shadow-md transition-all">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-green-600 font-bold text-lg">{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-700 text-lg">{{ $r['aktivitas'] }}</h4>
                            <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $r['deskripsi'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex flex-wrap justify-center gap-5 pb-4">
        <a href="{{ route('export.pdf', $hasil->id) }}" 
           class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:opacity-90 transition duration-300 transform hover:scale-105 shadow-md font-semibold text-base">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4z"></path>
            </svg>
            📄 Export PDF Laporan
        </a>
        <a href="{{ route('siswa.dashboard') }}" 
           class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:opacity-90 transition duration-300 transform hover:scale-105 shadow-md font-semibold text-base">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            🔙 Kembali ke Dashboard
        </a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const skor = @json(array_values($skorPerKategori));
    const labels = ['Linguistik', 'Logis-Matematis', 'Visual-Spasial', 'Kinestetik', 'Musikal', 'Interpersonal', 'Intrapersonal', 'Naturalis'];
    const pointColors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8', '#F7DC6F'];
    
    const ctx = document.getElementById('spiderChart').getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor Kecerdasan',
                data: skor,
                backgroundColor: 'rgba(46, 204, 113, 0.2)',
                borderColor: '#2ecc71',
                borderWidth: 2,
                pointBackgroundColor: pointColors,
                pointBorderColor: '#ffffff',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { stepSize: 20, backdropColor: 'transparent', font: { size: 11 } }
                }
            },
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 12 } } }
            }
        }
    });
});
</script>
@endpush
@endsection
