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
        Schema::create('payroll_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->default(1);
            $table->string('abbrev');
            $table->string('name');
            $table->tinyInteger('type');
            $table->tinyInteger('is_fixed')->default(0);
            $table->decimal('amount')->default(null);
            $table->tinyInteger('is_percentage')->default(0);
            $table->tinyInteger('subject_for_tax')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned()->default(1);
            $table->bigInteger('updated_by')->unsigned()->default(1);
            $table->softDeletes('deleted_at');

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
        Schema::dropIfExists('payroll_settings');
    }
};
