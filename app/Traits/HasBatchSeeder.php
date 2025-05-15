<?php

namespace App\Traits;

use App\Models\Seeder;

trait HasBatchSeeder
{
    /**
     * Get seeders.
     *
     * @return string[]
     */
    abstract public function getSeeders();

    /**
     * Run the database seeders by batch similar to migrations
     * Has 'seeders' table to determine if a seeder has been run already
     *
     * @return void
     */
    public function run(): void
    {
        $batch = $this->getNextBatchNumber();
        $count = 0;

        foreach ($this->getSeeders() as $seeder) {
            if (!$this->exists($seeder)) {
                $this->call($seeder);
                $this->log($seeder, $batch);
                ++$count;
            }
        }

        if (!$count) {
            echo "Nothing to seed \n";
        }
    }

    /**
     * Log seeder.
     *
     * @param unknown $seeder
     * @param int $batch
     *
     * @return unknown
     */
    protected function log($seeder, $batch)
    {
        return Seeder::insert(['seeder' => $seeder, 'batch' => $batch]);
    }

    /**
     * Get next batch number.
     *
     * @return number
     */
    protected function getNextBatchNumber()
    {
        return Seeder::max('batch') + 1;
    }

    /**
     * Check if seeder exists.
     *
     * @param unknown $seeder
     *
     * @return unknown
     */
    protected function exists($seeder)
    {
        return Seeder::where('seeder', $seeder)->exists();
    }
}