<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['nisn', 'nama', 'kelas', 'tingkat']; // Atur kolom yang bisa diisi

    // Menambahkan relasi dengan model Kehadiran
    public function kehadiran()
    {
        return $this->hasOne(Kehadiran::class, 'nisn', 'nisn');
    }
}
