<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Staf Admin",
            'nomor_induk' => 'admin1',
            'password' => bcrypt('sman4admin'),
            'role' => "admin"
        ]);

        User::create([
            'name' => "didik s.kom.",
            'nomor_induk' => 2157,
            'password' => bcrypt('guru1234'),
            'role' => "guru"
        ]);

        User::create([
            'name' => "antonlay",
            'nomor_induk' => 2107,
            'password' => bcrypt('siswa1234'),
            'role' => "siswa"
        ]);
    }
}
