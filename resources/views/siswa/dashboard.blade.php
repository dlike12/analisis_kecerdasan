@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('header', 'Dashboard Siswa')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Selamat Datang -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-sm p-6 mb-6 border-l-4 border-green-500">
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

    <!-- Profile Card & Status Card -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil Siswa
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col items-center text-center">
                    <div class="w-28 h-28 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white text-4xl font-bold shadow-lg mb-4">
                        {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">{{ auth()->user()->nama_lengkap }}</h4>
                    <p class="text-gray-500 mt-1">Kelas {{ auth()->user()->siswa->kelas }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 w-full mt-4 pt-4 border-t border-gray-200">
                        <div class="text-center">
                            <p class="text-gray-400 text-xs uppercase">NIK</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->siswa->nik }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-400 text-xs uppercase">Jenis Kelamin</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-400 text-xs uppercase">Umur</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->siswa->umur }} tahun</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-400 text-xs uppercase">Status</p>
                            <p class="font-semibold text-green-600">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Tes Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <h3 class="text-white font-semibold text-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Status Tes Kecerdasan
                </h3>
            </div>
            <div class="p-6">
                @if(isset($hasil) && $hasil)
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-green-600 font-semibold text-lg">Anda sudah mengerjakan tes</p>
                        
                        <div class="grid grid-cols-2 gap-4 mt-6 pt-4 border-t border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-400 text-xs uppercase">Tanggal Tes</p>
                                <p class="font-semibold text-gray-800">{{ date('d F Y', strtotime($hasil->tanggal_tes)) }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-400 text-xs uppercase">Cluster</p>
                                <p class="font-semibold text-gray-800">{{ $hasil->cluster }}</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('siswa.hasil') }}" 
                           class="mt-6 w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Hasil Tes
                        </a>
                    </div>
                @else
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <p class="text-yellow-600 font-semibold text-lg">Anda belum mengerjakan tes</p>
                        <p class="text-gray-500 mt-2">Silakan mulai tes kecerdasan jamak</p>
                        
                        <a href="{{ route('siswa.tes') }}" 
                           class="mt-6 w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Mulai Tes
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Informasi Hasil (hanya jika sudah tes) -->
    @if(isset($hasil) && $hasil)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-white font-semibold text-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Hasil Analisis
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Cluster Card -->
                <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-5 text-center border border-yellow-200 hover:shadow-md transition-all">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-yellow-100 rounded-full mb-3">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800">Cluster {{ $hasil->cluster }}</h4>
                    <p class="text-gray-600 mt-1">
                        @if($hasil->cluster == 1)
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Perlu Pendampingan</span>
                        @elseif($hasil->cluster == 2)
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Berkembang</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Optimal</span>
                        @endif
                    </p>
                </div>

                <!-- Tipe Kecerdasan Utama Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-5 text-center border border-purple-200 hover:shadow-md transition-all">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-purple-100 rounded-full mb-3">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-purple-700">{{ ucfirst(str_replace('_', ' ', $hasil->tipe_kecerdasan_utama)) }}</h4>
                    <p class="text-gray-500 text-sm mt-1">Tipe Kecerdasan Utama</p>
                </div>

                <!-- Tanggal Tes Card -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 text-center border border-blue-200 hover:shadow-md transition-all">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 rounded-full mb-3">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-blue-700">{{ date('d/m/Y', strtotime($hasil->tanggal_tes)) }}</h4>
                    <p class="text-gray-500 text-sm mt-1">Tanggal Tes</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-wrap justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('siswa.hasil') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Lihat Detail Grafik
                </a>
                <a href="{{ route('export.single', $hasil->id) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M4 4h16v16H4z"></path>
                    </svg>
                    Export PDF Laporan
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Tips & Informasi -->
    <div class="mt-6 bg-blue-50 rounded-xl p-5 border border-blue-200">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-blue-800">Informasi Penting</h4>
                <p class="text-sm text-blue-700 mt-1">
                    Tes kecerdasan jamak (Multiple Intelligences) mengukur 8 jenis kecerdasan yang berbeda. 
                    Hasil tes ini dapat membantu Anda memahami gaya belajar yang paling sesuai dengan potensi diri Anda.
                    Setiap siswa hanya diperbolehkan mengerjakan tes satu kali.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
