<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::get();
        
        $data = [
            'data_jadwal'  => $jadwal,
            'title'   => 'Daftar Jadwal'
        ];

        
        return view('jadwal-siswa.jadwal', $data);
    }
}
