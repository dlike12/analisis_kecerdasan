<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            ["Saya adalah pribadi yang tertutup dan menyukai dunia pribadi saya.", "intrapersonal"],
            ["Saya suka bergerak, mengetuk, atau gelisah saat duduk.", "kinestetik"],
            ["Saya bekerja paling baik di lingkungan yang terorganisir.", "logis_matematis"],
            ["Saya memiliki koleksi (misalnya: kerang, gelas, batu, kartu, dll).", "naturalis"],
            ["Saya bekerja paling baik melalui interaksi dengan orang lain.", "interpersonal"],
            ["Saya menyukai permainan kata atau humor bahasa.", "linguistik"],
            ["Saya sering memutar musik di dalam pikiran saya.", "musikal"],
            ["Saya memahami kombinasi warna dan warna yang cocok satu sama lain.", "spasial"],
            ["Saya merasa nyaman saat berhubungan dengan bahasa dan kata-kata.", "linguistik"],
            ["Saya suka menyelesaikan puzzle seperti jigsaw atau labirin.", "logis_matematis"],
            ["Saya dapat melihat persamaan dan perbedaan pada pohon, bunga, dan alam.", "naturalis"],
            ["Saya membuat rima untuk membantu mengingat sesuatu.", "linguistik"],
            ["Saya memiliki beberapa teman dekat.", "interpersonal"],
            ["Saya lebih menyukai olahraga tim daripada olahraga individu.", "interpersonal"],
            ["Saya menyukai matematika dan/atau sains.", "logis_matematis"],
            ["Saya mengikuti olahraga ekstrem (misalnya: kayak, snowboard, sepeda gunung).", "kinestetik"],
            ["Saya suka mengisi teka-teki silang atau permainan kata seperti Scrabble.", "linguistik"],
            ["Berada di sekitar orang lain membuat saya lebih bersemangat.", "interpersonal"],
            ["Saya mudah mengikuti irama musik.", "musikal"],
            ["Saya membuat daftar kegiatan (to-do list).", "logis_matematis"],
            ["Saya memiliki pendapat yang kuat tentang isu-isu kontroversial.", "intrapersonal"],
            ["Saya aktif dalam menjaga lingkungan.", "naturalis"],
            ["Saya mudah membaca grafik dan peta.", "spasial"],
            ["Saya penasaran dengan tekstur benda dan suka menyentuhnya.", "kinestetik"],
            ["Saya suka permainan logika seperti teka-teki atau kuis.", "logis_matematis"],
            ["Saya memiliki koordinasi tubuh yang baik.", "kinestetik"],
            ["Saya bekerja paling baik jika kegiatan berjalan sesuai kecepatan saya.", "intrapersonal"],
            ["Saya dapat mengingat sesuatu persis seperti yang disampaikan.", "linguistik"],
            ["Saya suka mengubah lagu atau puisi menjadi musik.", "musikal"],
            ["Saya suka mencari dan menemukan benda unik atau artefak.", "naturalis"],
            ["Saya lebih suka aktivitas kelompok daripada sendiri.", "interpersonal"],
            ["Saya memiliki arah yang baik.", "spasial"],
            ["Saya suka ikut debat atau diskusi.", "linguistik"],
            ["Saya bisa menjaga tempo saat musik dimainkan.", "musikal"],
            ["Saya suka memperhatikan adegan dalam film.", "spasial"],
            ["Saya suka bertanya 'mengapa' dan mencari penjelasan.", "logis_matematis"],
            ["Saya suka bekerja menggunakan tangan.", "kinestetik"],
            ["Saya tertarik mempelajari budaya yang berbeda.", "interpersonal"],
            ["Saya tidak mudah terpengaruh oleh orang lain.", "intrapersonal"],
            ["Saya lebih suka berada di luar ruangan daripada di dalam.", "naturalis"],
            ["Saya bekerja lebih baik dengan jadwal atau rencana harian.", "intrapersonal"],
            ["Saya sering mengalami mimpi yang jelas.", "spasial"],
            ["Saya lebih suka menjawab soal essay daripada pilihan ganda.", "linguistik"],
            ["Saya suka menanam dan merawat tanaman.", "naturalis"],
            ["Saya dapat mengenali nada musik yang tidak tepat.", "musikal"],
            ["Saya biasanya berbicara tentang masalah saya dengan teman.", "interpersonal"],
            ["Saya memahami perasaan saya sendiri dengan baik.", "intrapersonal"],
            ["Saya lebih suka aktif bergerak daripada hanya duduk diam.", "kinestetik"],
            ["Saya mudah terlibat dalam aktivitas musik.", "musikal"],
            ["Saya lebih mudah memahami sesuatu dengan praktik langsung.", "kinestetik"],
            ["Saya sering mengajukan pertanyaan tentang nilai dan keyakinan.", "intrapersonal"],
            ["Saya cepat memahami hubungan sebab-akibat.", "logis_matematis"],
            ["Saya dapat memprediksi langkah dalam permainan (seperti catur).", "logis_matematis"],
            ["Saya suka menulis jurnal atau cerita.", "linguistik"],
            ["Saya suka memancing atau melacak jejak.", "naturalis"],
            ["Saya suka berbagi ide dan perasaan dengan orang lain.", "interpersonal"],
            ["Saya suka membuat sesuatu dengan tangan.", "kinestetik"],
            ["Saya suka membaca.", "linguistik"],
            ["Saya bangga dengan kemampuan musik saya.", "musikal"],
            ["Saya belajar lebih baik melalui kunjungan lapangan atau observasi langsung.", "naturalis"],
            ["Saya pandai memperkirakan sesuatu.", "logis_matematis"],
            ["Saya bekerja paling baik dalam kelompok diskusi.", "interpersonal"],
            ["Saya sadar bahwa saya bertanggung jawab atas perilaku saya sendiri.", "intrapersonal"],
            ["Saya lebih mudah mengingat sesuatu dengan melihatnya.", "spasial"]
        ];

        foreach ($questions as $index => $q) {
            DB::table('pertanyaans')->insert([
                'pertanyaan' => $q[0],
                'kategori' => $q[1],
                'nomor_urut' => $index + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
