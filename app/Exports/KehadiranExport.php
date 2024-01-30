<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Jadwal;
use App\Models\Siswa;

class KehadiranExport implements FromCollection, WithHeadings, WithTitle, WithMapping
{
    protected $kode_mp;
    protected $jadwal;

    public function __construct($kode_mp, $jadwal)
    {
        $this->kode_mp = $kode_mp;
        $this->jadwal = $jadwal;
    }

    public function collection()
    {
        return Kehadiran::where('kode_mp', $this->kode_mp)->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama Siswa',
            'Tanggal',
            'Jam',
            'Kehadiran',
        ];
    }

    public function title(): string
    {
        return 'Mata Pelajaran: ' . $this->getSubjectName($this->kode_mp);
    }

    public function map($kehadiran): array
    {
        // Get Siswa information based on NISN
        $siswa = Siswa::where('nisn', $kehadiran->nisn)->first();

        return [
            $kehadiran->nisn,
            $siswa ? $siswa->nama : 'Not Found',
            $kehadiran->tanggal,
            $kehadiran->jam,
            $kehadiran->kehadiran,
        ];
    }

    private function getSubjectName($kode_mp)
    {
        $jadwal = Jadwal::where('kode_mp', $kode_mp)->first();
        return $jadwal ? $jadwal->mata_pelajaran : 'Not Found';
    }
}
