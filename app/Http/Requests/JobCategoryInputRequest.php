<?php

namespace App\Http\Requests;

use App\Models\JobCategory;
use Illuminate\Foundation\Http\FormRequest;

class JobCategoryInputRequest extends FormRequest
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
        $jobCategory = JobCategory::find($this->jobCategoryId);
        return [
            'name' => 'required|unique:job_categories,name,'.(isset($jobCategory->id) ? $jobCategory->id  : ''),
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
            'name.required' => 'Job category name is required',
            'name.unique' => 'Job category name has already been taken'
        ];
    }
}
