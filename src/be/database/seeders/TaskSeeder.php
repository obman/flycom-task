<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            DB::table('tasks')->insert($this->getTasks());
        });
    }

    private function getTasks(): array
    {
        $now = now();
        return [
            [
                'name' => 'terrain-scan',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'test-task',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'test-task1',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'test-task2',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
    }
}
