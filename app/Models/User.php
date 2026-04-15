<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'role', 'nip'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }
}
