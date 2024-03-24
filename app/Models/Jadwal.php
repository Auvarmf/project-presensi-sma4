<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'id_mapel',
        'id_kelas',
        'id_guru',
        'hari',
        'waktu_mulai',
        'waktu_selesai'
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'id_mapel', 'id_mapel');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id', 'id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id');
    }

    // Definisikan relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Siswa::class, 'id_kelas', 'id');
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