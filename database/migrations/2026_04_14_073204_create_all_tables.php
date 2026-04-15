<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->enum('role', ['admin', 'guru', 'siswa']);
            $table->string('nip')->nullable();
            $table->timestamps();
        });

        // Tabel siswa
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('kelas');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('umur');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel pertanyaans
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->string('kategori');
            $table->integer('nomor_urut');
            $table->timestamps();
        });

        // Tabel jawabans
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('pertanyaan_id')->constrained('pertanyaans')->onDelete('cascade');
            $table->integer('skor');
            $table->timestamps();
        });

        // Tabel hasil_analisis
        Schema::create('hasil_analisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->json('skor_per_kategori');
            $table->integer('cluster');
            $table->string('tipe_kecerdasan_utama');
            $table->json('rekomendasi');
            $table->date('tanggal_tes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_analisis');
        Schema::dropIfExists('jawabans');
        Schema::dropIfExists('pertanyaans');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('users');
    }
};
