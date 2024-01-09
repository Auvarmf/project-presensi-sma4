<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Siswa;

class PresensiSiswaController extends Controller
{
    public function index()
    {

        return view('presensi.presensi-siswa.index', [
            'title' => 'SMAN 4 Metro',
            'kehadiran' => Kehadiran::all()
        ]);
    }
}
