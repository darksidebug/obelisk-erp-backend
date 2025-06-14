<?php

namespace App\Http\Requests\PayrollAndTimesheets\Setup;

use Illuminate\Foundation\Http\FormRequest;

class BatchUpdatePayrollSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'numeric'],
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'numeric'],
        ];
    }
}
