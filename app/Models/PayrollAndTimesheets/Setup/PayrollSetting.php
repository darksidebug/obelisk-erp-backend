<?php

namespace App\Models\PayrollAndTimesheets\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollSetting extends Model
{
    use HasFactory, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(PayrollCategory::class);
    }
}
