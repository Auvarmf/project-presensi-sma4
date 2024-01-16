<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function store(Request $request)
    {
        // cek data
        $cek = Kehadiran::where([
            'nisn' => $request->nisn,
            'tanggal' => date('Y-m-d')
        ])->first();

        if ($cek) {
            return redirect('/presensi/presensi-siswa')->with('gagal', 'Anda sudah absen');
        }

        Kehadiran::create([
            'nisn' => $request->nisn,
            'tanggal' => date('Y-m-d'),
            'jam' => now()->format('H:i:s'),
            'kehadiran' => 'Hadir'
        ]);

        return redirect('/presensi/presensi-siswa')->with('success', 'Silakan masuk');
    }
}
