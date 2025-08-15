<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AircraftTypesSeeder::class,
            AircraftSizesSeeder::class,
            AircraftSeeder::class,
            EquipmentSeeder::class,
            TaskSeeder::class,

            AircraftEquipmentSeeder::class,

            RolesSeeder::class,
        ]);
    }
}
