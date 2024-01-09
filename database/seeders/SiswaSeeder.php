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
            [
                'nisn' => '111',
                'nama' => 'Auvar'
            ],
            [
                'nisn' => '222',
                'nama' => 'Elvis'
            ],
            [
                'nisn' => '333',
                'nama' => 'Kamal'
            ]
        ];

        Siswa::insert($siswa);
    }
}
