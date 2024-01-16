<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\Siswa;

class PresensiSiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();

        return view('presensi.presensi-siswa.index', [
            'title' => 'SMAN 4 Metro',
            'siswas' => $siswas,
        ]);
    }

    public function update(Request $request)
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
                    ->first();

                if ($existingAttendance) {
                    // Update existing attendance record
                    $existingAttendance->update([
                        'kehadiran' => $kehadiran,
                    ]);
                } else {
                    // Create new attendance record
                    Kehadiran::create([
                        'nisn' => $nisn,
                        'tanggal' => $currentDate,
                        'jam' => now()->format('H:i:s'),
                        'kehadiran' => $kehadiran,
                    ]);
                }
            }
        }

        return redirect('/presensi/presensi-siswa')->with('success', 'Perubahan kehadiran disimpan.');
    }
}
