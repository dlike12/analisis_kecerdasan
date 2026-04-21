<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TesController;

// Halaman login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/kelola-guru', [AdminController::class, 'kelolaGuru'])->name('admin.kelola-guru');
    Route::post('/guru', [AdminController::class, 'createGuru'])->name('admin.create-guru');
    Route::put('/guru/{id}', [AdminController::class, 'updateGuru'])->name('admin.update-guru');
    Route::delete('/guru/{id}', [AdminController::class, 'deleteGuru'])->name('admin.delete-guru');
    Route::get('/laporan', [AdminController::class, 'laporanKeseluruhan'])->name('admin.laporan');
});

// Route Guru
Route::prefix('guru')->middleware('auth')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/kelola-siswa', [GuruController::class, 'kelolaSiswa'])->name('guru.kelola-siswa');
    Route::post('/siswa', [GuruController::class, 'createSiswa'])->name('guru.create-siswa');
    Route::put('/siswa/{id}', [GuruController::class, 'updateSiswa'])->name('guru.update-siswa');
    Route::delete('/siswa/{id}', [GuruController::class, 'deleteSiswa'])->name('guru.delete-siswa');
    Route::get('/hasil-siswa/{id}', [GuruController::class, 'lihatHasilSiswa'])->name('guru.hasil-siswa');
    Route::get('/laporan-siswa', [GuruController::class, 'laporanSiswa'])->name('guru.laporan-siswa');
});

// Route Siswa
Route::prefix('siswa')->middleware('auth')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/tes', [TesController::class, 'index'])->name('siswa.tes');
    Route::post('/tes/submit', [TesController::class, 'submit'])->name('siswa.submit-tes');
    Route::get('/hasil', [TesController::class, 'hasil'])->name('siswa.hasil');
});

// Route Export PDF Massal
Route::middleware('auth')->group(function () {
    Route::get('/export/semua-siswa', [App\Http\Controllers\ExportController::class, 'exportAllSiswa'])->name('export.semua-siswa');
    Route::get('/export/per-kelas', [App\Http\Controllers\ExportController::class, 'exportPerKelas'])->name('export.per-kelas');
});

// Route Export PDF Laporan Lengkap (Guru)
Route::middleware('auth')->group(function () {
    Route::get('/export/laporan-lengkap', [App\Http\Controllers\ExportController::class, 'exportLaporanLengkap'])->name('export.laporan-lengkap');
});

// Route Export PDF Single Siswa (hanya satu route dengan nama export.single)
Route::middleware('auth')->group(function () {
    Route::get('/export-pdf/{id}', [App\Http\Controllers\ExportController::class, 'exportSingle'])->name('export.single');
});

// Redirect /login ke halaman utama
Route::get('/login', function () {
    return redirect('/');
});