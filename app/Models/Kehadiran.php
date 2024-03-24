<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'id_mapel',
        'id_kelas',
        'tanggal',
        'jam',
        'kehadiran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'siswa_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_mapel', 'id_mapel');
    }
}
