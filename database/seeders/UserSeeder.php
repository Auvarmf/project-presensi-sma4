<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => "Staf Admin",
                'nip' => 'admin1',
                'password' => bcrypt('sman4admin'),
                'role' => "admin"
            ],
            [
                'name' => "Wahyono, S.Kom",
                'nip' => 2157,
                'password' => bcrypt('guru1234'),
                'role' => "guru"
            ],
        ];

        User::insert($user);
    }
}
