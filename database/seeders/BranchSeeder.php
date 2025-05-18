<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'name' => 'DevCode Cebu',
                'company_id' => 1,
                'email' => 'devcode_cebu@gmail.com',
                'contact' => '09367653842',
                'address' => 'Kamputhaw, Cebu City, Cebu',
                'zipcode' => 6000,
                'country' => 'Philippines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Branch::insert($seeder);
    }
}
