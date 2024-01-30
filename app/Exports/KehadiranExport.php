<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Jadwal;

class KehadiranExport implements FromCollection, WithHeadings, WithTitle
{
    protected $kode_mp;

    public function __construct($kode_mp)
    {
        $this->kode_mp = $kode_mp;
    }

    public function collection()
    {
        return Kehadiran::where('kode_mp', $this->kode_mp)->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Kode MP',
            'Tanggal',
            'Jam',
            'Kehadiran',
        ];
    }

    public function title(): string
    {
        return 'Mata Pelajaran: ' . $this->getSubjectName($this->kode_mp);
    }

    private function getSubjectName($kode_mp)
    {
        $jadwal = Jadwal::where('kode_mp', $kode_mp)->first();
        return $jadwal ? $jadwal->mata_pelajaran : 'Not Found';
    }
}
