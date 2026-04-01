<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plants = collect([
            ['name' => 'Fern'],
            ['name' => 'Cactus'],
            ['name' => 'Succulent'],
        ]);
        $plants->each(function ($plant) {
            \App\Models\Plant::create($plant);
        });
    }
}
