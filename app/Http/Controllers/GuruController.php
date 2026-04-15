<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function dashboard()
    {
        $siswa = Siswa::with('user', 'hasilAnalisis')->get();
        $totalSiswa = $siswa->count();
        $sudahTes = $siswa->filter(function($s) { return $s->hasilAnalisis; })->count();
        $belumTes = $totalSiswa - $sudahTes;
        
        return view('guru.dashboard', compact('siswa', 'totalSiswa', 'sudahTes', 'belumTes'));
    }

    public function kelolaSiswa()
    {
        $siswa = Siswa::with('user', 'hasilAnalisis')->get();
        return view('guru.kelola_siswa', compact('siswa'));
    }

    public function createSiswa(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer'
        ]);

        $user = User::create([
            'username' => $request->nik,
            'nama_lengkap' => $request->nama,
            'password' => Hash::make($request->nik),
            'role' => 'siswa'
        ]);

        Siswa::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'user_id' => $user->id
        ]);

        return redirect()->route('guru.kelola-siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer'
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur
        ]);

        $siswa->user->update(['nama_lengkap' => $request->nama]);

        return redirect()->route('guru.kelola-siswa')->with('success', 'Data siswa berhasil diupdate');
    }

    public function deleteSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete();
        $siswa->delete();
        
        return redirect()->route('guru.kelola-siswa')->with('success', 'Siswa berhasil dihapus');
    }

    public function lihatHasilSiswa($id)
    {
        $siswa = Siswa::with('user', 'hasilAnalisis')->findOrFail($id);
        return view('guru.hasil_siswa', compact('siswa'));
    }
    
    public function laporanSiswa(Request $request)
    {
        $query = Siswa::with('hasilAnalisis');
        
        // Filter berdasarkan kelas
        if ($request->kelas) {
            $query->where('kelas', $request->kelas);
        }
        
        $siswa = $query->get();
        
        $statistik = [
            'cluster1' => HasilAnalisis::where('cluster', 1)->count(),
            'cluster2' => HasilAnalisis::where('cluster', 2)->count(),
            'cluster3' => HasilAnalisis::where('cluster', 3)->count(),
        ];
        
        return view('guru.laporan_siswa', compact('siswa', 'statistik'));
    }
}
