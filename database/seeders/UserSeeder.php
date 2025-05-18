<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleModel = new UserRole();
        \App\Models\User::factory()->create([
            'email' => 'devcode@example.com',
            'role_id' => $roleModel->getRoleId(UserRole::ROLE_SUPER_ADMIN),
            'user_group_id' => 1,
            'company_id' => 1,
            'branch_id' => 1
        ]);
    }
}
