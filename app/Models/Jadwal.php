<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'kode_mp', 'kode_mp');
    }
}
