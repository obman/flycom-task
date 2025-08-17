<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            DB::table('equipment_task')->insert($this->getSets());
        });
    }

    private function getSets(): array
    {
        $now = now();
        return [
            [
                'task_id' => 1,
                'equipment_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 1,
                'equipment_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 2,
                'equipment_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 2,
                'equipment_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 3,
                'equipment_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 4,
                'equipment_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 4,
                'equipment_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'task_id' => 4,
                'equipment_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
    }
}
