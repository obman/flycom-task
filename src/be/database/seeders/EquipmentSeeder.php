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
            DB::table('equipment')->insert($this->getEquipment());
        });
    }

    private function getEquipment(): array
    {
        $now = now();
        return [
            [
                'name' => 'radar',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'laser',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'napalm',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
    }
}
