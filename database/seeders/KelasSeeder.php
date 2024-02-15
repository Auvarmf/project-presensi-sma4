<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'jenjang_kelas'     => 'X',
            'kategori_kelas'    => '1',
            'wali_kelas_id'     => '2',
        ]);

        Kelas::create([
            'jenjang_kelas'     => 'XII',
            'kategori_kelas'    => 'IPA 1',
            'wali_kelas_id'     => '2',
        ]);
    }
}
