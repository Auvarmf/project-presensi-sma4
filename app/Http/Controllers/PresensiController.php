<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::get();

        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
            'jadwals' => $jadwal,
        ]);
    }
}