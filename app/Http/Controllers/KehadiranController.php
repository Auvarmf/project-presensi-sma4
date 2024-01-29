<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Jadwal;


class KehadiranController extends Controller
{
    public function store(Request $request)
    {
        // Check if the student has already attended for the day
        $cek = Kehadiran::where([
            'nisn' => $request->nisn,
            'kode_mp' => $request->kode_mp,
            'tanggal' => now()->format('Y-m-d'),
        ])->first();

        if ($cek) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Anda sudah absen');
        }

        // Fetch the corresponding schedule for the given $request->kode_mp
        $jadwal = Jadwal::where('kode_mp', $request->kode_mp)->first();

        if (!$jadwal) {
            // Handle case when jadwal is not found
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Jadwal tidak ditemukan');
        }

        $currentTime = now();

        // Check if the current time is before the class starts
        if ($currentTime < $jadwal->jam_mulai) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Presensi belum dapat dilakukan, jam pelajaran belum dimulai');
        }

        // Check if the current time is after the class ends
        if ($currentTime > $jadwal->jam_selesai) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Presensi tidak dapat dilakukan, jam pelajaran telah selesai');
        }

        // If all checks pass, create attendance record
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
