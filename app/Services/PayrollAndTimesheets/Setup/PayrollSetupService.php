<?php

namespace App\Services\PayrollAndTimesheets\Setup;

use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Exceptions\InvalidSortQuery;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\PayrollAndTimesheets\Setup\PayrollSetting;
use App\Models\PayrollAndTimesheets\Setup\PayrollCategory;

class PayrollSetupService
{
    public function __construct() 
    {
        //
    }

    /**
    * Get Order List
    *
    * int $perPage - Data per page count
    * string $filter - Search filter
    * string $sort - Sort query
    */
    public function list(int $perPage = 25, string $filter, string $sort)
    {
        try {
            $payrollSetup = $this->orderLisQuery();
            $payrollSetup = $this->filter($payrollSetup, $filter, $sort);

            return $payrollSetup->paginate($perPage);
        } catch (InvalidSortQuery $e) {
            echo $e->getMessage();
        }
    }

    /**
    * Get order details
    * int $id - Id of Order Header
    */
    public function show($id)
    {

    }

    /**
    * Create record
    */
    public function create() 
    {
        //
    }
    
    /**
    * Update order status
    */
    public function update($id, $status, $message, $files)
    {
        
    }

    /**
    * Batch update record
    * @param array $ids - Order header ID's
    * @param integer $status - Status to update
    */
    public function batchUpdate($ids, $status)
    {

    }

    /**
    * Get Common Query for Order List
    */
    public function orderLisQuery()
    {
        return QueryBuilder::for(
            PayrollSetting::select(
                'id',
                'name',
                'abbrev',
                'type',
                'is_fixed',
                'amount',
                'status'
            )
        )
        ->defaultSort('name')
        ->allowedSorts([
            'abbrev',
            'type',
            'is_fixed',
            'amount',
            'status'
        ]);
    }

    /**
    * $orderListQuery - parent query order list
    * string $filter - search filter
    */
    private function filter($orderListQuery, $filter)
    {
        $filters = explode(' ', $filter);
        return $orderListQuery->when($filter, function($query) use($filters) {
            $query->where(function($query) use($filters) {
                foreach($filters as $filter)
                {
                    $query->where('abbrev', 'like', '%'. $filter .'%');
                    $query->orWhere('name', 'like', '%'. $filter .'%');
                }
            });
        });
    }

    private function updateOrderDetailStatus($orderHeaderId, $status)
    {

    }
}