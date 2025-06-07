<?php
namespace App\Services\Admin\CustomSort;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class FullNameCustomSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'desc' : 'asc';
        $query->orderByRaw("CONCAT(first_name, ' ', last_name) $direction");
    }
}