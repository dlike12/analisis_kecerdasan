<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy('nomor_urut')->get();
        $siswa = Auth::user()->siswa;
        $sudahMengerjakan = HasilAnalisis::where('siswa_id', $siswa->id)->exists();
        
        if ($sudahMengerjakan) {
            return redirect()->route('siswa.hasil');
        }
        
        return view('siswa.tes', compact('pertanyaan'));
    }

    public function submit(Request $request)
    {
        $jawaban = $request->input('jawaban');
        
        if (!$jawaban || count($jawaban) != 64) {
            return back()->with('error', 'Harap jawab semua pertanyaan (64 soal)');
        }
        
        $siswa = Auth::user()->siswa;
        
        foreach ($jawaban as $pertanyaanId => $skor) {
            Jawaban::create([
                'siswa_id' => $siswa->id,
                'pertanyaan_id' => $pertanyaanId,
                'skor' => $skor
            ]);
        }
        
        $this->prosesKMeans($siswa->id);
        
        return redirect()->route('siswa.hasil')->with('success', 'Tes berhasil diselesaikan!');
    }
    
    private function prosesKMeans($siswaId)
    {
        $kategoriSkor = [
            'linguistik' => 0, 'logis_matematis' => 0, 'spasial' => 0,
            'musikal' => 0, 'kinestetik' => 0, 'interpersonal' => 0,
            'intrapersonal' => 0, 'naturalis' => 0
        ];
        
        $kategoriCount = [
            'linguistik' => 0, 'logis_matematis' => 0, 'spasial' => 0,
            'musikal' => 0, 'kinestetik' => 0, 'interpersonal' => 0,
            'intrapersonal' => 0, 'naturalis' => 0
        ];
        
        $jawaban = Jawaban::where('siswa_id', $siswaId)->with('pertanyaan')->get();
        
        foreach ($jawaban as $jwb) {
            $kategori = $jwb->pertanyaan->kategori;
            $kategoriSkor[$kategori] += $jwb->skor;
            $kategoriCount[$kategori]++;
        }
        
        foreach ($kategoriSkor as $key => $total) {
            if ($kategoriCount[$key] > 0) {
                $kategoriSkor[$key] = round(($total / $kategoriCount[$key]) * 20, 2);
            }
        }
        
        $values = array_values($kategoriSkor);
        $avgScore = array_sum($values) / count($values);
        
        if ($avgScore < 40) {
            $cluster = 1;
        } elseif ($avgScore < 70) {
            $cluster = 2;
        } else {
            $cluster = 3;
        }
        
        $tipeUtama = array_keys($kategoriSkor, max($kategoriSkor))[0];
        $rekomendasi = $this->getRekomendasi($tipeUtama);
        
        HasilAnalisis::create([
            'siswa_id' => $siswaId,
            'skor_per_kategori' => json_encode($kategoriSkor),
            'cluster' => $cluster,
            'tipe_kecerdasan_utama' => $tipeUtama,
            'rekomendasi' => json_encode($rekomendasi),
            'tanggal_tes' => now()
        ]);
    }
    
    private function getRekomendasi($tipe)
    {
        $rekomendasi = [
            'linguistik' => [
                ['aktivitas' => 'Membaca Buku Cerita', 'deskripsi' => 'Baca buku 30 menit setiap hari'],
                ['aktivitas' => 'Menulis Jurnal', 'deskripsi' => 'Tulis pengalaman dalam jurnal harian'],
                ['aktivitas' => 'Diskusi', 'deskripsi' => 'Ikut diskusi kelompok']
            ],
            'logis_matematis' => [
                ['aktivitas' => 'Puzzle', 'deskripsi' => 'Selesaikan puzzle atau teka-teki'],
                ['aktivitas' => 'Eksperimen', 'deskripsi' => 'Lakukan eksperimen sains'],
                ['aktivitas' => 'Catur', 'deskripsi' => 'Main catur atau permainan strategi']
            ],
            'spasial' => [
                ['aktivitas' => 'Menggambar', 'deskripsi' => 'Gambar pemandangan 3D'],
                ['aktivitas' => 'Membaca Peta', 'deskripsi' => 'Latihan membaca peta'],
                ['aktivitas' => 'Fotografi', 'deskripsi' => 'Ambil foto dengan komposisi']
            ],
            'musikal' => [
                ['aktivitas' => 'Belajar Alat Musik', 'deskripsi' => 'Pelajari alat musik dasar'],
                ['aktivitas' => 'Menyanyi', 'deskripsi' => 'Ikut paduan suara'],
                ['aktivitas' => 'Menciptakan Lagu', 'deskripsi' => 'Buat lagu sederhana']
            ],
            'kinestetik' => [
                ['aktivitas' => 'Olahraga', 'deskripsi' => 'Ikut kegiatan olahraga'],
                ['aktivitas' => 'Tari', 'deskripsi' => 'Belajar tarian'],
                ['aktivitas' => 'Kerajinan Tangan', 'deskripsi' => 'Buat kerajinan']
            ],
            'interpersonal' => [
                ['aktivitas' => 'Kerja Kelompok', 'deskripsi' => 'Ikut proyek kelompok'],
                ['aktivitas' => 'Organisasi', 'deskripsi' => 'Gabung organisasi'],
                ['aktivitas' => 'Menjadi Mentor', 'deskripsi' => 'Bantu teman']
            ],
            'intrapersonal' => [
                ['aktivitas' => 'Meditasi', 'deskripsi' => 'Luangkan waktu merenung'],
                ['aktivitas' => 'Menetapkan Target', 'deskripsi' => 'Buat target belajar'],
                ['aktivitas' => 'Refleksi Diri', 'deskripsi' => 'Evaluasi diri']
            ],
            'naturalis' => [
                ['aktivitas' => 'Berkebun', 'deskripsi' => 'Tanam dan rawat tanaman'],
                ['aktivitas' => 'Observasi Alam', 'deskripsi' => 'Amati burung'],
                ['aktivitas' => 'Recycling', 'deskripsi' => 'Buat kerajinan daur ulang']
            ]
        ];
        
        return $rekomendasi[$tipe] ?? $rekomendasi['linguistik'];
    }
    
    public function hasil()
    {
        $siswa = Auth::user()->siswa;
        $hasil = HasilAnalisis::where('siswa_id', $siswa->id)->first();
        
        if (!$hasil) {
            return redirect()->route('siswa.tes');
        }
        
        $skorPerKategori = json_decode($hasil->skor_per_kategori, true);
        $rekomendasi = json_decode($hasil->rekomendasi, true);
        
        return view('siswa.hasil', compact('hasil', 'skorPerKategori', 'rekomendasi'));
    }
}
