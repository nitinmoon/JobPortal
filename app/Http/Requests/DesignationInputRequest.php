<?php

namespace App\Http\Requests;

use App\Models\Designation;
use Illuminate\Foundation\Http\FormRequest;

class DesignationInputRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $designation = Designation::find($this->designationId);
        return [
            'name' => 'required|unique:designations,name,'.(isset($designation->id) ? $designation->id  : ''),
        ];
    }

    /**
     * Get the custom messages for validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Designation name is required',
            'name.unique' => 'Designation name has already been taken'
        ];
    }
}
