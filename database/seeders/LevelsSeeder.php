<?php

namespace Database\Seeders;

use App\Models\Levels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Levels::insert([
            ['level_name' => 'Administrator'],
            ['level_name' => 'Operator'],
            ['level_name' => 'Pimpinan']
        ]);
    }
}
