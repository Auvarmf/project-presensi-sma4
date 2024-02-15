<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Siswa;


class KehadiranController extends Controller
{
    public function store(Request $request){
        // Check if the student has already attended for the day
        $cek = Kehadiran::where([
            'nisn' => $request->nisn,
            'kode_mp' => $request->kode_mp,
            'tanggal' => now()->startOfDay(),
        ])->first();

        if ($cek) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Anda sudah absen');
        }

        // Check if the student with the scanned NISN exists in the Siswa table
        $siswa = Siswa::where('nisn', $request->nisn)->first();
        if (!$siswa) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Siswa dengan NISN tersebut tidak ditemukan');
        }

        // Fetch the corresponding student based on nisn
        $studentJadwal = Jadwal::where('kode_mp', $request->kode_mp)->first();
        $kode_kelas_jadwal = $studentJadwal->kode_kelas;

        // Fetch the corresponding student from Siswa based on nisn
        $studentSiswa = Siswa::where('nisn', $request->nisn)->first();
        $kode_kelas_siswa = $studentSiswa->kode_kelas;

        // Check if siswa dengan nis dan kelas tidak sesuai
        if ($kode_kelas_jadwal !== $kode_kelas_siswa) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Siswa tidak ditemukan');
        }

        // Fetch the corresponding schedule for the given $request->kode_mp
        $jadwal = Jadwal::where('kode_mp', $request->kode_mp)->first();

        if (!$jadwal) {
            // Handle case when jadwal is not found
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Jadwal tidak ditemukan');
        }

        $currentTime = now();
        $timezone = config('app.timezone'); // Get the application timezone from the configuration

        // Convert schedule time to application timezone
        $jadwalJamMulai = $jadwal->jam_mulai->setTimezone($timezone);
        $jadwalJamSelesai = $jadwal->jam_selesai->setTimezone($timezone);

        // Check if the current time is before the class starts
        if ($currentTime < $jadwalJamMulai) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Jam pelajaran belum dimulai');
        }

        // Check if the current time is after the class ends
        if ($currentTime > $jadwalJamSelesai) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Jam pelajaran telah selesai');
        }

        // Check if the current day is the scheduled day
        $scheduledDayOfWeek = strtolower($jadwal->hari);
        $currentDayOfWeek = strtolower($currentTime->translatedFormat('l')); // Get the current day Indonesian

        if ($scheduledDayOfWeek !== $currentDayOfWeek) {
            return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('gagal', 'Hari ini bukan hari pelajaran');
        }

        // If all checks pass, create attendance record
        Kehadiran::create([
            'nisn' => $request->nisn,
            'kode_mp' => $request->kode_mp,
            'kode_kelas' => $kode_kelas_jadwal,
            'tanggal' => now()->format('Y-m-d'),
            'jam' => now()->format('H:i:s'),
            'kehadiran' => 'Hadir',
        ]);

        return redirect()->route('presensi-siswa.index', ['kode_mp' => $request->kode_mp])->with('success', 'Berhasil Absen');
    }

}
