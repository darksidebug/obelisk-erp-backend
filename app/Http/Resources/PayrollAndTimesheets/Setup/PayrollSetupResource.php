<?php

namespace App\Http\Resources\PayrollAndTimesheets\Setup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollSetupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abbrev' => $this->abbrev,
            'company_id' => $this->company_id,
            'is_fixed' => $this->is_fixed,
            'amount' => $this->amount,
            'status' => $this->status,
            'subject_for_tax' => $this->subject_for_tax,
            'type' => $this->type,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at
        ];
    }
}
