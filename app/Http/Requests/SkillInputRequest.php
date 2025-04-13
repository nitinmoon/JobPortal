<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillInputRequest extends FormRequest
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
            'name' => 'required|max:50|unique:skills'
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Skill set is required',
            'name.max' => 'name not be greater than 50 characters',
            'name.unique' => 'Skill already exists'
        ];
    }
}
