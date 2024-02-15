<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenjang_kelas',
        'kategori_kelas',
        'wali_kelas_id',
        'jumlah_siswa',
    ];

    /**
     * Get the user who is the wali kelas for this class.
     */
    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas','id');
    }

    public static function getKelasValues()
    {
        return ['X', 'XI', 'XII'];
    }
}
