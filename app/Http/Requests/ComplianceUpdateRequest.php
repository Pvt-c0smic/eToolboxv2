<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplianceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'office_id' => ['required', 'exists:rf_offices,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'project_name' => ['required', 'max:255', 'string'],
            'status_id' => ['required', 'exists:rf_statuses,id'],
        ];
    }
}
