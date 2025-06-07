<?php

namespace App\Models\PayrollAndTimesheets\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function payroll_setup()
    {
        return $this->hasMany(PayrollSetting::class);
    }
}
