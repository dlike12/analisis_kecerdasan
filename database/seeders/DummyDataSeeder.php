<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\HasilAnalisis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Data siswa dummy (15 orang)
        $siswaData = [
            ['nik' => '123456789001', 'nama' => 'Ahmad Fauzi', 'kelas' => '7A', 'jk' => 'L', 'umur' => 12],
            ['nik' => '123456789002', 'nama' => 'Budi Santoso', 'kelas' => '7A', 'jk' => 'L', 'umur' => 13],
            ['nik' => '123456789003', 'nama' => 'Citra Dewi', 'kelas' => '7A', 'jk' => 'P', 'umur' => 12],
            ['nik' => '123456789004', 'nama' => 'Dian Purnama', 'kelas' => '7B', 'jk' => 'P', 'umur' => 13],
            ['nik' => '123456789005', 'nama' => 'Eka Prasetya', 'kelas' => '7B', 'jk' => 'L', 'umur' => 12],
            ['nik' => '123456789006', 'nama' => 'Fitri Handayani', 'kelas' => '7B', 'jk' => 'P', 'umur' => 13],
            ['nik' => '123456789007', 'nama' => 'Gilang Ramadhan', 'kelas' => '8A', 'jk' => 'L', 'umur' => 13],
            ['nik' => '123456789008', 'nama' => 'Hesti Nurjanah', 'kelas' => '8A', 'jk' => 'P', 'umur' => 14],
            ['nik' => '123456789009', 'nama' => 'Indra Wijaya', 'kelas' => '8A', 'jk' => 'L', 'umur' => 13],
            ['nik' => '123456789010', 'nama' => 'Joko Susilo', 'kelas' => '8B', 'jk' => 'L', 'umur' => 14],
            ['nik' => '123456789011', 'nama' => 'Karina Melati', 'kelas' => '8B', 'jk' => 'P', 'umur' => 13],
            ['nik' => '123456789012', 'nama' => 'Lukman Hakim', 'kelas' => '9A', 'jk' => 'L', 'umur' => 14],
            ['nik' => '123456789013', 'nama' => 'Mega Sari', 'kelas' => '9A', 'jk' => 'P', 'umur' => 15],
            ['nik' => '123456789014', 'nama' => 'Nanda Pratama', 'kelas' => '9B', 'jk' => 'L', 'umur' => 14],
            ['nik' => '123456789015', 'nama' => 'Olivia Zahra', 'kelas' => '9B', 'jk' => 'P', 'umur' => 15],
        ];

        // Data skor untuk setiap siswa (8 kategori kecerdasan)
        // Format: [linguistik, logis_matematis, spasial, kinestetik, musikal, interpersonal, intrapersonal, naturalis]
        $skorSiswa = [
            [85, 75, 80, 70, 65, 90, 75, 80],  // Ahmad Fauzi - Interpersonal
            [70, 90, 75, 80, 85, 65, 70, 75],  // Budi Santoso - Logis-Matematis
            [90, 70, 85, 65, 80, 85, 80, 75],  // Citra Dewi - Linguistik
            [75, 80, 85, 70, 75, 80, 85, 90],  // Dian Purnama - Naturalis
            [65, 85, 80, 90, 75, 70, 80, 75],  // Eka Prasetya - Kinestetik
            [80, 75, 70, 65, 90, 85, 75, 80],  // Fitri Handayani - Musikal
            [85, 80, 75, 70, 80, 75, 90, 85],  // Gilang Ramadhan - Intrapersonal
            [75, 85, 90, 80, 75, 80, 70, 85],  // Hesti Nurjanah - Spasial
            [80, 75, 70, 85, 80, 90, 75, 70],  // Indra Wijaya - Interpersonal
            [70, 80, 75, 90, 85, 75, 80, 85],  // Joko Susilo - Kinestetik
            [90, 85, 80, 75, 70, 80, 85, 75],  // Karina Melati - Linguistik
            [85, 90, 75, 80, 75, 70, 80, 85],  // Lukman Hakim - Logis-Matematis
            [75, 70, 85, 80, 90, 85, 75, 80],  // Mega Sari - Musikal
            [80, 85, 90, 75, 70, 75, 85, 80],  // Nanda Pratama - Spasial
            [85, 80, 75, 70, 85, 90, 80, 75],  // Olivia Zahra - Interpersonal
        ];

        // Mapping skor ke tipe kecerdasan utama
        $tipeKecerdasan = [
            'interpersonal', 'logis_matematis', 'linguistik', 'naturalis', 
            'kinestetik', 'musikal', 'intrapersonal', 'spasial', 
            'interpersonal', 'kinestetik', 'linguistik', 'logis_matematis', 
            'musikal', 'spasial', 'interpersonal'
        ];

        // Hitung cluster berdasarkan rata-rata skor
        $clusters = [2, 3, 2, 3, 2, 2, 3, 3, 2, 2, 3, 3, 2, 3, 2];

        // Buat data untuk setiap siswa
        foreach ($siswaData as $index => $data) {
            // Buat user
            $user = User::create([
                'username' => $data['nik'],
                'password' => Hash::make($data['nik']),
                'nama_lengkap' => $data['nama'],
                'role' => 'siswa',
                'nip' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Buat siswa
            $siswa = Siswa::create([
                'nik' => $data['nik'],
                'nama' => $data['nama'],
                'kelas' => $data['kelas'],
                'jenis_kelamin' => $data['jk'],
                'umur' => $data['umur'],
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Buat jawaban untuk 64 pertanyaan
            $pertanyaans = Pertanyaan::all();
            $skorKategori = $skorSiswa[$index];
            
            // Mapping kategori ke indeks
            $kategoriMap = [
                'linguistik' => 0,
                'logis_matematis' => 1,
                'spasial' => 2,
                'kinestetik' => 3,
                'musikal' => 4,
                'interpersonal' => 5,
                'intrapersonal' => 6,
                'naturalis' => 7
            ];

            foreach ($pertanyaans as $pertanyaan) {
                // Dapatkan skor berdasarkan kategori pertanyaan
                $katIndeks = $kategoriMap[$pertanyaan->kategori];
                $baseSkor = $skorKategori[$katIndeks];
                
                // Variasi skor antara 1-5 berdasarkan base skor
                if ($baseSkor >= 85) {
                    $skor = rand(4, 5);
                } elseif ($baseSkor >= 70) {
                    $skor = rand(3, 4);
                } elseif ($baseSkor >= 55) {
                    $skor = rand(2, 3);
                } else {
                    $skor = rand(1, 2);
                }
                
                Jawaban::create([
                    'siswa_id' => $siswa->id,
                    'pertanyaan_id' => $pertanyaan->id,
                    'skor' => $skor,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Buat hasil analisis
            $skorPerKategori = [
                'linguistik' => $skorSiswa[$index][0],
                'logis_matematis' => $skorSiswa[$index][1],
                'spasial' => $skorSiswa[$index][2],
                'kinestetik' => $skorSiswa[$index][3],
                'musikal' => $skorSiswa[$index][4],
                'interpersonal' => $skorSiswa[$index][5],
                'intrapersonal' => $skorSiswa[$index][6],
                'naturalis' => $skorSiswa[$index][7],
            ];

            // Rekomendasi berdasarkan tipe kecerdasan utama
            $rekomendasi = $this->getRekomendasi($tipeKecerdasan[$index]);

            HasilAnalisis::create([
                'siswa_id' => $siswa->id,
                'skor_per_kategori' => json_encode($skorPerKategori),
                'cluster' => $clusters[$index],
                'tipe_kecerdasan_utama' => $tipeKecerdasan[$index],
                'rekomendasi' => json_encode($rekomendasi),
                'tanggal_tes' => now()->subDays(rand(1, 30)),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info('Berhasil membuat 15 data siswa dummy!');
    }

    private function getRekomendasi($tipe)
    {
        $rekomendasi = [
            'linguistik' => [
                ['aktivitas' => 'Membaca Buku Cerita', 'deskripsi' => 'Baca buku 30 menit setiap hari'],
                ['aktivitas' => 'Menulis Jurnal', 'deskripsi' => 'Tulis pengalaman dalam jurnal harian'],
                ['aktivitas' => 'Diskusi', 'deskripsi' => 'Ikut diskusi kelompok tentang topik menarik']
            ],
            'logis_matematis' => [
                ['aktivitas' => 'Puzzle', 'deskripsi' => 'Selesaikan puzzle atau teka-teki logika'],
                ['aktivitas' => 'Eksperimen', 'deskripsi' => 'Lakukan eksperimen sains sederhana'],
                ['aktivitas' => 'Catur', 'deskripsi' => 'Main catur atau permainan strategi']
            ],
            'spasial' => [
                ['aktivitas' => 'Menggambar', 'deskripsi' => 'Gambar pemandangan atau objek 3D'],
                ['aktivitas' => 'Membaca Peta', 'deskripsi' => 'Latihan membaca dan membuat peta'],
                ['aktivitas' => 'Fotografi', 'deskripsi' => 'Ambil foto dengan komposisi menarik']
            ],
            'musikal' => [
                ['aktivitas' => 'Belajar Alat Musik', 'deskripsi' => 'Pelajari alat musik dasar'],
                ['aktivitas' => 'Menyanyi', 'deskripsi' => 'Ikut paduan suara'],
                ['aktivitas' => 'Menciptakan Lagu', 'deskripsi' => 'Buat lagu sederhana']
            ],
            'kinestetik' => [
                ['aktivitas' => 'Olahraga', 'deskripsi' => 'Ikut kegiatan olahraga rutin'],
                ['aktivitas' => 'Tari', 'deskripsi' => 'Belajar tarian'],
                ['aktivitas' => 'Kerajinan Tangan', 'deskripsi' => 'Buat kerajinan dari bahan bekas']
            ],
            'interpersonal' => [
                ['aktivitas' => 'Kerja Kelompok', 'deskripsi' => 'Ikut proyek kelompok di sekolah'],
                ['aktivitas' => 'Organisasi', 'deskripsi' => 'Gabung organisasi siswa'],
                ['aktivitas' => 'Menjadi Mentor', 'deskripsi' => 'Bantu teman yang kesulitan']
            ],
            'intrapersonal' => [
                ['aktivitas' => 'Meditasi', 'deskripsi' => 'Luangkan waktu untuk merenung'],
                ['aktivitas' => 'Menetapkan Target', 'deskripsi' => 'Buat target belajar mingguan'],
                ['aktivitas' => 'Refleksi Diri', 'deskripsi' => 'Evaluasi kelebihan dan kekurangan']
            ],
            'naturalis' => [
                ['aktivitas' => 'Berkebun', 'deskripsi' => 'Tanam dan rawat tanaman'],
                ['aktivitas' => 'Observasi Alam', 'deskripsi' => 'Amati burung atau serangga'],
                ['aktivitas' => 'Recycling', 'deskripsi' => 'Buat kerajinan dari daur ulang']
            ]
        ];
        
        return $rekomendasi[$tipe] ?? $rekomendasi['linguistik'];
    }
}
