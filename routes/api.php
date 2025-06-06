<?php

use App\Http\Controllers\PayrollAndTimesheets\Setup\PayrollSetupController;
use App\Http\Controllers\PayrollAndTimesheets\Payroll\PayrollHistoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\JwtMiddleware;

Route::group(['prefix' => 'auth'], function () {
    /* Authentication */
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'payroll-and-timesheets'], function () {
    // Payroll Setup
    Route::apiResource('setup', PayrollSetupController::class);
    // Route::post('setup', [PayrollSetupController::class, 'store']);
    // Route::put('setup/{id}', [PayrollSetupController::class, 'update']);
    // Route::delete('setup/{id}', [PayrollSetupController::class, 'destroy']);

});

Route::group(['prefix' => 'payroll'], function () {
    // Payroll Setup
    Route::get('history', [PayrollHistoryController::class, 'index']);
    // Route::post('setup', [PayrollSetupController::class, 'store']);
    // Route::put('setup/{id}', [PayrollSetupController::class, 'update']);
    // Route::delete('setup/{id}', [PayrollSetupController::class, 'destroy']);

});