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
        // Dapatkan pengguna yang sedang login (guru)
        $user = Auth::user();

        // Dapatkan mata pelajaran yang terkait dengan guru
        $subjects = $user->subjects;

        return view('presensi.index', [
            'title' => 'SMAN 4 Metro',
            'jadwals' => $subjects,
        ]);
    }
}
