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
            ],
            [
                'code' => 'SL',
                'name' => 'Sick Leave',
                'consumable' => 88,
            ],
            [
                'code' => 'EL',
                'name' => 'Emergency Leave',
                'consumable' => 0,
            ],
            [
                'code' => 'BDL',
                'name' => 'Birthday Leave',
                'consumable' => 8,
            ],
            [
                'code' => 'ML',
                'name' => 'Maternity Leave',
                'consumable' => 240,
            ],
            [
                'code' => 'PL',
                'name' => 'Paternity Leave',
                'consumable' => 56,
            ],
            [
                'code' => 'BL',
                'name' => 'Bereavement Leave',
                'consumable' => 0,
            ]
        ];

        LeaveSetting::insert($seeder);
    }
}
