<?php

namespace Database\Seeders;

use App\Models\PresUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PresUser::create([
            'id_number' => 'HII-admin',
            'name' => 'ADMINISTRATOR',
            'role' => '0',
            'password' => '$2y$10$nrm1iIbhHzqwo4V6/KvCcuSCUuvIzlD3h1TtnKUU1bVPLuiFUUhCi',
            'first_time_login' => '0',
            'key' => Str::uuid()->toString(),
        ]);
    }
}
