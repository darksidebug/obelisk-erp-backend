<?php
namespace App\Services\Admin\CustomSort;

use Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;

class SubjectInformationCustomSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->leftJoin('subject_information as subject_info', 'subject_info.order_header_id', '=', 'order_headers.id')
            ->orderBy('subject_info.subject_last_name', $direction)
            ->orderBy('subject_info.subject_first_name',  $direction);
    }
}