<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = [
            ['nisn' => '6201', 'nama' => 'Agyas Putra Ramadhan Mubarak', 'kode_kelas' => 'A'],
            ['nisn' => '6202', 'nama' => 'Auvar Mahsa Fahlevi', 'kode_kelas' => 'A'],
            ['nisn' => '6203', 'nama' => 'Ramadhan Kamal', 'kode_kelas' => 'B'],
            ['nisn' => '6204', 'nama' => 'Nicholas Elvis', 'kode_kelas' => 'B'],
            ['nisn' => '6205', 'nama' => 'Ferli Malkan Amien', 'kode_kelas' => 'C'],
            ['nisn' => '6206', 'nama' => 'Muhamad Hafiz Atsal', 'kode_kelas' => 'C'],
            ['nisn' => '6207', 'nama' => 'Ralasya Putri', 'kode_kelas' => 'D'],
            ['nisn' => '6208', 'nama' => 'Putri Cantika', 'kode_kelas' => 'D'],
            ['nisn' => '6209', 'nama' => 'Cindy Loria', 'kode_kelas' => 'E'],
            ['nisn' => '6210', 'nama' => 'Saras Maharani', 'kode_kelas' => 'E'],
            ['nisn' => '6211', 'nama' => 'Andika Pratama', 'kode_kelas' => 'F'],
            ['nisn' => '6212', 'nama' => 'Ramadhan Putra', 'kode_kelas' => 'F'],
        ];

        Siswa::insert($siswa);
    }
}
