<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    
    protected $table = 'jawabans';
    
    protected $fillable = [
        'siswa_id', 'pertanyaan_id', 'skor'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
