<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveSetting;

class LeaveSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'code' => 'VL',
                'name' => 'Vacation Leave',
                'consumable' => 96,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SL',
                'name' => 'Sick Leave',
                'consumable' => 88,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'EL',
                'name' => 'Emergency Leave',
                'consumable' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BDL',
                'name' => 'Birthday Leave',
                'consumable' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ML',
                'name' => 'Maternity Leave',
                'consumable' => 240,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PL',
                'name' => 'Paternity Leave',
                'consumable' => 56,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'BL',
                'name' => 'Bereavement Leave',
                'consumable' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        LeaveSetting::insert($seeder);
    }
}
