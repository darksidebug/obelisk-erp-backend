<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_cut_off_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->bigInteger('company_id')->unsigned()->default(1);
            $table->tinyInteger('first_cut_off')->default(5);
            $table->tinyInteger('second_cut_off')->default(20);
            $table->tinyInteger('first_disbmt')->default(15);
            $table->tinyInteger('second_disbmt')->default(30);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned()->default(1);
            $table->bigInteger('updated_by')->unsigned()->default(1);
            $table->softDeletes('deleted_at');

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_cut_off_settings');
    }
};
