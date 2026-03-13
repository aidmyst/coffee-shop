<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cukup tulis User:: karena sudah di-import di atas
        User::create([
            'name' => 'Owner Cafe',
            'email' => 'admin@cafe.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@cafe.com',
            'password' => bcrypt('password123'),
            'role' => 'kasir',
        ]);
    }
}
