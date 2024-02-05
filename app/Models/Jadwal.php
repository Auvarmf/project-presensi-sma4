<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
    ];

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'kode_mp', 'kode_mp');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kode_kelas', 'kode_kelas');
    }

}
