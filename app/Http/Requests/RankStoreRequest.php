<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RankStoreRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'personnel_type_id' => ['required', 'exists:rf_personnel_types,id'],
        ];
    }
}
