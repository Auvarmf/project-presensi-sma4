<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['nisn', 'keterangan_hadir']; // Atur kolom yang bisa diisi

    // Menambahkan relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }
}
