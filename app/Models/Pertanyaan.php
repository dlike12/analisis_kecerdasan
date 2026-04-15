<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    
    protected $table = 'pertanyaans';
    
    protected $fillable = [
        'pertanyaan', 'kategori', 'nomor_urut'
    ];
    
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'pertanyaan_id');
    }
}
