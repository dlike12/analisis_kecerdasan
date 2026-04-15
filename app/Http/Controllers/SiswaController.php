<?php

namespace App\Http\Controllers;

use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $siswa = Auth::user()->siswa;
        $hasil = HasilAnalisis::where('siswa_id', $siswa->id)->first();
        return view('siswa.dashboard', compact('hasil'));
    }
}