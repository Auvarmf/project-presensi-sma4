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
                'kode_mp' => '1',
                'nip' => '2117051027',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'A',
                'hari' => 'Rabu',
                'jam_mulai' => now()->setTime(7, 15)->toTimeString(),
                'jam_selesai' => now()->setTime(9, 15)->toTimeString(),
            ],
            [
                'kode_mp' => '2',
                'nip' => '2117051027',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'B',
                'hari' => 'Rabu',
                'jam_mulai' => now()->setTime(9, 15)->toTimeString(),
                'jam_selesai' => now()->setTime(11, 30)->toTimeString(),
            ],
            [
                'kode_mp' => '3',
                'nip' => '',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'C',
                'hari' => 'Rabu',
                'jam_mulai' => now()->setTime(13, 30)->toTimeString(),
                'jam_selesai' => now()->setTime(14, 45)->toTimeString(),
            ],
            [
                'kode_mp' => '4',
                'nip' => '',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'D',
                'hari' => 'Kamis',
                'jam_mulai' => now()->setTime(7, 15)->toTimeString(),
                'jam_selesai' => now()->setTime(8, 35)->toTimeString(),
            ],
            [
                'kode_mp' => '5',
                'nip' => '',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'E',
                'hari' => 'Kamis',
                'jam_mulai' => now()->setTime(8, 35)->toTimeString(),
                'jam_selesai' => now()->setTime(9, 55)->toTimeString(),
            ],
            [
                'kode_mp' => '6',
                'nip' => '',
                'mata_pelajaran' => 'Informatika',
                'kode_kelas' => 'F',
                'hari' => 'Kamis',
                'jam_mulai' => now()->setTime(12, 45)->toTimeString(),
                'jam_selesai' => now()->setTime(14, 45)->toTimeString(),
            ],
        ]);
    }
}
