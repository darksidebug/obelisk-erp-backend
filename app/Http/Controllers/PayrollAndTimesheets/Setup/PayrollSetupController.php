<?php

namespace App\Http\Controllers\PayrollAndTimesheets\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PayrollAndTimesheets\Setup\PayrollSetupService;

class PayrollSetupController extends Controller
{
    private $payrollSetupService;

    public function __construct(PayrollSetupService $payrollSetupService)
    {
        $this->payrollSetupService = $payrollSetupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PayrollSetupService $payrollSetupService)
    {
        try {
            $perPage = request()->get('per_page', 25);
            $filter = request()->get('filter', '');
            $status = request()->get('sort', 'name');

            return $payrollSetupService->list($perPage, $filter, $sort);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve payroll settings: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
