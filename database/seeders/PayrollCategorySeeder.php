<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayrollCategory;

class PayrollCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'type' => 'Contributions',
            ],
            [
                'type' => 'Deductions',
            ],
            [
                'type' => 'Tax',
            ],
            [
                'type' => 'Other Deductions'
            ],
            [
                'type' => 'Salary'
            ],
            [
                'type' => 'Earnings'
            ],
            [
                'type' => 'Other Earnings'
            ]
        ];

        PayrollCategory::insert($seeder);
    }
}
