<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class NamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@patitech.id',
            'password' => bcrypt('password123'),
            'level' => 'Admin',
        ]);

        User::create([
            'nama' => 'Fajar Husain',
            'email' => 'fajarhusain@patitech.id',
            'password' => bcrypt('password123'),
            'level' => 'Admin',
        ]);
    }
}
