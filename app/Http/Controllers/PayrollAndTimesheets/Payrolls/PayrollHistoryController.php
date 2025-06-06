<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(['data' => 'Records'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve payroll settings: ' . $e->getMessage()], 500);
        }
    }
}
