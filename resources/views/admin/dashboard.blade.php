@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Administrator')

@section('content')
<!-- Full Width Container -->
<div class="w-full">
    <!-- Header Selamat Datang -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 shadow-sm p-6 mb-6 border-l-4 border-green-500 -mt-6 -mx-6 rounded-b-xl">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->nama_lengkap }}! 👋</h2>
                <p class="text-gray-600 mt-1">Sistem Analisis Kecerdasan Jamak - Multiple Intelligences</p>
            </div>
            <div class="bg-white rounded-full px-4 py-2 shadow-sm">
                <span class="text-sm text-gray-500">📅 {{ date('l, d F Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Guru Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Total Guru
                </h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-5xl font-bold text-blue-600">{{ $totalGuru ?? 0 }}</p>
                <p class="text-gray-500 mt-2">Guru Terdaftar</p>
            </div>
        </div>

        <!-- Total Siswa Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Total Siswa
                </h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-5xl font-bold text-green-600">{{ $totalSiswa ?? 0 }}</p>
                <p class="text-gray-500 mt-2">Siswa Terdaftar</p>
            </div>
        </div>

        <!-- Total Tes Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Total Tes
                </h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-5xl font-bold text-purple-600">{{ $totalTes ?? 0 }}</p>
                <p class="text-gray-500 mt-2">Siswa Telah Tes</p>
            </div>
        </div>
    </div>

    <!-- Informasi Sistem -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Sistem
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Status Sistem</p>
                            <p class="text-sm text-green-600">● Aktif & Berjalan Normal</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Versi Aplikasi</p>
                            <p class="text-sm text-gray-600">v1.0.0 - K-Means Clustering</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Aksi -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Menu Aksi
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Tombol Kelola Guru -->
                <a href="{{ route('admin.kelola-guru') }}" 
                   class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5 rounded-xl text-center hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md group">
                    <div class="flex items-center justify-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <div>
                            <p class="font-bold text-lg">👨‍🏫 Kelola Data Guru</p>
                            <p class="text-sm text-blue-100">Tambah, edit, atau hapus data guru</p>
                        </div>
                    </div>
                </a>
                
                <!-- Tombol Lihat Laporan -->
                <a href="{{ route('admin.laporan') }}" 
                   class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-5 rounded-xl text-center hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md group">
                    <div class="flex items-center justify-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <p class="font-bold text-lg">📄 Lihat Laporan</p>
                            <p class="text-sm text-purple-100">Lihat laporan hasil tes siswa</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Tambahan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Distribusi Cluster
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Cluster 1 (Perlu Pendampingan)</span>
                            <span class="text-sm font-bold text-yellow-600">{{ $statistik['cluster1'] ?? 0 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $totalTes > 0 ? (($statistik['cluster1'] ?? 0) / $totalTes * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Cluster 2 (Berkembang)</span>
                            <span class="text-sm font-bold text-blue-600">{{ $statistik['cluster2'] ?? 0 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $totalTes > 0 ? (($statistik['cluster2'] ?? 0) / $totalTes * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Cluster 3 (Optimal)</span>
                            <span class="text-sm font-bold text-green-600">{{ $statistik['cluster3'] ?? 0 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $totalTes > 0 ? (($statistik['cluster3'] ?? 0) / $totalTes * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Ringkasan Cepat
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Total Guru Aktif</span>
                        <span class="font-bold text-gray-800">{{ $totalGuru ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Total Siswa Aktif</span>
                        <span class="font-bold text-gray-800">{{ $totalSiswa ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Siswa Sudah Tes</span>
                        <span class="font-bold text-green-600">{{ $totalTes ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Siswa Belum Tes</span>
                        <span class="font-bold text-red-600">{{ ($totalSiswa ?? 0) - ($totalTes ?? 0) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
