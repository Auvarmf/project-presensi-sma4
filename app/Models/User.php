<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'nip',
        'image',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public static function getRoleValues(){
        return ['guru', 'siswa'];
    }

    public function subjects()
    {
        return $this->hasMany(Jadwal::class, 'nip', 'nip');
    }

}