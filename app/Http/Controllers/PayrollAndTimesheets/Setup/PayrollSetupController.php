<?php

namespace App\Http\Controllers\PayrollAndTimesheets\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollAndTimesheets\Setup\PayrollSetupRequest;
use App\Http\Requests\PayrollAndTimesheets\Setup\BatchDeletePayrollSetupRequest;
use App\Http\Requests\PayrollAndTimesheets\Setup\BatchUpdatePayrollSetupRequest;
use Illuminate\Http\Request;
use App\Services\PayrollAndTimesheets\Setup\PayrollSetupService;
use App\Http\Resources\PayrollAndTimesheets\Setup\PayrollSetupResource;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            $sort = request()->get('sort', 'name');
            $page = request()->get('page', 1);

            $lists = $payrollSetupService->list($perPage, $filter, $sort);

            return $this->successResponse(PayrollSetupResource::collection($lists));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve payroll settings: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayrollSetupRequest $request)
    {
        try {
            DB::beginTransaction();
            $payrollSetup = $this->payrollSetupService->create(
                $request->abbrev,
                $request->name,
                $request->type,
                $request->is_fixed,
                $request->amount,
                $request->is_percentage,
                $request->subject_for_tax,
                $request->status
            );

            DB::commit();
            return $this->successResponse([], 'Payroll setup added');
        } catch (Throwable $exception) {
            DB::rollBack();
            return $this->errorResponse('An error occurred while trying create payroll setup', $exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payrollSetup = $this->payrollSetupService->show($id);
        return $this->successResponse(new PayrollSetupResource($payrollSetup));
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
    public function update(PayrollSetupRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $this->payrollSetupService->update(
                $id,
                $request->abbrev,
                $request->name,
                $request->type,
                $request->is_fixed,
                $request->amount,
                $request->is_percentage,
                $request->subject_for_tax,
                $request->status
            );
            DB::commit();
            return $this->successResponse([], 'Payroll setup updated');
        } catch (Throwable $exception) {
            DB::rollBack();
            if ($exception instanceof ModelNotFoundException) {
                throw new ModelNotFoundException();
            }
            return $this->errorResponse('An error occurred while trying update payroll setup', $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->payrollSetupService->delete(
                $id,
            );
            DB::commit();
            return $this->successResponse([], 'Payroll setup deleted');
        } catch (Throwable $exception) {
            DB::rollBack();
            if ($exception instanceof ModelNotFoundException) {
                throw new ModelNotFoundException();
            }
            return $this->errorResponse('An error occurred while trying delete payroll setup', $exception);
        }
    }

    public function batchDelete(BatchDeletePayrollSetupRequest $request)
    {
        try {
            DB::beginTransaction();
            $delete = $this->payrollSetupService->bulkDelete($request->ids);
            DB::commit();
            return $this->successResponse($delete, 'Payroll setup deleted', Response::HTTP_OK);
        } catch (Throwable $exception) {
            DB::rollBack();
            return $this->errorResponse('An error occurred while trying to delete a message items', $exception);
        }
    }

    public function batchUpdate(BatchUpdatePayrollSetupRequest $request)
    {
        $this->payrollSetupService->bulkUpdate($request->ids);
        return $this->successResponse([], 'Payroll setup statuses updated');
    }
}
