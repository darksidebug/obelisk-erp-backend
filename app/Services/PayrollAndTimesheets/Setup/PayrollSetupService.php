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
        
    }

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

    public function show($id)
    {
        return PayrollSetting::findOrFail($id);
    }

    public function create($abbrev, $name, $type, $is_fixed, $amount, $is_percentage, $subject_for_tax, $status) 
    {
        return PayrollSetting::create([
            'company_id' => Auth()->user()->company_id,
            'abbrev' => $abbrev,
            'name' => $name,
            'type' => $type,
            'is_fixed' => $is_fixed,
            'amount' => $amount,
            'is_percentage' => $is_percentage,
            'subject_for_tax' => $subject_for_tax,
            'status' => $status,
            'created_by' => Auth()->user()->id,
            'updated_by' => Auth()->user()->id
        ]);
    }
    

    public function update($id, $abbrev, $name, $type, $is_fixed, $amount, $is_percentage, $subject_for_tax, $status)
    {
        return PayrollSetting::findOrFail($id)->update([
            'abbrev' => $abbrev,
            'name' => $name,
            'type' => $type,
            'is_fixed' => $is_fixed,
            'amount' => $amount,
            'is_percentage' => $is_percentage,
            'subject_for_tax' => $subject_for_tax,
            'status' => $status,
            'updated_by' => Auth()->user()->id
        ]);
    }

    public function batchUpdate($ids, $status)
    {

    }

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
                'payroll_categories.type as type',
                \DB::raw("CONCAT(creator.first_name, ' ', creator.last_name) as created_by"),
                \DB::raw("CONCAT(updater.first_name, ' ', updater.last_name) as updated_by"),
                'payroll_categories.updated_at'
            )
            ->leftJoin('payroll_categories', 'payroll_categories.id', '=', 'payroll_settings.type')
            ->leftJoin('users as creator', 'creator.id', '=', 'payroll_settings.created_by')
            ->leftJoin('users as updater', 'updater.id', '=', 'payroll_settings.updated_by')
            ->where('payroll_settings.company_id', '=', Auth()->user()->company_id)
            ->where('payroll_settings.deleted_at', '=', null)
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

    private function bulkUpdate($ids, $status)
    {
        return PayrollSetting::whereIn('id', $ids)->update(['status' => $status]);
    }

    private function bulkDelete($ids)
    {
        return PayrollSetting::whereIn('id', $ids)->delete();
    }

    public function delete($ids)
    {
        return PayrollSetting::findOrFail($id)->delete();
    }
}