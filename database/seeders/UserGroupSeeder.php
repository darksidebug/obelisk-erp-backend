<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'name' => 'DevCode Group',
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        UserGroup::insert($seeder);
    }
}
