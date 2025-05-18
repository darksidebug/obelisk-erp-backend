<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicesSetting;

class ServicesSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'code' => 'QHRM',
                'name' => 'Quisit Human Resource Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MPTT',
                'name' => 'Moonset Payroll and Time Tracker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'IFAA',
                'name' => 'Intuitive Finance and Accounting Automation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SUBP',
                'name' => 'Subprime Loan Financing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SUPIN',
                'name' => 'Stockup Inventory',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        ServicesSetting::insert($seeder);
    }
}
