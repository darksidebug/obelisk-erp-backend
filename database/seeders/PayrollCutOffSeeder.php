<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayrollAndTimesheets\Setup\PayrollCutOffSetting;

class PayrollCutOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'first_cut_off' => 5,
                'second_cut_off' => 20,
                'first_disbmt' => 15,
                'second_disbmt' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PayrollCutOffSetting::insert($seeder);
    }
}
