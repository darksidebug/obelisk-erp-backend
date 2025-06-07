<?php
namespace App\Services\Admin\CustomSort;

use Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;;
use Illuminate\Support\Facades\DB;

class RoleTypeCustomSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->leftJoin('users', 'users.id', '=', 'order_headers.user_id')
              ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->orderBy('roles.role', $direction);
    }
}