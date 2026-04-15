@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('header', 'Dashboard Guru')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Total Siswa</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalSiswa ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Sudah Tes</p>
                <p class="text-2xl font-bold text-gray-800">{{ $sudahTes ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Belum Tes</p>
                <p class="text-2xl font-bold text-gray-800">{{ $belumTes ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Selamat Datang, {{ auth()->user()->nama_lengkap }}</h3>
    <p class="text-gray-600">Anda login sebagai <span class="font-semibold text-purple-600">Guru</span>.</p>
    <p class="text-gray-600 mt-2">Silakan kelola data siswa melalui menu di bawah ini:</p>
    
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Tombol Kelola Siswa - Gradasi Biru -->
        <a href="{{ route('guru.kelola-siswa') }}" 
           class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white p-4 rounded-lg text-center hover:opacity-90 transition transform hover:scale-105 shadow-lg">
            <div class="flex items-center justify-center space-x-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="font-semibold">👨‍🎓 Kelola Data Siswa</span>
            </div>
        </a>
        
        <!-- Tombol Laporan Siswa - Gradasi Biru Muda -->
        <a href="{{ route('guru.laporan-siswa') }}" 
           class="bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600 text-white p-4 rounded-lg text-center hover:opacity-90 transition transform hover:scale-105 shadow-lg">
            <div class="flex items-center justify-center space-x-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-semibold">📊 Laporan Siswa</span>
            </div>
        </a>
    </div>
</div>
@endsection
