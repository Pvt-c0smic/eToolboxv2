<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelStoreRequest extends FormRequest
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
            'last_name' => ['required', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'middle_name' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone_number' => ['nullable', 'max:255', 'string'],
            'afpsn' => ['nullable', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'rank_id' => ['required', 'exists:rf_ranks,id'],
            'bos_id' => ['required', 'exists:rf_bos,id'],
            'office_id' => ['required', 'exists:rf_offices,id'],
            'designation' => ['required', 'max:255', 'string'],
        ];
    }
}
