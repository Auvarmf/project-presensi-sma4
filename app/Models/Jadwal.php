<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'id_mapel',
        'id_kelas',
        'id_guru',
        'hari',
        'waktu_mulai',
        'waktu_selesai'
    ];

    // Definisikan relasi dengan mata pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id');
    }

    // Definisikan relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    // Definisikan relasi dengan guru
    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id');
    }

    public static function getHariValues(){
        return ['Senin','Selasa','Rabu','Kamis','Jumat'];
    }
}
