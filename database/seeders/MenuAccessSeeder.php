<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [];

        for ($i = 1; $i <= 42; $i++) {
            array_push(
                $seeder, [
                    'services_id' => 2,
                    'menu_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        Menu::insert($seeder);
    }
}
