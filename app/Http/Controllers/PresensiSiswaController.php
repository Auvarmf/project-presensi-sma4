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
        // Fetch the jadwal
        $jadwal = Jadwal::where('kode_mp', $kode_mp)->first();

        // Check if the jadwal is found
        if (!$jadwal) {
            return redirect('/presensi')->with('error', 'Mata pelajaran tidak ditemukan.');
        }

        // Fetch the class (Kelas) corresponding to the jadwal
        $kelas = Jadwal::where('kode_kelas', $jadwal->kode_kelas)->first();

        // Check if the class is found
        if (!$kelas) {
            return redirect('/presensi')->with('error', 'Kelas tidak ditemukan.');
        }

        // Fetch students with the corresponding kode_kelas
        $siswas = Siswa::where('kode_kelas', $kelas->kode_kelas)->get();

        // Pass the data to the view
        return view('presensi.presensi-siswa.index', [
            'title' => 'SMAN 4 Metro',
            'siswas' => $siswas,
            'kode_mp' => $kode_mp,
            'mapel' => $jadwal->mata_pelajaran,
            'kelas' => $kelas,
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
                            'kode_kelas' => $siswa->kode_kelas,
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
        // Retrieve the $jadwal variable from the database
        $jadwal = Jadwal::where('kode_mp', $kode_mp)->first();

        // Check if the $jadwal variable is found
        if (!$jadwal) {
            return redirect('/presensi/presensi-siswa/' . $kode_mp)->with('error', 'Mata pelajaran tidak ditemukan.');
        }

        // Download the Excel file
        return Excel::download(new KehadiranExport($kode_mp, $jadwal), 'kehadiran_mapel_' . $jadwal->kode_mp . '_' . $jadwal->mata_pelajaran . '_Kelas_' . $jadwal->kode_kelas . '.xlsx');
    }
}