<?php

namespace Database\Seeders;

use App\Models\TypeOfServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfServices::insert([
            [
                'service_name' => 'Cuci dan Gosok',
                'price' => 5000,
                'description' => 'Jasa Cuci dan Gosok hanya Rp 5.000'
            ],
            [
                'service_name' => 'Cuci',
                'price' => 4500,
                'description' => 'Jasa Cuci hanya Rp 4.500'
            ],
            [
                'service_name' => 'Gosok',
                'price' => 5000,
                'description' => 'Jasa Gosok hanya Rp 5.000'
            ]
        ]);
    }
}
