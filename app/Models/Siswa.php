<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    
    protected $table = 'siswa';
    
    protected $fillable = [
        'nik', 'nama', 'kelas', 'jenis_kelamin', 'umur', 'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'siswa_id');
    }
    
    public function hasilAnalisis()
    {
        return $this->hasOne(HasilAnalisis::class, 'siswa_id');
    }
}
