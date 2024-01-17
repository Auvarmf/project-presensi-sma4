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
            'kode_mp' => $request->kode_mp,
            'tanggal' => now()->format('Y-m-d'),
        ])->first();

        if ($cek) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Anda sudah absen');
        }

        Kehadiran::create([
            'nisn' => $request->nisn,
            'kode_mp' => $request->kode_mp,
            'tanggal' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
            'kehadiran' => 'Hadir',
        ]);

        return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('success', 'Berhasil Absen');
    }
}
