<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    use HasFactory;
    
    protected $table = 'hasil_analisis';
    
    protected $fillable = [
        'siswa_id', 'skor_per_kategori', 'cluster', 
        'tipe_kecerdasan_utama', 'rekomendasi', 'tanggal_tes'
    ];
    
    protected $casts = [
        'skor_per_kategori' => 'array',
        'rekomendasi' => 'array'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
