<?php
namespace App\Services\Admin\CustomSort;

use Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;;
use Illuminate\Support\Facades\DB;

class UserCustomSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->leftJoin('users', 'users.id', '=', 'payroll_settings.user_id')
            ->orderBy(DB::raw('CONCAT(users.first_name," ",users.last_name)'), $direction);
    }
}