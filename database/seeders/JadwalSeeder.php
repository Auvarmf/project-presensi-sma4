<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwals')->insert([
            [
                'kode_mp' => '1211',
                'mata_pelajaran' => 'Pemrograman',
                'hari' => 'Senin',
                'jam_mulai' => now()->setTime(8, 0)->toTimeString(),
                'jam_selesai' => now()->setTime(10, 0)->toTimeString(),
            ],
            [
                'kode_mp' => '1222',
                'mata_pelajaran' => 'Informatika',
                'hari' => 'Selasa',
                'jam_mulai' => now()->setTime(10, 30)->toTimeString(),
                'jam_selesai' => now()->setTime(12, 30)->toTimeString(),
            ],
            [
                'kode_mp' => '1233',
                'mata_pelajaran' => 'Matematika',
                'hari' => 'Rabu',
                'jam_mulai' => now()->setTime(7, 30)->toTimeString(),
                'jam_selesai' => now()->setTime(9, 20)->toTimeString(),
            ],
        ]);
    }
}
