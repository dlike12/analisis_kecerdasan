<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_lengkap' => 'Administrator',
            'role' => 'admin',
            'nip' => 'ADMIN001',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'guru001',
            'password' => Hash::make('guru123'),
            'nama_lengkap' => 'Budi Santoso',
            'role' => 'guru',
            'nip' => '198512342023101001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
