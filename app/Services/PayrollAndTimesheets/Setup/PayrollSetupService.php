<?php

namespace App\Services\PayrollAndTimesheets\Setup;

use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Exceptions\InvalidSortQuery;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\PayrollAndTimesheets\Setup\PayrollSetting;
use App\Models\PayrollAndTimesheets\Setup\PayrollCategory;
use App\Services\CustomSort\CategoryTypeSort;

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
            $payrollSetup = $this->payrollSetupListQuery();
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
    * Get Common Query for Payroll Setup List
    */
    public function payrollSetupListQuery()
    {
        return QueryBuilder::for(
            PayrollSetting::select(
                'payroll_settings.id',
                'payroll_settings.name',
                'payroll_settings.abbrev',
                'payroll_settings.company_id',
                'payroll_settings.is_fixed',
                'payroll_settings.amount',
                'payroll_settings.status',
                'payroll_settings.subject_for_tax',
                'payroll_categories.type as type'
            )
            ->leftJoin('payroll_categories', 'payroll_categories.id', '=', 'payroll_settings.type')
            ->where('payroll_settings.company_id', '=', Auth()->user()->company_id)
        )
        ->defaultSort('payroll_settings.name')
        ->allowedSorts([
            AllowedSort::custom('type', new CategoryTypeSort()),
            'abbrev',
            'is_fixed',
            'amount',
            'status',
            'name'
        ]);
    }

    /**
    * $orderListQuery - parent query payroll setup list
    * string $filter - search filter
    */
    private function filter($orderListQuery, $filter)
    {
        $filters = explode(' ', $filter);
        return $orderListQuery->when($filter, function($query) use($filters) {
            $query->where(function($query) use($filters) {
                foreach($filters as $filter)
                {
                    $query->where('payroll_settings.abbrev', 'like', '%'. $filter .'%');
                    $query->orWhere('payroll_settings.name', 'like', '%'. $filter .'%');
                    $query->orWhere('payroll_categories.type', 'like', '%'. $filter .'%');
                }
            });
        });
    }

    private function updatePayrollSetupStatus($id, $status)
    {

    }
}