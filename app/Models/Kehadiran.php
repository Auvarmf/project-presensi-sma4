<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nisn', 'nisn');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'kode_mp', 'kode_mp');
    }
}
