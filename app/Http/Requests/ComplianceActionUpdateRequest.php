<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplianceActionUpdateRequest extends FormRequest
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
            'compliance_id' => ['required', 'exists:tr_compliances,id'],
            'action_taken' => ['required', 'max:255', 'string'],
            'commander_comment' => ['required', 'max:255', 'string'],
            'percentage' => ['required', 'numeric'],
            'updated_date' => ['required', 'date'],
        ];
    }
}
