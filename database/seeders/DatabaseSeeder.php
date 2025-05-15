<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Traits\HasBatchSeeder;

class DatabaseSeeder extends Seeder
{
    use HasBatchSeeder;

    /**
     * Seed the application's database.
     */
    public function getSeeders()
    {
        return [
            LeaveSetupSeeder::class,
            PayrollCategorySeeder::class,
            PayrollSetupSeeder::class,
        ];
    }
}
