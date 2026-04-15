<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalTes = HasilAnalisis::count();
        
        $statistik = [
            'cluster1' => HasilAnalisis::where('cluster', 1)->count(),
            'cluster2' => HasilAnalisis::where('cluster', 2)->count(),
            'cluster3' => HasilAnalisis::where('cluster', 3)->count(),
        ];
        
        return view('admin.dashboard', compact('totalGuru', 'totalSiswa', 'totalTes', 'statistik'));
    }

    public function kelolaGuru()
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.kelola_guru', compact('guru'));
    }

    public function createGuru(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:users',
            'nama_lengkap' => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'username' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru'
        ]);

        return redirect()->route('admin.kelola-guru')->with('success', 'Guru berhasil ditambahkan');
    }

    public function updateGuru(Request $request, $id)
    {
        $guru = User::findOrFail($id);
        
        $request->validate([
            'nama_lengkap' => 'required',
        ]);

        $guru->update([
            'nama_lengkap' => $request->nama_lengkap
        ]);

        if ($request->password) {
            $guru->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.kelola-guru')->with('success', 'Guru berhasil diupdate');
    }

    public function deleteGuru($id)
    {
        $guru = User::findOrFail($id);
        if ($guru->role == 'guru') {
            $guru->delete();
        }
        return redirect()->route('admin.kelola-guru')->with('success', 'Guru berhasil dihapus');
    }

    public function laporanKeseluruhan()
    {
        $hasil = HasilAnalisis::with('siswa')->get();
        $statistik = [
            'cluster1' => HasilAnalisis::where('cluster', 1)->count(),
            'cluster2' => HasilAnalisis::where('cluster', 2)->count(),
            'cluster3' => HasilAnalisis::where('cluster', 3)->count(),
        ];
        
        $tipeKecerdasan = [
            'linguistik' => HasilAnalisis::where('tipe_kecerdasan_utama', 'linguistik')->count(),
            'logis_matematis' => HasilAnalisis::where('tipe_kecerdasan_utama', 'logis_matematis')->count(),
            'spasial' => HasilAnalisis::where('tipe_kecerdasan_utama', 'spasial')->count(),
            'musikal' => HasilAnalisis::where('tipe_kecerdasan_utama', 'musikal')->count(),
            'kinestetik' => HasilAnalisis::where('tipe_kecerdasan_utama', 'kinestetik')->count(),
            'interpersonal' => HasilAnalisis::where('tipe_kecerdasan_utama', 'interpersonal')->count(),
            'intrapersonal' => HasilAnalisis::where('tipe_kecerdasan_utama', 'intrapersonal')->count(),
            'naturalis' => HasilAnalisis::where('tipe_kecerdasan_utama', 'naturalis')->count(),
        ];
        
        return view('admin.laporan', compact('hasil', 'statistik', 'tipeKecerdasan'));
    }
}
