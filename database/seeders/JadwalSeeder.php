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
            ['kode_mp' => '1211', 'mata_pelajaran' => 'Pemrograman', 'jadwal_mp' => 'Senin, 08:00 AM - 10:00 AM'],
            ['kode_mp' => '1222', 'mata_pelajaran' => 'Informatika', 'jadwal_mp' => 'Selasa, 10:30 AM - 12:30 PM'],
            ['kode_mp' => '1233', 'mata_pelajaran' => 'Matematika', 'jadwal_mp' => 'Rabu, 07:30 AM - 09:20 AM']
        ]);
    }
}
