<?php

namespace App\Models\PayrollAndTimesheets\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'abbrev',
        'name',
        'type',
        'is_fixed',
        'amount',
        'is_percentage',
        'subject_for_tax',
        'status',
        'created_by',
        'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(PayrollCategory::class);
    }
}
