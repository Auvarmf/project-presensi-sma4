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
    public function index(Request $request, $id)
    {
        // Fetch the jadwal
        $jadwal = Jadwal::findOrFail($id);

        // Get the class ID from the schedule
        $id_kelas = $jadwal->id_kelas;

        // Get the class category from the schedule
        $kategori_kelas = $jadwal->kelas->kategori_kelas;

        // Fetch students based on class category
        $siswas = Siswa::where('kategori_kelas', $kategori_kelas)->get();

        // Pass the data to the view
        return view('presensi.presensi-siswa.index', [
            'title' => 'SMAN 4 Metro',
            'siswas' => $siswas,
            'id' => $id,
            'jadwal' => $jadwal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kehadiranData = $request->input('kehadiran');

        // Loop through each attendance data
        foreach ($kehadiranData as $siswaNip => $kehadiran) {
            // Check if kehadiran is not null
            if ($kehadiran !== null) {
                // Retrieve the jadwal
                $jadwal = Jadwal::findOrFail($id);

                // Check if the jadwal has a class
                $id_kelas = $jadwal->id_kelas ? $jadwal->id_kelas : null;

                // Find or create kehadiran record
                $kehadiran = Kehadiran::updateOrCreate(
                    [
                        'nisn' => $siswaNip,
                        'id_mapel' => $id,
                        'tanggal' => now()->format('Y-m-d'),
                    ],
                    [
                        'id_kelas' => $id_kelas,
                        'jam' => now()->format('H:i:s'),
                        'kehadiran' => $kehadiran,
                    ]
                );
            }
        }

        return redirect('/presensi/presensi-siswa/' . $id)->with('success', 'Perubahan kehadiran disimpan.');
    }

    public function export(Request $request, $id)
    {
        // Retrieve the $jadwal variable from the database
        $jadwal = Jadwal::where('id', $id)->first();

        // Check if the $jadwal variable is found
        if (!$jadwal) {
            return redirect('/presensi/presensi-siswa/' . $id)->with('error', 'Mata pelajaran tidak ditemukan.');
        }

        // Retrieve the class category from the related students
        $kategori_kelas = $jadwal->siswas()->first()->kategori_kelas;

        // Download the Excel file
        return Excel::download(new KehadiranExport($id, $jadwal, $kategori_kelas), 'kehadiran_mapel_' . $jadwal->id . '_' . $jadwal->mataPelajaran->nama_mapel . '_Kelas_' . $jadwal->kelas->kategori_kelas . '.xlsx');
    }

}