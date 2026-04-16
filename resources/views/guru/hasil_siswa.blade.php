@extends('layouts.app')

@section('title', 'Hasil Analisis Siswa')
@section('header', 'Hasil Analisis Kecerdasan Siswa')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-purple-800">📊 Hasil Tes Kecerdasan Jamak</h2>
        <p class="text-gray-600">{{ $siswa->nama }} - Kelas {{ $siswa->kelas }}</p>
        <p class="text-sm text-gray-500">NIK: {{ $siswa->nik }}</p>
    </div>
    
    @if($siswa->hasilAnalisis)
        @php
            $hasil = $siswa->hasilAnalisis;
            $skorPerKategori = json_decode($hasil->skor_per_kategori, true);
        @endphp
        
        <!-- Spider Chart -->
        <div class="mb-8 bg-white rounded-xl p-6 shadow-lg flex justify-center">
            <div class="relative" style="width: 100%; max-width: 650px; height: auto; margin: 0 auto;">
                <canvas id="spiderChart" style="width: 100% !important; height: auto !important;"></canvas>
            </div>
        </div>
        
        <!-- Tipe Kecerdasan Utama -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">🏆 Tipe Kecerdasan Utama</h3>
            <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-purple-100 rounded-xl p-5 text-center shadow-md">
                <p class="text-3xl font-bold text-purple-800">
                    {{ ucfirst(str_replace('_', ' ', $hasil->tipe_kecerdasan_utama)) }}
                </p>
                <div class="mt-3 inline-block px-4 py-2 rounded-full text-sm font-semibold
                    @if($hasil->cluster == 1) bg-yellow-200 text-yellow-800
                    @elseif($hasil->cluster == 2) bg-blue-200 text-blue-800
                    @else bg-green-200 text-green-800 @endif">
                    Cluster {{ $hasil->cluster }} - 
                    @if($hasil->cluster == 1) Perlu Pendampingan
                    @elseif($hasil->cluster == 2) Berkembang
                    @else Optimal @endif
                </div>
            </div>
        </div>
        
        <!-- Rekomendasi -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">💡 Rekomendasi Aktivitas Belajar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php $rekomendasi = json_decode($hasil->rekomendasi, true); @endphp
                @foreach($rekomendasi as $r)
                <div class="border-l-4 border-purple-500 bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all">
                    <h4 class="font-bold text-purple-700">📌 {{ $r['aktivitas'] }}</h4>
                    <p class="text-gray-600 text-sm mt-1">{{ $r['deskripsi'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Tombol -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('export.single', $hasil->id) }}" 
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition transform hover:scale-105 shadow-md">
                📄 Export PDF
            </a>
            <a href="{{ route('guru.kelola-siswa') }}" 
                class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition shadow-md">
                🔙 Kembali
            </a>
        </div>
    @else
        <div class="text-center py-8">
            <div class="text-yellow-500 text-6xl mb-3">⚠️</div>
            <p class="text-red-600 font-semibold">Siswa belum mengerjakan tes.</p>
            <a href="{{ route('guru.kelola-siswa') }}" class="inline-block mt-4 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                🔙 Kembali ke Daftar Siswa
            </a>
        </div>
    @endif
</div>

@if(isset($siswa->hasilAnalisis))
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const skor = @json(array_values($skorPerKategori));
    
    // Label baru sesuai permintaan
    const labels = [
        'Linguistik',
        'Logis-Matematis',
        'Visual-Spasial',
        'Kinestetik-Tubuh',
        'Musikal',
        'Interpersonal',
        'Intrapersonal',
        'Naturalis'
    ];
    
    const pointColors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8', '#F7DC6F'];
    
    const ctx = document.getElementById('spiderChart').getContext('2d');
    
    const canvas = document.getElementById('spiderChart');
    const container = canvas.parentElement;
    const size = Math.min(container.clientWidth, 550);
    canvas.width = size;
    canvas.height = size;
    canvas.style.width = size + 'px';
    canvas.style.height = size + 'px';
    
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor Kecerdasan',
                data: skor,
                backgroundColor: 'rgba(128, 90, 213, 0.2)',
                borderColor: 'rgba(128, 90, 213, 1)',
                borderWidth: 2,
                pointBackgroundColor: pointColors,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 10, family: 'Poppins', weight: 'bold' },
                        usePointStyle: true,
                        boxWidth: 10,
                        generateLabels: function(chart) {
                            const data = chart.data;
                            return data.labels.map((label, i) => ({
                                text: label,
                                fillStyle: pointColors[i % pointColors.length],
                                strokeStyle: pointColors[i % pointColors.length],
                                lineWidth: 2,
                                hidden: false,
                                index: i,
                                pointStyle: 'circle'
                            }));
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    callbacks: {
                        label: function(context) {
                            return `Skor: ${context.raw} / 100`;
                        }
                    }
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20,
                        backdropColor: 'transparent',
                        font: { size: 9, weight: 'bold' }
                    },
                    grid: { color: '#e0e0e0', circular: true },
                    angleLines: { color: '#cccccc' },
                    pointLabels: {
                        font: { size: 9, family: 'Poppins', weight: 'bold' },
                        color: '#2d3748'
                    }
                }
            },
            layout: {
                padding: { top: 20, bottom: 20, left: 20, right: 20 }
            }
        }
    });
});

window.addEventListener('resize', function() {
    const canvas = document.getElementById('spiderChart');
    const container = canvas.parentElement;
    const size = Math.min(container.clientWidth, 550);
    if (canvas) {
        canvas.width = size;
        canvas.height = size;
        canvas.style.width = size + 'px';
        canvas.style.height = size + 'px';
    }
});
</script>
@endpush
@endif
@endsection
