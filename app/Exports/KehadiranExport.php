<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Siswa;

class KehadiranExport implements FromCollection, WithHeadings, WithTitle, WithMapping
{
    protected $id;
    protected $jadwal;
    protected $kategori_kelas;

    public function __construct($id, $jadwal, $kategori_kelas)
    {
        $this->id = $id;
        $this->jadwal = $jadwal;
        $this->kategori_kelas = $kategori_kelas;
    }

    public function collection()
    {
        return Kehadiran::where('id_mapel', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama Siswa',
            'Kode Kelas',
            'Tanggal',
            'Jam',
            'Kehadiran',
        ];
    }

    public function title(): string
    {
        return 'Mata Pelajaran: ' . $this->getSubjectName($this->id);
    }

    public function map($kehadiran): array
    {
        // Get student information based on NIP
        $user = User::where('nip', $kehadiran->nisn)->first();

        // Get the corresponding class code from Siswa table
        $siswa = Siswa::where('nisn', $user->nip)->first();

        return [
            $user ? $user->nip : 'Not Found',
            $user ? $user->name : 'Not Found',
            $siswa ? $siswa->kategori_kelas : 'Not Found',
            $kehadiran->tanggal,
            $kehadiran->jam,
            $kehadiran->kehadiran,
        ];
    }

    private function getSubjectName($id)
    {
        $jadwal = Jadwal::where('id', $id)->first();
        return $jadwal ? $jadwal->mataPelajaran->nama_mapel : 'Not Found';
    }
}