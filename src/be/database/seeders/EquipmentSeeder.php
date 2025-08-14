<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            DB::table('equipment')->insert([
                [
                    'name' => 'radar'
                ],
                [
                    'name' => 'laser'
                ]
            ]);
        });
    }
}
