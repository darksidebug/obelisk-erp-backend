<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seeder extends Model
{
    protected $guarded = [];

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config(config('utility.seeders_table_name'));
    }
}
