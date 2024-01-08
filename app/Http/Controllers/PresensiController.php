<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class PresensiController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa dari tabel siswa
        $siswaData = Siswa::all();

        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
            'siswaData' => $siswaData,
        ]);
    }
}
