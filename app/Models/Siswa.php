<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenjang_kelas',
        'kategori_kelas',
        'nisn',
    ];

    /**
     * Get the user who is the wali kelas for this class.
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'nisn', 'nip');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id');
    }

    public static function getKelasValues()
    {
        return ['X', 'XI', 'XII'];
    }

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'nisn', 'nisn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nisn', 'nip');
    }

}