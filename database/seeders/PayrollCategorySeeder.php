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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Deductions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Tax',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Other Deductions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Salary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Earnings',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Other Earnings',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        PayrollCategory::insert($seeder);
    }
}
