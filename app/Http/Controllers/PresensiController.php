<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Siswa;

class PresensiController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();

        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
            'jadwals' => $jadwals
        ]);
    }
}
