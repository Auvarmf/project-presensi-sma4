<?php

namespace App\Http\Controllers;

use App\Exports\KehadiranExport;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Maatwebsite\Excel\Facades\Excel;

class PresensiSiswaController extends Controller
{
    public function index(Request $request, $kode_mp)
    {
        $siswas = Siswa::all();
        $jadwal = Jadwal::where('kode_mp', $kode_mp)->first();

        // Periksa apakah jadwal ditemukan
        if ($jadwal) {
            $mapel = $jadwal->mata_pelajaran;
        } else {
            // Handle jika jadwal tidak ditemukan, misalnya dengan memberikan nilai default atau melempar exception
            $mapel = 'Mata Pelajaran Tidak Ditemukan';
            return redirect('/presensi')->with('error', 'Mata pelajaran tidak ditemukan.');
        }

        return view('presensi.presensi-siswa.index', [
            'title' => 'SMAN 4 Metro',
            'siswas' => $siswas,
            'kode_mp' => $kode_mp,
            'mapel' => $mapel,
        ]);
    }

    public function update(Request $request, $kode_mp)
    {
        $kehadiranData = $request->input('kehadiran');
        $originalKehadiranData = $request->input('original_kehadiran');

        foreach ($kehadiranData as $nisn => $kehadiran) {
            $siswa = Siswa::where('nisn', $nisn)->first();

            if ($siswa) {
                // Check if there is an existing attendance record for today
                $currentDate = now()->format('Y-m-d');
                $existingAttendance = Kehadiran::where('nisn', $nisn)
                    ->where('tanggal', $currentDate)
                    ->where('kode_mp', $kode_mp)
                    ->first();

                if ($existingAttendance) {
                    // Update existing attendance record only if $kehadiran is not null
                    if ($kehadiran !== null) {
                        $existingAttendance->update([
                            'kehadiran' => $kehadiran,
                        ]);
                    }
                } else {
                    // Create new attendance record only if $kehadiran is not null
                    if ($kehadiran !== null) {
                        Kehadiran::create([
                            'nisn' => $nisn,
                            'kode_mp' => $kode_mp,
                            'tanggal' => $currentDate,
                            'jam' => now()->format('H:i:s'),
                            'kehadiran' => $kehadiran,
                        ]);
                    }
                }
            }
        }

        return redirect('/presensi/presensi-siswa/' . $kode_mp)->with('success', 'Perubahan kehadiran disimpan.');
    }

    public function export(Request $request, $kode_mp)
    {
        return Excel::download(new KehadiranExport($kode_mp), 'kehadiran_mapel_' . $kode_mp . '.xlsx');
    }
}
