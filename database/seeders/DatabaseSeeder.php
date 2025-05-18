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
            UserRoleSeeder::class,
            UserGroupSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            BranchSeeder::class,
            LeaveSetupSeeder::class,
            PayrollCategorySeeder::class,
            PayrollSetupSeeder::class,
            PayrollCutOffSeeder::class,
            ServicesSetupSeeder::class,
            MenuSetupSeeder::class,
            ServiceAccessSeeder::class,
            MenuAccessSeeder::class,
        ];
    }
}
