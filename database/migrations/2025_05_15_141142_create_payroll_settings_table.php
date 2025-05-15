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
            $table->id();
            $table->string('abbrev');
            $table->string('name');
            $table->tinyInteger('type');
            $table->tinyInteger('is_fixed')->default(0);
            $table->decimal('amount')->default(null);
            $table->tinyInteger('is_percentage')->default(0);
            $table->tinyInteger('subject_for_tax')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
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
