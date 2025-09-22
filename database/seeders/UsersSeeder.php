<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_level' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
        ]);
    }
}
